<div class="p-2">
    <form wire:submit.prevent="save">
     <h3 class="text-x1 font-semibold leading-tight text-gray-800">
            @if 
                {{ __('competitions.labels.zapis_form') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="imie">
                    {{ __('competitions.attributes.zapis.imie') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="competition.imie" />
        </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="nazwisko">
                    {{ __('competitions.attributes.nazwisko') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="competition.nazwisko" />
        </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="numertelefonu">
                    {{ __('competitions.attributes.numertelefonu') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="competition.numertelefonu" />
        </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="e-mail">
                    {{ __('competitions.attributes.e-mail') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="competition.e-mail" />
        </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="categories">
                    {{ __('competitions.attributes.categories') }}
                </label>
            </div>
            <div class="">
                <x-select placeholder="{{ __('translation.select') }}" wire:model="categoriesIds" 
                :async-data="route('async.categories')" option-label="name" option-value="id" />
        </div>
        </div>


        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('competitions.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>