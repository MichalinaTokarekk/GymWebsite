<div class="p-2">
    <form wire:submit.prevent="save">
        <h2 class="text-x1 font-semibold leading-tight text-center text-2xl" style="color:rgb(119, 57, 39); font-family:cursive">
            @if ($editMode)
                {{ __('specializations.labels.edit_form_title') }}
            @else
                {{ __('specializations.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-1 gap-1" style="flex-wrap: inherit"> 
            <div class="">
                <label form="name"> {{ __('specializations.attributes.name') }}</label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}" wire:model="specialization.name" />
            </div>
        </div>
        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('specializations.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>

