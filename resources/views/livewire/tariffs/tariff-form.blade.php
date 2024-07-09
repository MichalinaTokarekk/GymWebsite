<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-x1 font-semibold   style='text-align: center' leading-tight  text-center text-2xl" style="color: #F25C05">
            @if ($editMode)
                {{ __('tariffs.labels.edit_form_title') }}
            @else
                {{ __('tariffs.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2" style="flex-wrap: inherit"> 
            <div class="">
                <label form="name"> {{ __('tariffs.attributes.name') }}</label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}" wire:model="tariff.name" />
            </div>
        </div>

    

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2" style="flex-wrap: inherit"> 
            <div class="">
                <label form="type"> {{ __('tariffs.attributes.type') }}</label>
            </div>
          
            <select name="tariff.type" id="type" required wire:model="tariff.type" placeholder="Wybierz opcję">
                <option value="ilosciowy">Ilościowy</option>
                <option value="okresowy">Okresowy</option>
              </select>
            
        </div>

      


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2" style="flex-wrap: inherit"> 
            <div class="">
                <label form="number"> {{ __('tariffs.attributes.number') }}</label>
            </div>
            <div class="">
                <x-input type="integer"  placeholder="{{ __('translation.enter') }}" wire:model="tariff.number" />
            </div>
        </div>

     

        

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2" style="flex-wrap: inherit"> 
            <div class="">
                <label form="price"> {{ __('tariffs.attributes.price') }}</label>
            </div>
            <div class="">
                <x-input type="text" placeholder="{{ __('translation.enter') }}" wire:model="tariff.price" />
            </div>
        </div>


        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('tariffs.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>

    </form>
</div>

