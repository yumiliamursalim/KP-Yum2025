<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HalamanController extends Controller
{
    function index(){
        $produkTerbaru = Produk::latest()->take(4)->get(); // ambil 4 produk terbaru
        return view("halaman/index", compact('produkTerbaru'));
    }

    function tentang(){
        return view("halaman/tentang");
    }
    function kontak(){
        return view("halaman/kontak");
    }
    function admin(){
        return view("halaman/admin");
    }

    function profile(){
        $user = Auth::user();
        return view('/halaman/profile', compact('user'));
    }
    
    public function semuaPesanan()
{
    $pesanan = Pesanan::with(['user', 'detailPesanan.produk'])->orderBy('created_at', 'desc')->get();

    return view('admin.pesanan.index', compact('pesanan'));
}
}
