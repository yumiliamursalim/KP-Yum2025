<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function formCheckout()
    {
        $keranjang = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        return view('checkout.form', compact('keranjang'));
    }

    public function prosesCheckout(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string',
            'metode_pembayaran' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $keranjang = Keranjang::with('produk')->where('user_id', Auth::id())->get();

            if ($keranjang->isEmpty()) {
                return back()->with('error', 'Keranjang kosong!');
            }

            $total = 0;
            foreach ($keranjang as $item) {
                $total += $item->produk->harga * $item->jumlah;
            }

            $pesanan = Pesanan::create([
                'user_id' => Auth::id(),
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => 'diproses',
                'total_harga' => $total,
            ]);

            foreach ($keranjang as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $item->produk_id,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->produk->harga,
                ]);

                // Kurangi stok produk
                $item->produk->stok -= $item->jumlah;
                $item->produk->save();
            }

            Keranjang::where('user_id', Auth::id())->delete();

            DB::commit();
            return redirect()->route('pesanan.saya')->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }
}
