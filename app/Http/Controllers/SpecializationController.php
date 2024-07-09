<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class SpecializationController extends Controller
{

    public function index()
    {
        // $this->authorize('viewAny', Specialization::class);
        return view(
            'specializations.index'
        );
    }

    public function create()
    {
        $this->authorize('create', Specialization::class);
        return view(
            'specializations.form'
        );
    }

   
    public function edit(Specialization $specialization)
    {

        $this->authorize('update', $specialization);
        return view(
            'specializations.form',
            [
                'specialization' => $specialization
            ]
        );
    }

    public function async(Request $request)
    {
        $this->authorize('viewAny', Specialization::class);
        return Specialization::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) 
                    => $query->where('name', 'like', "%{search->search}%")
            )->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn(
                    'id',
                    array_map(
                        fn (array $item) => $item['id'],
                        array_filter(
                            $request->input('selected', []),
                            fn ($item) => (is_array($item) && isset($item['id']))
                        )
                    )
                ),
                fn (Builder $query) => $query->limit(30)
            )->get();
    }
    
}
