@props([
  'image' => '',
  'imie' => '',
  'nazwisko' => '',
  'opis' => '',
  'users' => '',
  'withBackground' => false,
  'model',
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
        <h3 class="font-bold leading-6 text-center {{ $model->deleted_at ? 'line-through' : ''}}" style="color: #F25C05">          @if ($hasDefaultAction)
            <a href="#!" class="hover:underline" style="text-align: center" wire:click.prevent="onCardClick({{ $model->getKey() }})">
              {!! $imie !!}    {!! $nazwisko !!}
            </a>
          @else
           
             <a href="{{ route('trainers.show', [$model])}}" class="hover:underline" style="text-align: center">
              {!! $imie !!}   {!! $nazwisko !!}
            </a>
          @endif
        </h3>

          @if($users)
          <span class="text-sm text-blue-600">
            {{ __('trainers.attributes.trainers') }}: {!! $users !!}
          </span>
          @endif

          @if ($specializations)
          <span class="flex justify-end text-sm text-gray-600">
              @foreach ($specializations as $specialization)
                  <span
                      class="mr-2 rounded px-2.5 py-0.5 text-xs font-semibold text-gray-800 dark:bg-gray-700 dark:text-gray-300" style="background-color: #F2DF80">{{ $specialization->name }}</span>
              @endforeach
          </span>
      @endif


      </div>
      @if (count($actions))
        <div class="flex justify-end items-center">
          <x-lv-actions.drop-down :actions="$actions" :model="$model" />
        </div>
      @endif
    </div>

    @if (isset($opis))
      <p class="line-clamp-5 mt-2 font-bold ">
        {!! $opis !!}
      </p>
    @endif
  </div>

</div>