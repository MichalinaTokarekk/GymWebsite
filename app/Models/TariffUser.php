<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TariffUser extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'user_id',
        'tariff_id',
        'name',
        'type',
        'number',
        'price',
        'qty',
        'data_rozpoczecia',
        'data_zakonczenia',
    ];

    protected $casts = [
        'price' => 'float',
        // 'data_rozpoczecia' => 'date',
    ];

    public function cost(int $qty): float
    {
        return $this->price * $qty;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
