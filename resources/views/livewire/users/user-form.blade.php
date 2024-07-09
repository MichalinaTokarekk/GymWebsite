<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-x1 font-semibold   style='text-align: center' leading-tight  text-center text-2xl" style="color: #F25C05">
            @if ($editMode)
                {{ __('users.labels.edit_form_title') }}
            @else
                {{ __('users.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="imie">
                    {{ __('users.attributes.imie') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="user.imie" />
        </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="nazwisko">
                    {{ __('users.attributes.nazwisko') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="user.nazwisko" />
        </div>
        </div>


         <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="email">
                    {{ __('users.attributes.email') }}
                </label>

            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="user.email" />
        </div>
        </div>

        
        {{-- <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="password">
                    {{ __('users.attributes.password') }}
                </label>

            </div>
            <div class="">
                <x-input type="password" placeholder="{{ __('translation.enter') }}"
                    wire:model="user.password" />
            </div>
        </div> --}}

        {{-- <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="activities">{{ __('users.attributes.activities') }} </label>
            </div>
            <div class="">
                <x-select multiselect placeholder="{{ __('translation.select')}}" wire:model.defer="user.activities"
                    :async-data="route('async.activities')" option-label="name" option-value="id" />
            </div>
        </div> --}}


        @if($editMode && !$user->isOnlyUser())
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="specializations">
                    {{ __('users.attributes.specializations') }}
                </label>
            </div>
            <div class="">
                <x-select multiselect placeholder="{{ __('translation.select') }}" wire:model="specializationsIds" 
                :async-data="route('async.specializations')" option-label="name" option-value="id" />
        </div>
        </div>
        @endif

        

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="opis">
                    {{ __('users.attributes.opis') }}
                </label>

            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="user.opis" />
        </div>
        </div>

      

         <hr class="my-2">
            <div class="grid grid-cols-2 gap-2">
                 <div class="">
                      <label for="image">{{ __('users.attributes.image') }}
                </div>
                   <div class="">
                         @if ($imageExists)
                             <div class="relative">
                                <img class="w-full" src="{{ $imageUrl }}" alt="{{ $user->imie }}">
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
            <x-button href="{{ route('users.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>