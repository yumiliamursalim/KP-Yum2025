<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    //
    public function tambah(Request $request, $id){

    $produk = Produk::findOrFail($id);
    $jumlah = $request->input('jumlah', 1); // default = 1

    // Cek apakah produk sudah ada di keranjang user
    $keranjang = Keranjang::where('user_id', Auth::id())
                    ->where('produk_id', $id)
                    ->first();

    if ($keranjang) {
        // Jika sudah ada, tambahkan jumlah
        $keranjang->jumlah += $jumlah;
        $keranjang->save();
    } else {
        // Jika belum ada, buat baru
        Keranjang::create([
            'user_id' => Auth::id(),
            'produk_id' => $id,
            'jumlah' => $jumlah,
        ]);
    }

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}

}
