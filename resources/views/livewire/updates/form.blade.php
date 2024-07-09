<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-x1 font-semibold   style='text-align: center' leading-tight  text-center text-2xl" style="color: #F25C05">
            @if ($editMode)
                {{ __('updates.labels.edit_form_title') }}
            @else
                {{ __('updates.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="title">
                    {{ __('updates.attributes.nazwa') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="update.title" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="description">
                    {{ __('updates.attributes.opis') }}
                </label>

            </div>
            <div class="">
                <x-textarea placeholder="{{ __('translation.enter') }}"
                    wire:model="update.description" />
        </div>
        </div>

      

         <hr class="my-2">
            <div class="grid grid-cols-2 gap-2">
                 <div class="">
                      <label for="image">{{ __('updates.attributes.image') }}
                </div>
                   <div class="">
                         @if ($imageExists)
                             <div class="relative">
                                <img class="w-full" src="{{ $imageUrl }}" alt="{{ $update->nazwa }}">
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
            <x-button href="{{ route('updates.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>