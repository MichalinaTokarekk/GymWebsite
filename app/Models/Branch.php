<?php

namespace App\Models;

use App\Models\Element;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Branch extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'place',
        'name',
        'address',
        'phone',
    ];

    public function elements()
    {
        return $this->belongsToMany(Element::class);
    }




}
