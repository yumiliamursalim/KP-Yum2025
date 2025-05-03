<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function detailPesanan()
{
    return $this->hasMany(DetailPesanan::class);
}

}
