<?php

namespace App\Models;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Element extends Model
{
    use HasFactory;
    use SoftDelete;
    use SoftDeletes;


    
    protected $fillable = [
        'name',
    ];

   // RELACJA WIELE DO WIELU 

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

}
