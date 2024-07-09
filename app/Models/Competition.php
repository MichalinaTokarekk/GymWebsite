<?php

namespace App\Models;

use App\Models\User;
use App\Models\Trainer;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{

    use HasFactory;
    use SoftDeletes;
    
    
    protected $fillable = [
        'title',
        'description',
        'date',
        'trainer_id',
        ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value === null) {
                    return null;
                }
                return config('filesystems.competitions_dir')
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

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
