@props([
  'image' => '',
  'title' => '',
  'description' => '',
  'user' => '',
  'withBackground' => false,
  'model'=>'',
  'actions' => [],
  'hasDefaultAction' => false,
  'selected' => false,
])

<div class="{{ $withBackground ? 'rounded-md shadow-md' : '' }}">
  @if ($hasDefaultAction)
    <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
      <img src="{{ $image }}" alt="{{ $image }}" class="hover:shadow-lg cursor-pointer rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }} {{ $selected ? variants('gridView.selected') : "" }}">
    </a>
  @else
    <img src="{{ $image }}" alt="{{ $image }}" class="rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}">
  @endif

  <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
    <div class="flex items-start">
      <div class="flex-1">
        <h3 class="font-bold leading-6  text-center {{ $model->deleted_at ? 'line-through' : ''}}" style="color: #F25C05">          @if ($hasDefaultAction)
            <a href="#!" class="hover:underline" style="text-align: center" wire:click.prevent="onCardClick({{ $model->getKey() }})">
              {!! $title !!}
            </a>
          @else
           
             <a href="{{ route('activities.show', [$model])}}" class="hover:underline" style="text-align: center">
              {!! $title !!}
            </a>
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
      <p class="line-clamp-3 mt-2 font-bold ">
        {!! $description !!}
      </p>
    @endif

    @if ($user)
    <span class="text-sm text-black-600" style="float:right;">
        {{ __('Trenerzy prowadzący') }}: {{ $user->imie}} {{ $user->nazwisko}}
    </span>
  @endif
  </div>

</div>