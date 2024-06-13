<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Toko;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class UserController extends Controller
{
    public function userCount()
    {
        $totalPenyewaTerdaftar = User::where('role', 'penyewa')->where('verifyIdentitas', 'Sudah')->count();
        $totalPemilikSewaTerdaftar = User::where('role', 'pemilik_sewa')->where('verifyIdentitas', 'Sudah')->count();
        $totalPendingVerifikasi = User::where('role', '<>', 'admin')->where('verifyIdentitas', 'Tidak')->count();

        return view('admin.dashboard', [
            'totalPenyewaTerdaftar' => $totalPenyewaTerdaftar,
            'totalPemilikSewaTerdaftar' => $totalPemilikSewaTerdaftar,
            'totalPendingVerifikasi' => $totalPendingVerifikasi,
        ]);
    }
    public function index()
    {
        $users = User::paginate(10); // Mengambil data pengguna dengan pembagian halaman (10 item per halaman)
        return view('admin.users.index', compact('users'));
    }

    public function index_verify()
    {
        $users = User::where('verifyIdentitas', 'Tidak')->get();
        return view('admin.verify.index', compact('users'));
    }

    public function updateVerification(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->input('action') === 'verify') {
            $user->verifyIdentitas = 'Sudah';
        } elseif ($request->input('action') === 'reject') {
            $user->verifyIdentitas = 'Ditolak';
            $user->nik = null;
            $user->no_telp = null;
            $user->no_darurat = null;
            $user->alamat = null;
            $user->provinsi = null;
            $user->link_sosial_media = null;
            $user->kota = null;
            $user->kode_pos = null;

            // Hapus foto dari storage
            $path = $user->foto_diri;
            $path2 = $user->foto_identitas;
            Storage::delete(str_replace('storage/', 'public/', $path));
            Storage::delete(str_replace('storage/', 'public/', $path2));

            $user->foto_diri = null;
            $user->foto_identitas = null;
        }

        $user->save();

        return redirect()->route('admin.verify.index')->with('success', 'Status verifikasi pengguna berhasil diperbarui.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        if ($user->verifyIdentitas !== 'Tidak') {
            return redirect()->route('admin.verify.index')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('admin.verify.detail', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'no_telp' => 'nullable|string|max:15',
        ]);

        $user = User::findOrFail($id);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }


    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_telp' => 'nullable|string|max:15',
            'role' => 'required|in:penyewa,pemilik_sewa,admin',
            'verifyIdentitas' => 'required|in:Sudah,Tidak,Ditolak',
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);

        // User::create($data);
        $user = User::create($data);

        // Update bagian verifyIdentitas menjadi 'sudah'
        $user->verifyIdentitas = $request->verifyIdentitas;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function nonaktifkanUser($id)
    {
        $user = User::findOrFail($id);

        // Toggle nilai kolom 'badge' jika tidak 'banned'
        if ($user->badge !== 'Banned') {
            $user->badge = 'Banned';
        } else {
            $user->badge = 'Pendatang';
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Status badge pengguna berhasil diperbarui.');
    }
}