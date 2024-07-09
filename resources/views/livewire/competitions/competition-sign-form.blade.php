@props([
  'image' => '',
  'title' => '',
  'description' => '',
  'date' => '',
  'user' => '',
  'withBackground' => false,
  'model'=>'',
  'competition'=>'',
  'actions' => [],
  'hasDefaultAction' => false,
  'selected' => false,
])
<div class="p-2">
    <form wire:submit.prevent="save">
     <h3 class="text-x1  leading-tight text-gray-800">
            @if ($editMode)
                {{ __('') }}
            @else
                {{ __('users.labels.create_form_title') }}
            @endif
        </h3>
        

        {{-- {{ dd($user) }} --}}

        
        {{-- <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="imie">
                    {{ __('users.attributes.imie') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}" value="{{ $user->imie }}" readonly />
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
                <x-input placeholder="{{ __('translation.enter') }}" value="{{ $user->nazwisko }}" readonly />
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
                <x-input placeholder="{{ __('translation.enter') }}" value="{{ $user->email }}" readonly/>
        </div>
        </div> --}}

        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="imie">
                    {{ __('users.attributes.imie') }}
                </label>
            </div>
            <div class="">
                <div>{{ $user->imie }}</div>
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
                <div>{{ $user->nazwisko }}</div>
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
                <div>{{ $user->email }}</div>
            </div>
        </div>
        


    

        <hr class="my-2">
        <br>
        <label><input type="checkbox" required> <p class="line-clamp-3 font-serif text-left " style="font-size: 12px;">Wyrażam zgodę na przetwarzanie moich danych osobowych dla potrzeb niezbędnych do realizacji procesu zapisów zgodnie z Rozporządzeniem Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 r. w sprawie ochrony osób fizycznych w związku z przetwarzaniem danych osobowych i w sprawie swobodnego przepływu takich danych oraz uchylenia dyrektywy 95/46/WE (RODO).</p></label>


        <div class="flex justify-end pt-2">
            
            <x-button href="{{ route('competitions.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" style="color: black; font-bold; float:right" class="btn btn-primary btn-block bg-orange-500" > Zapisz się  </x-button>
        </div>
    </form>
</div>