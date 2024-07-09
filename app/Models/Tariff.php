<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tariff extends Model
{

    use SoftDeletes;

    
    protected $fillable = [
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
        return $this->belongsToMany(User::class); // Use the correct table name here
    }


        public function setDataRozpoczeciaAttribute($value)
    {
        $this->attributes['data_rozpoczecia'] = Carbon::createFromFormat('Y-m-d', $value);
    }

    public function getDataRozpoczeciaAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getDataZakonczeniaAttribute()
    {
        if ($this->type === 'okresowy') {
            return Carbon::parse($this->data_rozpoczecia)->addDays($this->number)->toDateString();
        }

        return "---------- "; // dotyczy to typu ilosciowego bo wtedy nie obejmuje daty ;) 
    }
    

}
