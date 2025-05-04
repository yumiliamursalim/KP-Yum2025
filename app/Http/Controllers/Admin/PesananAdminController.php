<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with('user', 'detailPesanan.produk')->latest();

    // Filter berdasarkan status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Search berdasarkan nama pelanggan
    if ($request->filled('search')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }

    $pesanan = $query->get();

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
