<div>
    <x-order-wizard.steps-bar :steps="$steps" />
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{__('order_wizard.delivery.attribute.name')}} </label>
                </div>
            <div class="">
                <x-input placeholder="{{__('translation.enter')}}" wire:model="name" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="col-span-1">
                <label for="postcode">{{__('Ulica')}} </label>
            </div>
            <div class="col-span-1">
                <x-input placeholder="{{__('translation.enter')}}" wire:model="street" />
            </div>
        </div>

    <hr class="my-2">
    <div class="grid grid-cols-2 gap-2">
        <div class="col-span-1">
            <label for="postcode">{{__('Nr bloku')}} </label>
        </div>
        <div class="col-span-1">
            <x-input placeholder="{{__('translation.enter')}}" wire:model="building_number" />
        </div>
    </div>

    <hr class="my-2">
    <div class="grid grid-cols-2 gap-2">
        <div class="col-span-1">
            <label for="postcode">{{__('Nr mieszkania')}} </label>
        </div>
        <div class="col-span-1">
            <x-input placeholder="{{__('translation.enter')}}" wire:model="flat_number" />
        </div>
    </div>

    <hr class="my-2">
    <div class="grid grid-cols-2 gap-2">
        <div class="col-span-1">
            <label for="postcode">{{__('Miasto')}} </label>
        </div>
        <div class="col-span-1">
            <x-input placeholder="{{__('translation.enter')}}" wire:model="city" />
        </div>
    </div>

    <hr class="my-2">
    <div class="grid grid-cols-2 gap-2">
        <div class="col-span-1">
            <label for="postcode">{{__('Kod pocztowy')}} </label>
        </div>
        <div class="col-span-1">
            <x-input placeholder="{{__('translation.enter')}}" wire:model="postcode" />
        </div>
    </div>

    <div class="m-4 flex justify-between">
        <x-button wire:click="previousStep" icon="chevron-double-left" label="{{__('order_wizard.cart.title')}}"
            secondary spinner />

        <x-button wire:click="submit" right-icon="chevron-double-right" label="{{__('order_wizard.confirm_order.title')}}" primary spinner />
    </div>
</div>
</div>

