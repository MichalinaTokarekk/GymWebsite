<?php

namespace App\Models;


use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'user_id',
        'name',
        'street',
        'building_number',
        'flat_number',
        'city',
        'postcode', 
        'total_cost',
    ];
        
    protected $casts = [
        'total_cost' => 'float'
    ];
        
    public function user(){
        return $this->belongsTo(User::class);
    }
        
    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    protected function number(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => sprintf('#%010d',$this->id),
        );
    }

    public function tariffs()
{
    return $this->hasMany(OrderItem::class)->with('tariff');
}
}
