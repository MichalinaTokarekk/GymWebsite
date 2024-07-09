<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Tariff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'tariff_id',
        'order_id',
        'qty', 
        'price',
    ];
    protected $casts = [ 
       'price' => 'float'
    ];
       
    public function order()
    {
       return $this->belongsTo(Order::class);
    }
       
    public function tariff()
    {
       return $this->belongsTo(Tariff::class);
    }

    protected function cost(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => ($attributes['price'] * $attributes['qty']),
        );
    }
       
}
