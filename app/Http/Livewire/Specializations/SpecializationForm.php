<?php

namespace App\Http\Livewire\Specializations;

use Livewire\Component;
use App\Models\Specialization;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class SpecializationForm extends Component
{   
    use Actions;
    use AuthorizesRequests;

    public Specialization $specialization;
    public Bool $editMode;

    public function rules()
    {
        return [
            'specialization.name' => [
                'required',
                'string',
                'min:2',
                'unique:specializations,name' . 
                    ($this->editMode ? (',' . $this->specialization->id) : ''),

            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(__('specializations.attributes.name')),
        ];
    }

    public function mount(Specialization $specialization, Bool $editMode)
    {
        $this->specialization = $specialization;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.specializations.specialization-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function save()
    {
        if ($this->editMode){
            $this->authorize('update', $this->specialization);
        } else {
            $this->authorize('create', Specialization::class);
        }
        sleep(1);
        $this->validate();
        $this->specialization->save();
        $this->notification()->success(
            $title = $this->editMode
            ? __('translation.messages.successes.updated_title')
            : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
            ? __('specializations.messages.successes.updated', ['name' => $this->specialization->name])
            : __('specializations.messages.successes.stored', ['name' => $this->specialization->name])

        );
        $this->editMode = true;
    }
}
