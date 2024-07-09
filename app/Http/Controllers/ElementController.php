<?php

namespace App\Http\Controllers;

use App\Models\Element;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ElementController extends Controller
{


    public function index($model)
    {
        
        return view(
            'elements.index',
            [
                'elements' => $model
            ]
             
        );
    }


    public function async(Request $request)
    {
        return Element::query()
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
