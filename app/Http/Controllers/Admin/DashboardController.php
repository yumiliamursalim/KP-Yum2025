<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class DashboardController extends Controller
{
    public function index()
    {
        // Grafik penjualan bulanan
        $penjualanBulanan = Pesanan::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw("SUM(total_harga) as total")
            )
            ->where('status', 'selesai')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Produk stok menipis
        $stokMenipis = Produk::where('stok', '<', 10)->get();

        // 5 produk terlaris
        $produkTerlaris = DB::table('detail_pesanan')
            ->join('produk', 'detail_pesanan.produk_id', '=', 'produk.id')
            ->select('produk.nama', DB::raw('SUM(detail_pesanan.jumlah) as total_terjual'))
            ->groupBy('produk.nama')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();


        $tahunTersedia = Pesanan::selectRaw('YEAR(created_at) as tahun')
        ->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        // Customer paling aktif
        $customerAktif = DB::table('pesanan')
            ->join('users', 'pesanan.user_id', '=', 'users.id')
            ->select('users.name', DB::raw('COUNT(pesanan.id) as total_pesanan'))
            ->groupBy('users.name')
            ->orderByDesc('total_pesanan')
            ->limit(5)
            ->get();

        // Semua pesanan selesai untuk recap
        $recapPenjualan = Pesanan::where('status', 'selesai')->orderByDesc('created_at')->get();

        return view('admin.dashboard', compact(
            'penjualanBulanan',
            'stokMenipis',
            'produkTerlaris',
            'customerAktif',
            'recapPenjualan',
            'tahunTersedia'
        ));
    }

    public function print()
    {
        $recapPenjualan = Pesanan::where('status', 'selesai')->orderByDesc('created_at')->get();
        return view('admin.print-penjualan', compact('recapPenjualan'));
    }

    public function pdf()
{
    $recapPenjualan = Pesanan::where('status', 'selesai')->orderByDesc('created_at')->get();
    $pdf = FacadePdf::loadView('admin.print-penjualan', compact('recapPenjualan'));
    return $pdf->download('rekap-penjualan.pdf');
}


    public function dashboard(Request $request)
    {
        $query = Pesanan::with('user')->where('status', '!=', 'ditolak');

        // Filter berdasarkan bulan dan tahun
        if ($request->bulan) {
            $query->whereMonth('created_at', $request->bulan);
        }
        if ($request->tahun) {
            $query->whereYear('created_at', $request->tahun);
        }

        $recapPenjualan = $query->orderBy('created_at', 'desc')->get();

        $penjualanBulanan = Pesanan::selectRaw('MONTH(created_at) as bulan, SUM(total_harga) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $tahunTersedia = Pesanan::selectRaw('YEAR(created_at) as tahun')
            ->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        $stokMenipis = Produk::where('stok', '<', 10)->get();

        $produkTerlaris = DB::table('detail_pesanan')
            ->join('produk', 'produk.id', '=', 'detail_pesanan.produk_id')
            ->select('produk.nama', DB::raw('SUM(jumlah) as total_terjual'))
            ->groupBy('produk.nama')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        $customerAktif = Pesanan::select('user_id', DB::raw('COUNT(*) as total_pesanan'))
            ->groupBy('user_id')
            ->orderByDesc('total_pesanan')
            ->with('user')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'recapPenjualan',
            'penjualanBulanan',
            'stokMenipis',
            'produkTerlaris',
            'customerAktif',
            'tahunTersedia'
        ));
    }

}


