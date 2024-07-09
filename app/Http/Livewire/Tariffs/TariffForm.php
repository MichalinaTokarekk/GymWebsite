<?php

namespace App\Http\Livewire\Tariffs;

use App\Models\Tariff;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TariffForm extends Component
{   
    use Actions;
    use AuthorizesRequests;

    public Tariff $tariff;
    public Bool $editMode;

    public function rules()
    {
        return [
            'tariff.name' => [
                'required',
                'string',
                'min:2',
            ],
            'tariff.type' => [
                'required',
                'string',
                'min:2',
            ],
            'tariff.number' => [
                'required',
                'integer',
            ],
            'tariff.price' => [
                'required',
                'numeric_decimal',
            ],

        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(__('tariffs.attributes.name')),
            'type' => Str::lower(__('tariffs.attributes.type')),
            'number' => Str::lower(__('tariffs.attributes.number')),
            'tariff.price' => Str::lower(__('tariffs.attributes.price')),

        ];
    }

    public function mount(Tariff $tariff, Bool $editMode)
    {
        $this->tariff = $tariff;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.tariffs.tariff-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function save()
    {
        if ($this->editMode){
            $this->authorize('update', $this->tariff);
        } else {
            $this->authorize('create', Tariff::class);
        }
        sleep(1);
        $this->validate();
        $this->tariff->save();
        $this->notification()->success(
            $title = $this->editMode
            ? __('translation.messages.successes.updated_title')
            : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
            ? __('tariffs.messages.successes.updated', ['name' => $this->tariff->name])
            : __('tariffs.messages.successes.stored', ['name' => $this->tariff->name])

        );
        $this->editMode = true;
    }
}
