<?php

namespace App\Http\Livewire\Cart;

use App\Models\Tariff;
use WireUi\Traits\Actions;
use App\Facades\CartService;
use Spatie\LivewireWizard\Components\StepComponent;

class CartStep extends StepComponent
{
    use Actions;

    public array $qty;

    public function mount() 
    {
        $this->qty = CartService::qty();
    }

    public function getItemProperty()
    {
        return Tariff::whereIn('id', array_keys($this->qty))->withTrashed()->get()->keyBy('id');
    }
    

    public function render()
    {
        $deletedItems = Tariff::onlyTrashed()->whereIn('id', array_keys($this->qty))->get()->keyBy('id');
        return view('livewire.cart.cart-step', compact('deletedItems'));
    }
    


    public function stepInfo(): array
    {
        return [
            'label' => __('order_wizard.cart.title'),
            'icon' => 'shopping-cart',
        ];
    }

    public function increaseQty(int $id)
    {
        $this->qty = CartService::increaseQty($id);
        $this->emit('cartUpdated');

    }

    public function decreaseQty(int $id) {
        if (isset($this->qty[$id]) && $this->qty[$id] > 1) {
            $this->qty = CartService::decreaseQty($id);
            $this->emit('cartUpdated');
        }
    }

    public function removeConfirmation(int $id)
    {
        $tariff = $this->item->get($id);
        $this->dialog()->confirm([
            'title' => __('cart.dialogs.remove.title'),
            'description' => __('cart.dialogs.remove.description', [
                'name' => optional($tariff)->name
            ]),
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'remove',
                'params' => $id,
            ],
            'reject' => [
                'label' => __('translation.no'),
            ]
        ]);
    }


    public function remove(int $id)
    {
        $this->qty = CartService::remove($id);
        $this->emit('cartUpdated');
    }
}
