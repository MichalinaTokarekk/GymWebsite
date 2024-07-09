<?php

namespace App\Http\Livewire\Cart;

use App\Models\Order;
use App\Models\Tariff;
use App\Models\OrderItem;
use App\Facades\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Jetstream;
use Spatie\LivewireWizard\Step;
use App\Events\OrderedEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderedMail;
use Spatie\LivewireWizard\Components\StepComponent;
use WireUi\Traits\Actions;

class ConfirmOrderStep extends StepComponent
{
    use Actions;

    public $orderItems;

    public function mount()
    {
        $this->orderItems = $this->state()->orderItems();
    }


    public function getItemsProperty()
    {
        return Tariff::whereIn(
            'id',
            array_keys($this->orderItems)
        )->get()->keyBy('id');
    }

    public function stepInfo(): array
    {
        return [
            'label' => __('order_wizard.confirm_order.title'),
            'icon' => 'check',
        ];
    }

    public function submit()
    {
        $orderData = $this->state()->order();
        $orderItemsData = $this->orderItems;
        $totalCost = $this->state()->totalCost();

        $order = DB::transaction(function () use ($orderData, $orderItemsData, $totalCost) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $orderData['name'],
                'street' => $orderData['street'],
                'building_number' => $orderData['building_number'],
                'flat_number' => $orderData['flat_number'],
                'city' => $orderData['city'],
                'postcode' => $orderData['postcode'],
                'total_cost' => $totalCost,
            ]);

            foreach ($orderItemsData as $tariffId => $orderItemData) {
                $tariff = Tariff::find($tariffId);

                // Dodaj taryfę do użytkownika
                Auth::user()->tariffs()->attach($tariffId, [
                    'name' => $tariff->name,
                    'type' => $tariff->type,
                    'number' => $tariff->number,
                    'qty' => $orderItemData['qty'],
                ]);

                OrderItem::create([
                    'tariff_id' => $tariffId,
                    'order_id' => $order->id,
                    'qty' => $orderItemData['qty'],
                    'price' => $orderItemData['price'],
                ]);
            }

            return $order;
        });

        CartService::clear();
        $this->emit('cartUpdated');
        $this->notification()->success(
            $title = __('order_wizard.confirm_order.messages.successes.ordered.title'),
            $description = __('order_wizard.confirm_order.messages.successes.ordered.description', [
                'total_cost' => number_format($totalCost, 2) . ' ' . __('translation.currency'),
            ]),
        );
        OrderedEvent::dispatch($order);
        $this->showStep('cart-step');
    }

    public function render()
    {
        $nonDeletedItemCount = 0;

        foreach ($this->orderItems as $tariffId => $orderItemData) {
            $tariff = Tariff::find($tariffId);
            if ($tariff && !$tariff->trashed()) {
                $nonDeletedItemCount += $orderItemData['qty'];
            }
        }

        $totalQtyItems = $nonDeletedItemCount;

        return view(
            'livewire.cart.confirm-order-step', [
                'delivery' => $this->state()->order(),
                'totalQtyItems' => $totalQtyItems,
                'totalCost' => $this->state()->totalCost(),
            ]
        );
    }
}
