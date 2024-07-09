<div class="p-2">
    <form wire:submit.prevent="save">
        <h2 class="text-x1 font-semibold leading-tight text-center text-2xl" style="color:rgb(119, 57, 39); font-family:cursive">
            @if ($editMode)
                {{ __('branches.labels.edit_form_title') }}
            @else
                {{ __('branches.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="place">
                    {{ __('branches.attributes.place') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="branch.place" />
        </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">
                    {{ __('branches.attributes.name') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="branch.name" />
        </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="address">
                    {{ __('branches.attributes.address') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="branch.address" />
        </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="phone">
                    {{ __('branches.attributes.phone') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="branch.phone" />
        </div>
        </div>

    

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="elements">
                    {{ __('branches.attributes.elements') }}
                </label>
            </div>
            <div class="">
                <x-select multiselect placeholder="{{ __('translation.select') }}" wire:model="elementsIds" 
                :async-data="route('async.elements')" option-label="name" option-value="id" />
        </div>
        </div>



        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('branches.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>