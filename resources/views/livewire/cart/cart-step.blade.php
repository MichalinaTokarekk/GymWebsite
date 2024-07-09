<div>
    <x-order-wizard.steps-bar :steps="$steps" />
    <div class="">
        @if (count($qty) === 0)
            <div class="mt-2 mb-2 text-center">{{ __('order_wizard.cart.labels.empty') }}</div>
        @else
            <div class="p-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                {{ __('order_wizard.cart.columns.tariff') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('order_wizard.cart.columns.qty') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('order_wizard.cart.columns.unit_price') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ __('order_wizard.cart.columns.cost') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->item as $tariff)
                            <tr
                                class="{{ $deletedItems->has($tariff->id) ? 'bg-red-100 line-through' : 'bg-white' }} hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                                <td class="py-4 px-6 font-semibold {{ $deletedItems->has($tariff->id) ? 'text-red-500' : 'text-gray-900 dark:text-white' }}">
                                    @if ($deletedItems->has($tariff->id))
                                        <del title="Ten przedmiot został usunięty przez pracownika, prosimy o usunięcie przedmiotu z koszyka. Przepraszamy za kłopot">{{ $tariff->name }}</del>
                                    @else
                                        {{ $tariff->name }}
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <button wire:click="decreaseQty({{ $tariff->id }})"
                                            @if ($qty[$tariff->id] === 1) disabled @endif
                                            class="inline-flex items-center rounded-full border border-gray-300 bg-white p-1 text-sm font-medium text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                            type="button">
                                            <span class="sr-only">{{ __('order_wizard.cart.labels.decrease_qty') }}</span>
                                            <x-icon name="minus" class="h-4 w-4" />
                                        </button>
                                        <div>
                                            <x-input readonly wire:model="qty.{{ $tariff->id }}"
                                                class="inline-flex items-center rounded-full border border-gray-300 bg-gray-50 px-2.5 py-1 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark-border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" />
                                        </div>
                                        <button wire:click="increaseQty({{ $tariff->id }})"
                                            class="inline-flex items-center rounded-full border border-gray-300 bg-white p-1 text-sm font-medium text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                            type="button">
                                            <span class="sr-only">{{ __('order_wizard.cart.labels.increase_qty') }}</span>
                                            <x-icon name="plus" class="h-4 w-4" />
                                        </button>
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                    {{ $tariff->price }} {{ __('translation.currency') }}
                                </td>
                                <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                                    {{ $tariff->cost($qty[$tariff->id]) }} {{ __('translation.currency') }}
                                </td>
                                <td class="py-4 px-6">
                                    <x-button.circle outline xs secondary icon="trash"
                                        wire:click="removeConfirmation({{ $tariff->id }})" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-end m-4">
                    <x-button wire:click="nextStep" right-icon="chevron-double-right"
                        label="{{ __('order_wizard.delivery.title') }}" primary spinner />
                </div>
            </div>
        @endif
    </div>
</div>
