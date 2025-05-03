<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = "Produk";

    protected $fillable = [
        'nama',
        'kategori',
        'harga',
        'stok',
        'deskripsi',
        'foto',
    ];
    public function keranjang()
{
    return $this->hasMany(Keranjang::class);
}

public function detailPesanan()
{
    return $this->hasMany(DetailPesanan::class);
}

    
}

