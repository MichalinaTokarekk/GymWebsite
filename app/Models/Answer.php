<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'comment',
    ];

    // Jeśli chcesz określić niestandardową nazwę tabeli, możesz to zrobić w ten sposób:
    protected $table = 'answer';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
