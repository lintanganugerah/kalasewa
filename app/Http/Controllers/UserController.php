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
        $users = User::all();
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
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'no_telp' => 'nullable|string|max:15',
            'badge' => 'nullable|string|max:255',
            'role' => 'required|in:penyewa,pemilik_sewa,admin',
            'verifyIdentitas' => 'required|in:Sudah,Tidak,Ditolak',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'identitas' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'NIK' => 'nullable|string|max:16',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
        ]);

        $user = User::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('foto_profil')) {
        $foto_profil = $request->file('foto_profil');
        $path = $foto_profil->store('public/foto_profil');
        $user->foto_profil = $path;
        }

        if ($request->hasFile('identitas')) {
            $data['identitas'] = $request->file('identitas')->store('identitas', 'public');
        }

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
            'badge' => 'nullable|string|max:255',
            'role' => 'required|in:penyewa,pemilik_sewa,admin',
            'verifyIdentitas' => 'required|in:Sudah,Tidak,Ditolak',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'identitas' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'NIK' => 'nullable|string|max:16',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_profil')) {
            $foto_profil = $request->file('foto_profil');
            $path = $foto_profil->store('public/foto_profil');
            $data['foto_profil'] = $path;
        }

        if ($request->hasFile('identitas')) {
            $identitas = $request->file('identitas');
            $path = $identitas->store('public/identitas');
            $data['identitas'] = $path;
        }

        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
