<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    public function pesanan()
{
    return $this->belongsTo(Pesanan::class);
}

public function produk()
{
    return $this->belongsTo(Produk::class);
}

}
