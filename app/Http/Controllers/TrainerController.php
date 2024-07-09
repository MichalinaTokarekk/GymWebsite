<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TrainerController extends Controller
{
    public function index()
    {
        // $this->authorize('viewAny', Trainer::class);
        return view(
            'trainers.index'
        );
    }

    public function create()
    {
        $this->authorize('create', Trainer::class);
        return view(
            'trainers.form'
        );
    }

   
    public function edit(User $trainer)
    {

        $this->authorize('update', $trainer);
        return view(
            'trainers.form',
            [
                'trainer' => $trainer
            ]
        );
    }

     
    public function show(User $trainer)
    {
       
        // $this->authorize('show', $trainer);
        return view(
            'trainers.show',
            [
                'trainer' => $trainer
            ]
        );
    }

    public function async(Request $request)
    {
        $this->authorize('viewAny', User::class);
        return User::query()
            ->select('id', 'imie', 'nazwisko')
            ->orderBy('nazwisko')
            ->when(
                $request->search,
                fn (Builder $query) 
                    => $query->where('nazwisko', 'like', "%{$request->search}%")
            )->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn(
                    'id',
                    $request->input('selected', []),
                ),
                fn (Builder $query) => $query->limit(30)
            )
            ->get();
    }

}
