<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'head', 'questionContent',
    ];

    // Jeśli chcesz określić niestandardową nazwę tabeli, możesz to zrobić w ten sposób:
    protected $table = 'question';

    // Relacja do innych modeli, jeśli to konieczne
    // Na przykład, jeśli pytania są powiązane z użytkownikami, możesz to zrobić tak:
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

}
