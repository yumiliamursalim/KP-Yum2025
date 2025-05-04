<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pesanan = Pesanan::where('user_id', $user->id)
            ->with('detailPesanan.produk')
            ->latest()
            ->get();

        return view('pesanan.index', compact('pesanan'));
    }
}
