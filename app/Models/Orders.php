<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'id', 'id_order');
    }

    public function details()
    {
        return $this->hasMany(Detail_Orders::class, 'id_order', 'id');
    }
}
