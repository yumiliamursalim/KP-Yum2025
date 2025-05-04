<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananAdminController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with('user', 'detailPesanan.produk')->latest()->get();
        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function ubahStatus($id, Request $request)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->route('admin.pesanan.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
