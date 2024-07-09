<?php

namespace App\Http\Livewire\Cart;

use Illuminate\Support\Str;
use Spatie\LivewireWizard\Components\StepComponent;

class DeliveryStep extends StepComponent
{
    public string $name = '';
    public string $address = '';
    public string $street = '';
    public string $building_number = '';
    public string $flat_number = '';
    public string $city = '';
    public string $postcode = '';



    public array $rules = [
        'name' => 'required|min:2',
        'street' => 'required|min:2',
        'building_number' => 'required',
        'flat_number' => '',
        'city'=> 'required',
        'postcode' => ['required', 'regex:/^\d{2}-\d{3}$/'],
    ];

    public function validationAttributes()
    {
        return [
            'name' => Str::lower(__('order_wizard.delivery.attribute.name')),
            'street' => Str::lower(__('order_wizard.delivery.attribute.street')),
            'building_number' => Str::lower(__('order_wizard.delivery.attribute.building_number')),
            'flat_number' => Str::lower(__('order_wizard.delivery.attribute.flat_number')),
            'city'=> Str::lower(__('order_wizard.delivery.attribute.city')),
            'postcode' => Str::lower(__('order_wizard.delivery.attribute.postcode')),
        ];
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('order_wizard.delivery.title'),
            'icon' => __('location-marker')
        ];
    }

    public function update($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.cart.delivery-step');
    }
}
