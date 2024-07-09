<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-x1 font-semibold   style='text-align: center' leading-tight  text-center text-2xl" style="color: #F25C05">
            @if ($editMode)
                {{ __('events.labels.edit_form_title') }}
            @else
                {{ __('events.labels.create_form_title') }}
            @endif
        </h3>
        {{-- --------------------POCZĄTEK PÓL FORMULARZA---------------------- --}}

       {{-- title --}}
       <hr class="my-2">
       <div class="grid grid-cols-2 gap-2">
           <div class="">
               <label for="activity_id">{{ __('events.attributes.title') }}</label>
           </div>
           <div class="">
               <x-select placeholder="{{ __('translation.select') }}" wire:model="event.activity_id"
               :async-data="route('async.activities')" option-label="name" option-value="id" />
           </div>
       </div>

        {{-- description --}}
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="description">{{ __('events.attributes.description') }} </label>
            </div>
            <div class="">
                <x-textarea placeholder="{{ __('translation.enter')}}" wire:model.defer="event.description" />
            </div>
        </div>

         {{-- date_start --}}
         <hr class="my-2">
         <div class="grid grid-cols-2 gap-2">
             <div class="">
                 <label for="date_start">{{ __('events.attributes.date_start') }} </label>
             </div>
             <div class="">
                <x-input type="date" placeholder="{{ __('translation.enter')}}" wire:model.defer="event.date_start" />
             </div>
         </div>

         {{-- time_start --}}
         <hr class="my-2">
         <div class="grid grid-cols-2 gap-2">
             <div class="">
                 <label for="time_start">{{ __('events.attributes.time_start') }} </label>
             </div>
             <div class="">
                <x-input type="time" placeholder="{{ __('translation.enter')}}" wire:model.defer="event.time_start" />
             </div>
         </div>

         {{-- date_end --}}
         <hr class="my-2">
         <div class="grid grid-cols-2 gap-2">
             <div class="">
                 <label for="date_end">{{ __('events.attributes.date_end') }} </label>
             </div>
             <div class="">
                <x-input type="date" placeholder="{{ __('translation.enter')}}" wire:model.defer="event.date_end" />
             </div>
         </div>

         {{-- time_end --}}
         <hr class="my-2">
         <div class="grid grid-cols-2 gap-2">
             <div class="">
                 <label for="time_end">{{ __('events.attributes.time_end') }} </label>
             </div>
             <div class="">
                <x-input type="time" placeholder="{{ __('translation.enter')}}" wire:model.defer="event.time_end" />
             </div>
         </div>

         {{-- max_participants --}}
         <hr class="my-2">
         <div class="grid grid-cols-2 gap-2">
             <div class="">
                 <label for="max_participants">{{ __('events.attributes.max_participants') }} </label>
             </div>
             <div class="">
                <x-input type="number" placeholder="{{ __('translation.enter')}}" wire:model.defer="event.max_participants" />
             </div>
         </div>
          
        {{-- trainer_id --}}
        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="trainer_id">{{ __('events.attributes.trainer') }}</label>
            </div>
            <div class="">
                <x-select placeholder="{{ __('translation.select') }}" wire:model="event.trainer_id"
                :options="$trainersForSelect" option-label="label" option-value="id"/>
            </div>
        </div>

{{-- --------------------KONIEC PÓL FORMULARZA---------------------- --}}
{{-- SUBMIT --}}
        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('calendar') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>

