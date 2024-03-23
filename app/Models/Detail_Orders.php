<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Orders extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'id_order', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'id_product', 'id');
    }
    public function ukuran()
    {
        return $this->belongsTo(Variasi_Ukurans::class, 'id_ukuran', 'id');
    }
    public function warna()
    {
        return $this->belongsTo(Variasi_Warnas::class, 'id_warna', 'id');
    }
}
