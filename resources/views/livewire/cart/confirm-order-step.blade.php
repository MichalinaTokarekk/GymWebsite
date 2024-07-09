<div>
    <x-order-wizard.steps-bar :steps="$steps" />
    <div class="p-4">
        <div class="m-4">
            <x-card class="bg-gray-50" shadow="false">
                <div class="grid grid-cols-1 gap-2 md:grid-cols-2 md:gap-4"> 
                    <div class="flex items-start">
                        <div class="flex-1">
                            <h3 class="font-bold leading-6 text-gray-900">
                                {{ __('order_wizard.confirm_order.title') }} 
                            </h3>
                            <span class="text-sm text-gray-600">
                                {{ __('order_wizard.confirm_order.labels.delivery_name') }}: 
                                {{ $delivery['name'] }}
                            </span>
                            <span class="flex justify-start text-sm text-gray-600">
                                {{ __('order_wizard.confirm_order.labels.delivery_street') }}: 
                                {{ $delivery['street'] }}
                            </span>
                            <span class="flex justify-start text-sm text-gray-600">
                                {{ __('order_wizard.confirm_order.labels.delivery_building_number') }}: 
                                {{ $delivery['building_number'] }}
                            </span>
                            <span class="flex justify-start text-sm text-gray-600">
                                {{ __('order_wizard.confirm_order.labels.delivery_flat_number') }}: 
                                {{ $delivery['flat_number'] }}
                            </span>
                            <span class="flex justify-start text-sm text-gray-600">
                                {{ __('order_wizard.confirm_order.labels.delivery_city') }}: 
                                {{ $delivery['city'] }}
                            </span>
                            <span class="flex justify-start text-sm text-gray-600">
                                {{ __('order_wizard.confirm_order.labels.delivery_postcode') }}: 
                                {{ $delivery['postcode'] }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="flex-1">
                            <h3 class="font-bold leading-6 text-gray-900">
                                {{ __('order_wizard.confirm_order.labels.total_cost') }} 
                            </h3>
                            <span class="text-sm text-gray-600">
                                {{ __('order_wizard.confirm_order.labels.total_qty_items') }}: {{ $totalQtyItems }}
                            </span>
                            <span class="flex justify-start text-sm text-gray-600">
                                {{ __('order_wizard.confirm_order.labels.total_cost') }}:
                                {{ number_format($totalCost, 2) }} {{ __('translation.currency') }}
                            </span>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
        <div class="m-4"> 
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            {{ __('order_wizard.confirm_order.columns.product') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('order_wizard.confirm_order.columns.qty') }}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('order_wizard.confirm_order.columns.unit_price') }} 
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{ __('order_wizard.confirm_order.columns.cost') }}
                        </th>
                    </tr>   
                </thead>
                <tbody>
                    @foreach ($this->items as $id => $tariff)
                        @if ($orderItems[$id]['qty'] > 0)  {{-- Dodaj warunek, który sprawdza, czy ilość pozycji jest większa od zera --}}
                            <tr class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover">
                                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white"> 
                                    {{ $tariff->name }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $orderItems[$id]['qty'] }}
                                </td>
                                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                    {{ number_format($orderItems[$id]['price'], 2) }} {{ __('translation.currency') }}
                                </td>
                                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                    {{ number_format($orderItems[$id]['cost'], 2) }} {{ __('translation.currency') }} 
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="m-4 flex justify-between"> 
            <x-button wire:click="previousStep" icon="chevron-double-left" 
                label="{{ __('order_wizard.delivery.title') }}" secondary spinner />
            <x-button wire:click="submit" right-icon="chevron-double-right"
                label="{{ __('order_wizard.confirm_order.labels.confirm_order') }}" primary spinner />
        </div>
    </div>
</div>
