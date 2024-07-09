<?php

namespace App\Support;

use App\Facades\CartService;
use App\Models\Tariff;
use Spatie\LivewireWizard\Support\State;

class OrderWizardState extends State
{
    public function order(): array
    {
        $deliveryStepState = $this->forStep('delivery-step');
        return [
            'name' => isset($deliveryStepState['name'])
                ? $deliveryStepState['name']
                :'',
            'street' => isset($deliveryStepState['street'])
                ? $deliveryStepState['street']
                :'',  
            'building_number' => isset($deliveryStepState['building_number'])
                ? $deliveryStepState['building_number']
                :'',
            'flat_number' => isset($deliveryStepState['flat_number'])
                ? $deliveryStepState['flat_number']
                :'',
            'city' => isset($deliveryStepState['city'])
                ? $deliveryStepState['city']
                :'',
            'postcode' => isset($deliveryStepState['postcode'])
                ? $deliveryStepState['postcode']
                :'',     
        ];
    }

    public function orderItems(): array
    {
        $orderQty = CartService::qty();
        $tariffs = Tariff::whereIn(
            'id',
            array_keys($orderQty)
        )->get()->keyBy('id');
        $qtyAndCost = [];
    foreach($orderQty as $id => $qty) {
        $qtyAndCost[$id] = [
            'qty' => $qty,
            'price' => optional($tariffs->get($id))->price,
            'cost' => $qty * optional($tariffs->get($id))->price,
        ];
        
    }
    return $qtyAndCost;
    }

    public function totalQtyItems(): int
    {
        return count(CartService::qty());
    }

    public function totalCost(): float
    {
        $sum = 0.0;
        foreach ($this->orderItems() as $item) {
            $sum += $item['cost'];
        }
        return $sum;
    }
}
