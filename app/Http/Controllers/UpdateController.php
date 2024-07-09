<?php

namespace App\Http\Controllers;

use App\Models\Update;
use Illuminate\Http\Request;


class UpdateController extends Controller
{
    public function index()
    {
        // $this->authorize('viewAny', Update::class);
        return view(
            'updates.index'
        );
    }

    public function create()
    {
        $this->authorize('create', Update::class);
        return view(
            'updates.form'
        );
    }

   
    public function edit(Update $update)
    {

        $this->authorize('update', $update);
        return view(
            'updates.form',
            [
                'update' => $update
            ]
        );
    }

    public function show(Update $update)
    {
       
        // $this->authorize('show', $trainer);
        return view(
            'updates.show',
            [
                'update' => $update
            ]
        );
    }
}
