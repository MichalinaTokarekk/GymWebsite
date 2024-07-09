<?php

namespace App\Http\Livewire\Branches;

use App\Models\Branch;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BranchForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;
    public Branch $branch;
    public Bool $editMode;
    public $elementsIds;


    public function rules()
    {
        return [
            'branch.place' => [
                'required',
                'string',
                'min:3',
            ],
            'branch.name' => [
                'required',
                'min: 3',
            ],
            'branch.address' => [
                'string',
                'required',
            ],
            'branch.phone' => [
                'string',
                'required',
                // 'regex:/^\+?[0-9]+$/',
            ],
        
        ];
    }

    public function validationAttributes()
    {
        return[

         
            'place' => Str::lower(__('branches.attributes.place')),
            'name' => Str::lower(__('branches.attributes.name')),
            'address' => Str::lower(__('branches.attributes.address')),
            'phone' => Str::lower(__('branches.attributes.phone')),
            'elementsIds' => Str::lower(__('branches.attributes.elementsIds')),

        ];
    }

    public function mount(Branch $branch, Bool $editMode)
    {
        $this->branch = $branch;
        $this->elementsIds = $this->branch->elements->toArray();

        $this->editMode = $editMode;

    }

    public function render()
    {
        return view('livewire.branches.branch-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->branch);
        } else {
            $this->authorize('create', Branch::class);
        }
    
        $this->validate();
 
        $branch = $this->branch;
        $elementsIds = $this->elementsIds;
        
        DB::transaction(function() use ($branch,$elementsIds)
        {
        
                $branch->save();
                $branch->elements()->sync($elementsIds);
    
            
        });

        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('branches.messages.successes.updated', ['name' => $this->branch->name])
                : __('branches.messages.successes.stored', ['name' => $this->branch->name]),

        );

        $this->editMode = true;

    }

}
