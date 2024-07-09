<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-x1 font-semibold   style='text-align: center' leading-tight  text-center text-2xl" style="color: #F25C05">
            @if ($editMode)
                {{ __('competitions.labels.edit_form_title') }}
            @else
                {{ __('competitions.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="title">
                    {{ __('competitions.attributes.title') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="competition.title" />
        </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="description">
                    {{ __('competitions.attributes.description') }}
                </label>
            </div>
            <div class="">
                <x-textarea placeholder="{{ __('translation.enter') }}"
                    wire:model="competition.description" />
        </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="categories">
                    {{ __('competitions.attributes.date') }}
                </label>
            </div>
            <div class="">
                <x-input type="date" placeholder="{{ __('translation.enter') }}"
                    wire:model="competition.date" />
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
                <x-select multiselect placeholder="{{ __('translation.select') }}" wire:model="categoriesIds" 
                :async-data="route('async.categories')" option-label="name" option-value="id" />
        </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="trainer_id">{{ __('competitions.attributes.trainer') }}</label>
            </div>
            <div class="">
                {{-- <x-select placeholder="{{ __('translation.select') }}" wire:model="competition.trainer_id" 
                :async-data="route('async.trainers')" option-label="nazwisko" option-value="id" /> --}}

                <x-select
                placeholder="{{ __('translation.select') }}"
                wire:model="competition.trainer_id"
                :options="$trainersForSelect"
                option-label="label"
                option-value="id"
            />
            
            

            </div>
        </div>





         <hr class="my-2">
            <div class="grid grid-cols-2 gap-2">
                 <div class="">
                      <label for="image">{{ __('competitions.attributes.image') }}
                </div>
                   <div class="">
                         @if ($imageExists)
                             <div class="relative">
                                <img class="w-full" src="{{ $imageUrl }}" alt="{{ $competition->name }}">
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
            <x-button href="{{ route('competitions.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>