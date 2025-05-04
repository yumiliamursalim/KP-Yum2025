<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function index()
    {
        $items = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        return view('keranjang.index', compact('items'));
    }

    public function tambah(Request $request, $produk_id)
    {
        $produk = Produk::findOrFail($produk_id);

        $keranjang = Keranjang::updateOrCreate(
            ['user_id' => Auth::id(), 'produk_id' => $produk_id],
            ['jumlah' => DB::raw('jumlah + 1')]
        );

        return redirect()->route('keranjang.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function hapus($id)
    {
        $item = Keranjang::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
