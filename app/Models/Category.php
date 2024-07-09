<?php

namespace App\Models;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;


    
    protected $fillable = [
        'name',
    ];

    //RELACJA WIELE DO WIELU 

    public function competitions()
    {
        return $this->belongsToMany(Competition::class);
    }

}
