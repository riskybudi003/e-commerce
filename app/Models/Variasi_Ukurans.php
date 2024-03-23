<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variasi_Ukurans extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Products::class, 'id_product', 'id');
    }

    public function detail_order()
    {
        return $this->hasMany(Detail_Orders::class, 'id_ukuran', 'id');
    }
}
