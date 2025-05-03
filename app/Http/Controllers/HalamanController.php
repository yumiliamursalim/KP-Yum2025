<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

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
}
    