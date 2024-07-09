<div class="p-2">
    <form wire:submit.prevent="save">
        <h2 class="text-x1 font-semibold leading-tight text-center text-2xl" style="color:rgb(119, 57, 39); font-family:cursive">
            @if ($editMode)
                {{ __('shops.labels.edit_form_title') }}
            @else
                {{ __('shops.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="title">
                    {{ __('shops.attributes.title') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="shop.title" />
        </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="link">
                    {{ __('shops.attributes.link') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="shop.link" />
        </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="description">
                    {{ __('shops.attributes.description') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="shop.description" />
        </div>
        </div>


         <hr class="my-2">
            <div class="grid grid-cols-2 gap-2">
                 <div class="">
                      <label for="image">{{ __('shops.attributes.image') }}
                </div>
                   <div class="">
                         @if ($imageExists)
                             <div class="relative">
                                <img class="w-full" src="{{ $imageUrl }}" alt="{{ $shop->name }}">
                                <div class="absolute top-2 right-2 h-16">
                                    <x-button.circle outline xs secondary icon="trash" wire:click="deleteImageConfirm" />

                                </div>
                            </div>
                        @else
                            <x-input type="file" wire:model="image" />
                        @endif
                    </div>
                </div>




        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('shops.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>