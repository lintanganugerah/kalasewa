<?php

namespace App\Http\Controllers;

use App\Models\PenarikanSaldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FundsController extends Controller
{
    public function index(Request $request)
    {
        $refunds = PenarikanSaldo::where('status', 'Menunggu Konfirmasi')
            ->orwhere('status', 'Sedang Diproses')
            ->get();

        $refundsHistory = PenarikanSaldo::where('status', 'Selesai')
            ->orWhere('status', 'Ditolak')
            ->paginate(5, ['*'], 'refund_page');

        return view('admin.refunds.index', compact('refunds', 'refundsHistory'));
    }

    public function process(Request $request)
    {
        $refund = PenarikanSaldo::findOrFail($request->input('refund_id'));
        $refund->status = 'Sedang Diproses';
        $refund->save();

        return redirect()->route('admin.refunds.index')->with('success', 'Status refund berhasil diperbarui menjadi Sedang Diproses.');
    }

    public function show($id)
    {
        $refund = PenarikanSaldo::find($id);

        if (!$refund) {
            return redirect()->route('admin.refunds.index')->with('error', 'Pengembalian dana tidak ditemukan.');
        }

        return view('admin.refunds.show', [
            'refund' => $refund,
        ]);
    }

    public function transfer(Request $request, $id)
    {
        // Validasi file upload
        $validator = Validator::make($request->all(), [
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        $file = $request->file('bukti_transfer');
        $filename = time() . '_' . $file->getClientOriginalName();
        $dokumentasiPath = $file->storeAs('public/bukti_tiket', $filename);
        $dokumentasiPath = Str::replaceFirst('public/', 'storage/', $dokumentasiPath);

        // Find the refund entry
        $refund = PenarikanSaldo::find($id);

        if (!$refund) {
            return redirect()->route('admin.refunds.index')->with('error', 'Pengembalian dana tidak ditemukan.');
        }

        // Update refund status and save
        $refund->status = 'Selesai';
        $refund->bukti_transfer = $dokumentasiPath; // Directly assign array
        $refund->save();

        return redirect()->route('admin.refunds.show', $refund->id)->with('success', 'Transfer telah berhasil dikirim.');
    }

    public function reject(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:penarikan_saldo,id',
            'alasan_penolakan' => 'required|string',
        ]);

        $refund = PenarikanSaldo::find($validated['id']);
        $refund->status = 'Ditolak';
        $refund->alasan_penolakan = $validated['alasan_penolakan'];
        $refund->save();

        return redirect()->back()->with('success', 'Refund telah ditolak.');
    }

}
