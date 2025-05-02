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
        $data = [
            'judul' => 'Ini Tentang Saya',
            'kontak' => [
                'email' => 'dimana@sss.com',
                'youtube' => 'Ajikala'
            ]
        ];
        return view("halaman/tentang")->with($data);
    }
    function kontak(){
        return view("halaman/kontak");
    }
}
