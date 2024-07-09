<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ActivityController extends Controller
{
    public function index()
    {
        // $this->authorize('viewAny', Activity::class);
        return view(
            // 'activities.index'
            'activities.grid'
        );
    }

    public function create()
    {
        $this->authorize('create', Activity::class);
        return view(
            'activities.form'
        );
    }

   
    public function edit(Activity $activity)
    {
        $this->authorize('update', $activity);
        return view(
            'activities.form',
            [
                'activity' => $activity
            ]
        );
    }

    public function show(Activity $activity)
    {
        // $this->authorize('viewAny', $activity);
        return view(
            'activities.show',
            [
                'activity' => $activity,
                'user' => User::find($activity->trainer_id)
            ]
        );
    }

    // public function async(Request $request)
    // {
    //     $this->authorize('viewAny', Activity::class);
    //     return Activity::query()
    //         ->select('id', 'name')
    //         ->orderBy('name')
    //         ->when(
    //             $request->search,
    //             fn (Builder $query) 
    //                 => $query->where('name', 'like', "%{search->search}%")
    //         )->when(
    //             $request->exists('selected'),
    //             fn (Builder $query) => $query->whereIn(
    //                 'id',
    //                 array_map(
    //                     fn (array $item) => $item['id'],
    //                     array_filter(
    //                         $request->input('selected', []),
    //                         fn ($item) => (is_array($item) && isset($item['id']))
    //                     )
    //                 )
    //             ),
    //             fn (Builder $query) => $query->limit(30)
    //         )->get();
    // }

    public function async(Request $request)
    {
        $this->authorize('viewAny', Activity::class);
        return Activity::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) 
                    => $query->where('name', 'like', "%{$request->search}%")
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
