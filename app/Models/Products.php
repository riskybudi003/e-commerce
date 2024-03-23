<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });
    }



    public function category()
    {
        return $this->belongsTo(Categorys::class, 'id_category', 'id');
    }

    public function order()
    {
        return $this->hasMany(Orders::class, 'id_product', 'id');
    }
    public function ukuran()
    {
        return $this->hasMany(Variasi_Ukurans::class, 'id_product', 'id');
    }
    public function warna()
    {
        return $this->hasMany(Variasi_Warnas::class, 'id_product', 'id');
    }
}
