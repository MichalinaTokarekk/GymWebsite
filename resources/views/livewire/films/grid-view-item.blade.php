@props([
  'video' => '',
  'title' => '',
  'description' => '',
  'withBackground' => false,
  'model',
  'actions' => [],
  'hasDefaultAction' => false,
  'selected' => false,
])

<div class="{{ $withBackground ? 'rounded-md shadow-md' : '' }}">
  
  @if ($hasDefaultAction)
    @if ($model->video !== null)
    <div class="flex justify-center items-center">
      <video controls="controls" title="Testowy">
        <source src="{{ route('film.download', [$model->video]) }}" type="video/mp4">
        Twoja przeglądarka nie obsługuje znacznika video.
      </video>
    </div>
    @endif
  @else
    @if ($model->video !== null)
    <div class="flex justify-center items-center">
      <video controls="controls" title="Testowy">
        <source src="{{ route('film.download', [$model->video]) }}" type="video/mp4"/>
        Twoja przeglądarka nie obsługuje znacznika video.
      </video>
    </div>
    @endif
  @endif

  <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
    <div class="flex items-start"  style="color: #F25C05">
      <div class="flex-1">
        <h3 class="font-bold leading-6 text-center {{ $model->deleted_at ? 'line-through' : ''}}" style="font-size: x-large">
          @if ($hasDefaultAction)
            <a href="#!" class="hover:underline" style="text-center" wire:click.prevent="onCardClick({{ $model->getKey() }})">
              {!! $title !!}
            </a>
          @else
            {!! $title !!}
          @endif
        </h3>
      </div>

      @if (count($actions))
        <div class="flex justify-end items-center">
          <x-lv-actions.drop-down :actions="$actions" :model="$model" />
        </div>
      @endif
    </div>

    @if (isset($description))
      <p class="line-clamp-10 mt-2 font-serif text-center">
        {!! $description !!}
      </p>
    @endif
    <br>
  </div>
</div>
