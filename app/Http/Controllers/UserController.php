<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $usersQuery = User::query()->where(function ($query) {
            $query->where('role', 'penyewa')
                ->orWhere('role', 'pemilik_sewa');
        });

        if ($request->has('search')) {
            $searchQuery = $request->search;
            $usersQuery->where('nama', 'LIKE', "%" . $searchQuery . '%');
        }

        $users = $usersQuery->paginate(10);

        $adminUsers = User::where('role', 'admin')
            ->orWhere('role', 'super_admin')
            ->paginate(5, ['*'], 'admin_page');

        return view('admin.users.index', compact('users', 'adminUsers'));
    }


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
    public function index(Request $request)
    {
        $users = User::where('role', 'penyewa')
            ->orWhere('role', 'pemilik_sewa')
            ->paginate(5, ['*'], 'users_page');

        $adminUsers = User::where('role', 'admin')
            ->orWhere('role', 'super_admin')
            ->paginate(5, ['*'], 'admin_page');

        return view('admin.users.index', compact('users', 'adminUsers'));
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
            $user->save();

            Mail::send('emails.verified', ['user' => $user], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Yeay! Akun Kamu Sudah Terverifikasi! 🎉');
            });

            return redirect()->route('admin.verify.index')->with('success', 'Status verifikasi pengguna berhasil diperbarui.');

        } elseif ($request->input('action') === 'reject') {
            $request->validate([
                'reason' => 'required|string',
            ]);

            $user->verifyIdentitas = 'Ditolak';
            $user->nik = null;
            $user->no_telp = null;
            $user->no_darurat = null;
            $user->alamat = null;
            $user->provinsi = null;
            $user->link_sosial_media = null;
            $user->kota = null;
            $user->kode_pos = null;
            $user->badge = 'Banned';

            // Hapus foto dari storage
            $path = $user->foto_diri;
            $path2 = $user->foto_identitas;
            Storage::delete(str_replace('storage/', 'public/', $path));
            Storage::delete(str_replace('storage/', 'public/', $path2));

            $user->foto_diri = null;
            $user->foto_identitas = null;
            $user->save();

            // Simpan alasan penolakan ke dalam tabel alasan_penolakan
            DB::table('alasan_penolakan')->insert([
                'id_user' => $user->id,
                'penolakan' => 'verify',
                'alasan_penolakan' => $request->reason,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Kirim email ke user
            Mail::send('emails.rejection', ['reason' => $request->reason, 'user' => $user], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Oops! Verifikasi Akun Kamu Gagal 🥺');
            });

            return redirect()->route('admin.verify.index')->with('success', 'Status verifikasi pengguna dan alasan penolakan berhasil diperbarui, dan email telah dikirim.');
        }

        return redirect()->route('admin.verify.index')->with('error', 'Tindakan tidak dikenal.');
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

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }


    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari form
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_telp' => 'nullable|string|max:15',
            'role' => 'required|in:penyewa,pemilik_sewa,admin,super_admin',
            'verifyIdentitas' => 'required|in:Sudah,Tidak,Ditolak',
        ]);

        // Ambil semua data yang dikirimkan dari form
        $data = $request->all();

        // Enkripsi password sebelum disimpan
        $data['password'] = Hash::make($request->password);

        // Pastikan verifyIdentitas diatur dengan benar
        $data['verifyIdentitas'] = 'Sudah'; // atau sesuai kebutuhan aplikasi
        $data['password'] = Hash::make($request->password);

        // User::create($data);
        $user = User::create($data);

        // Update bagian verifyIdentitas menjadi 'sudah'
        $user->verifyIdentitas = $request->verifyIdentitas;
        $user->save();

        // Simpan data user baru
        $user = User::create($data);

        $user->verifyIdentitas = $request->verifyIdentitas;
        $user->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function nonaktifkanUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->badge !== 'Banned') {
            $request->validate([
                'reason' => 'required|string',
            ]);

            // Simpan alasan penolakan ke dalam tabel alasan_penolakan
            DB::table('alasan_penolakan')->insert([
                'id_user' => $user->id,
                'penolakan' => 'ban_account',
                'alasan_penolakan' => $request->reason,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user->badge = 'Banned';

            Mail::send('emails.banned', ['reason' => $request->reason, 'user' => $user], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Akun kamu telah diblokir! ⛔');
            });

        } else {
            $user->badge = 'Aktif';

            Mail::send('emails.reactivated', ['user' => $user], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Yeay! Akun Kamu Telah Diaktifkan Kembali 🎉');
            });
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Status pengguna berhasil diperbarui.');
    }

}