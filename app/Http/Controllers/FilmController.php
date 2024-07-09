<?php

namespace App\Http\Controllers;
use App\Models\Film;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        
        return view(
            'films.index'
        );
    }

    public function create()
    {
        $this->authorize('create', Film::class);
        return view(
            'films.form'
        );
    }

   
    public function edit(Film $film)
    {

        $this->authorize('update', $film);
        return view(
            'films.form',
            [
                'film' => $film
            ]
        );
    }

     
    public function show(Film $film)
    {
       
        $this->authorize('film', $film);
        return view(
            'films.show',
            [
                'film' => $film
            ]
        );
    }

    public function getFile($file_name)
    {
        // Określenie ścieżki do pliku w Storage
        $path = 'public/' . $file_name; 

        if (Storage::exists($path)) {
            $plik = Storage::get($path);

            // Określ typ MIME pliku (np. dla wyświetlenia obrazu)
            $mime_type = Storage::mimeType($path);

            // Zwróć plik jako odpowiedź HTTP
            return response($plik)
                ->header('', $mime_type);
        } else {
         return null;
        }
    }

    public function download($file_name)
    {
        // Określenie ścieżki do pliku w Storage
        $path = 'public/' . $file_name;

        if (Storage::exists($path)) {
            $plik = Storage::get($path);

            // Określ typ MIME pliku (np. dla wyświetlenia obrazu)
            $mime_type = Storage::mimeType($path);

            // Zwróć plik jako odpowiedź HTTP z nagłówkiem do pobierania
            return response($plik)
                ->header('Content-Type', $mime_type)
                ->header('Content-Disposition', 'attachment; filename=' . $file_name);
        } else {
            return response()->json(['message' => 'Plik nie istnieje'], 404);
        }
    }


}
