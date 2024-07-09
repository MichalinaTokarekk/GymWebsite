<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompetitionController extends Controller
{ 
    public function index()
    {
        // $this->authorize('viewAny', Competition::class);
        return view(
            'competitions.index',
        );
        // dd(
        //     Competition::with(['categories'])->get()->first()
        // );
    }

    public function create()
    {
        $this->authorize('create', Competition::class);
        return view(
            'competitions.form'
        );
    }

   
    public function edit(Competition $competition)
    {

        $this->authorize('update', $competition);
        return view(
            'competitions.form',
            [
                'competition' => $competition
            ]
        );
    }

     
    public function show(Competition $competition)
    {
       // dd($competition->trainer);
       
        // $this->authorize('show', $competition);
        $model = Competition::find($competition);
        return view(
            'competitions.show',
            [
                'competition' => $competition, compact('model')
            ]
        );
    }

    public function record(Competition $model)
    {
      
        $this->authorize('record', $model);
        $user = Auth::user();
        return view(
            'competitions.record', //tutaj zwraca sie widok z katalogu resources/views/competitions/record.blade
            [
                'model' => $model
            ],
            compact('user')
        );
    }

    public function participants($id)
{
    $competition = Competition::with('users')->find($id);

    if (!$competition) {
        abort(404); // Competition not found
    }

    $users = $competition->users ?? [];
    // dd($users);

    return view('competitions.participants', compact('users', 'competition'));
}



    


}
