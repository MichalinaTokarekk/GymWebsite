<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-x1 font-semibold   style='text-align: center' leading-tight  text-center text-2xl" style="color: #F25C05">
            @if ($editMode)
                {{ __('categories.labels.edit_form_title') }}
            @else
                {{ __('categories.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-1 gap-1" style="flex-wrap: inherit; color: #black"> 
            <div class="">
                <label form="name"> {{ __('categories.attributes.name') }}</label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}" wire:model="category.name" />
            </div>
        </div>
        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('categories.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>

