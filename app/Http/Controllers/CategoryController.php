<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    public function index()
    {
        // $this->authorize('viewAny', Category::class);
        return view(
            'categories.index'
        );
    }

    public function create()
    {
        $this->authorize('create', Category::class);
        return view(
            'categories.form'
        );
    }

   
    public function edit(Category $category)
    {

        $this->authorize('update', $category);
        return view(
            'categories.form',
            [
                'category' => $category
            ]
        );
    }

    public function async(Request $request)
    {
        $this->authorize('viewAny', Category::class);
        return Category::query()
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
