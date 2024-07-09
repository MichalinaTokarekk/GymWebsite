<?php

namespace App\Http\Livewire\Cart;

use App\Support\OrderWizardState;
use App\Http\Livewire\Cart\CartStep;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cart\DeliveryStep;
use App\Http\Livewire\Cart\ConfirmOrderStep;
use Spatie\LivewireWizard\Components\WizardComponent;


class OrderWizard extends WizardComponent
{
    public function steps(): array
    {
        return [
            CartStep::class,
            DeliveryStep::class,
            ConfirmOrderStep::class,
        ];
    }

    public function initialState(): array
    {
        if(Auth::user()!=null)
        return [
            'delivery-step' => [
                'name' => Auth::user()->imie, Auth::user()->nazwisko 
            ],
        ];
        else
        return [];
    }

    public function stateClass(): string
    {
        return OrderWizardState::class;
    }
}
