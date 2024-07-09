<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Element;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class BranchController extends Controller
{

    public function index()
    {
        return view(
            'branches.index',
        );
    }
    
    public function create()
    {
        $this->authorize('create', Branch::class);
        return view(
            'branches.form'
        );
    }

   
    public function edit(Branch $branch)
    {

        $this->authorize('update', $branch);
        return view(
            'branches.form',
            [
                'branch' => $branch
            ]
        );
    }

    
}
