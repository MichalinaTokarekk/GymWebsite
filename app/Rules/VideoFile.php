<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VideoFile implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Dodaj tutaj logikę walidacji dla czasu kalendarza
        $allowedExtensions = ['mp4', 'avi', 'mov', 'mkv']; // Przykładowe rozszerzenia dozwolonych plików wideo

        $extension = pathinfo($value, PATHINFO_EXTENSION);

        return in_array(strtolower($extension), $allowedExtensions);
    }

    public function message()
    {
        return ':attribute musi być prawidłowym plikiem wideo.';
    }
}