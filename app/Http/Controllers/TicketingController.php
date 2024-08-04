<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Toko;
use App\Models\Penyewa;
use App\Models\Produk;
use App\Models\FotoProduk;
use App\Models\Series;
use App\Models\OrderPenyewaan;
use App\Models\Review;
use App\Models\TopSeries;
use App\Models\Checkout;
use App\Models\Tiket;
use App\Models\KategoriTiket;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class TicketingController extends Controller
{
    //
    public function viewTicketing()
    {
        $ticketing = Tiket::where('user_id', Auth()->user()->id)->get();

        return view('penyewa.ticketing.ticketing', compact('ticketing'));
    }

    //
    public function viewNewTicketing()
    {
        $jenistiket = KategoriTiket::all(); 
        return view('penyewa.ticketing.newTicketing', compact('jenistiket'));
    }

    public function createTicket(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'jenis_ticketing' => 'required|string',
            'deskripsi_ticketing' => 'required|string',
            'bukti_tiket.*' => 'nullable|file|mimes:jpg,png,jpeg|max:5120',
        ]);

        // Jika validasi gagal, kembali dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $uploadedImages = [];
        if ($request->hasFile('bukti_tiket')) {
            foreach ($request->file('bukti_tiket') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $dokumentasiPath = $file->storeAs('public/bukti_tiket', $filename);
                $dokumentasiPath = Str::replaceFirst('public/', 'storage/', $dokumentasiPath);
                $uploadedImages[] = $dokumentasiPath;
            }
        } else {
            return redirect()->back()->with('error', 'Terjadi Error dengan foto');
        }

        $ticketing = new Tiket();
        $ticketing->kategori_tiket_id = $request->jenis_ticketing;
        $ticketing->deskripsi = $request->deskripsi_ticketing;
        $ticketing->status = "Menunggu Konfirmasi";
        $ticketing->user_id = Auth()->User()->id;
        $ticketing->bukti_tiket = json_encode($uploadedImages);
        $ticketing->save();

        return redirect()->route('viewTicketing')->with('success', 'Berhasil Mengajukan Ticketing');
    }
}
