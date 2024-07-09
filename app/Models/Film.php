<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Film extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'title',
        'description',
        'video',
        ];

  
        
        
    public function videoUrl(): string
    {

        return $this->videoExists()
        ? Storage::url($this->video)
        : Storage::url(config('app.no-image'));
        dd($this->videoUrl);

    }


        public function videoExists(): bool
        {
            return $this->video !== null
                && Storage::disk('public')->exists($this->video);
        }
    
    
        
}
