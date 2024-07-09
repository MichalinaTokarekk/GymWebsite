<div class="p-2">
    <form wire:submit.prevent="save">
        <h2 class="text-x1 font-semibold leading-tight text-center text-2xl" style="color:rgb(119, 57, 39); font-family:cursive">
            @if ($editMode)
                {{ __('films.labels.edit_form_title') }}
            @else
                {{ __('films.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="title">
                    {{ __('films.attributes.title') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="film.title" />
        </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="description">
                    {{ __('films.attributes.description') }}
                </label>
            </div>
            <div class="">
                <x-input placeholder="{{ __('translation.enter') }}"
                    wire:model="film.description" />
        </div>
        </div>


        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
    <div class="">
        <label for="video">{{ __('films.attributes.video') }}</label>
    </div>
    <div class="">
        @if ($videoExists)
            <div class="relative">

                {{-- <img class="w-full" src="{{ route('film.get',[$model->video]) }}" alt="{{ $film->title }}"> --}}
                <video id="videoPlayer" class="video-js" controls preload="auto" style="width:100%;">
                    <source src="{{ $videoUrl }}"  type="video/mp4" alt="{{ $film->title }}">
                </video>
                <div class="absolute top-2 right-2 h-16">
                    <x-button.circle outline xs secondary icon="trash" wire:click="deleteVideoConfirm" />
                </div>
            </div>
        @else
            <input type="file" wire:model="video" id="video" name="video">
        @endif
    </div>
</div>



        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('films.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>