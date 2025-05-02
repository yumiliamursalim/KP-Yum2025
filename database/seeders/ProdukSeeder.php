<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produkList = [
            ['Bayam Segar', 'sayur', 5000],
            ['Wortel Manis', 'sayur', 6000],
            ['Tomat Merah', 'sayur', 7000],
            ['Kangkung Organik', 'sayur', 4000],
            ['Brokoli Hijau', 'sayur', 8000],
            ['Selada Hijau', 'sayur', 4500],
            ['Timun Segar', 'sayur', 3500],
            ['Kol Putih', 'sayur', 5500],
            ['Cabai Merah', 'sayur', 9000],
            ['Terong Ungu', 'sayur', 5000],
            ['Apel Fuji', 'buah', 10000],
            ['Jeruk Sunkist', 'buah', 9500],
            ['Pisang Raja', 'buah', 7000],
            ['Anggur Merah', 'buah', 12000],
            ['Semangka Segar', 'buah', 15000],
            ['Melon Hijau', 'buah', 13000],
            ['Mangga Harum', 'buah', 11000],
            ['Nanas Manis', 'buah', 9000],
            ['Pepaya California', 'buah', 8500],
            ['Strawberry Segar', 'buah', 14000],
        ];

        foreach ($produkList as $item) {
            $nama = $item[0];
            $kategori = $item[1];
            $harga = $item[2];

            Produk::create([
                'nama' => $nama,
                'kategori' => $kategori,
                'harga' => $harga,
                'stok' => rand(10, 100),
                'deskripsi' => $nama . ' berkualitas tinggi dan segar.',
                'foto' => strtolower(str_replace(' ', '-', $nama)) . '.jpg', // contoh: bayam-segar.jpg
            ]);
        }
    }
}
