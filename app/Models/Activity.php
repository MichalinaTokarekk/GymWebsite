<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'trainer_id'
        ];

    // RELACJE
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function events()
	{
		return $this->hasMany(Event::class);
	}

    // SEKCJA ZDJĘCIA
    protected function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value === null) {
                    return null;
                }
                return config('filesystems.activities_dir')
                    . '/' . $value;
            },
        );
    }
    public function imageUrl(): string
    {
        return $this->imageExists()
        ? Storage::url($this->image)
        : Storage::url(config('app.no-image'));
    }

    public function imageExists(): bool
    {
        return $this->image !== null
            && Storage::disk('public')->exists($this->image);
    }
 

}
