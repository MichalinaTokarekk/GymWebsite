@props([
  // 'image' => '',
  'title' => '',
  'description' => '',
  'start' => '',
  'end' => '',
  'user' => '',
  'withBackground' => false,
  'model'=>'',
  'actions' => [],
  'hasDefaultAction' => false,
  'selected' => false,
])

<div class="{{ $withBackground ? 'rounded-md shadow-md' : '' }}">
  @if ($hasDefaultAction)
    {{-- <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
      <img src="{{ $image }}" alt="{{ $image }}" class="hover:shadow-lg cursor-pointer rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }} {{ $selected ? variants('gridView.selected') : "" }}">
    </a> --}}
  @else
    {{-- <img src="{{ $image }}" alt="{{ $image }}" class="rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}"> --}}
  @endif

  <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
    <div class="flex items-start">
      <div class="flex-1">
        <h3 class="font-bold leading-6 text-blue-600 text-center {{ $model->deleted_at ? 'line-through' : ''}}">          @if ($hasDefaultAction)
            <a href="#!" class="hover:underline" style="text-align: center" wire:click.prevent="onCardClick({{ $model->getKey() }})">
              {!! $title !!}
            </a>
          @else
           
             <a href="{{ route('events.show', [$model])}}" class="hover:underline" style="text-align: center">
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
    
    @if (isset($start))
      <p class="line-clamp-3 mt-2 font-bold ">
        Początek zajęć: {{ substr($start,8,2)}}-{{ substr($start,5,2)}}-{{ substr($start,0,4)}} {{ substr($start,11,5)}}
      </p>
    @endif
   
    @if (isset($end))
      <p class="line-clamp-3 mt-2 font-bold ">
       Koniec zajęć: {{ substr($end,8,2)}}-{{ substr($end,5,2)}}-{{ substr($end,0,4)}} {{ substr($end,11,5)}}
      </p>
    @endif

    @if ($user)
    <span class="text-sm text-black-600" style="float:right;">
        {{ __('Trenerzy prowadzący') }}: {{ $user->imie}} {{ $user->nazwisko}}
    </span>
    @endif

    <span class="text-sm text-black-600" 
      style="
        margin-left: 527px;
        margin-top: 41px;
        "
    >
      <x-button 
        label="Wypisz się" 
        class="justify-center bg-red-600"
        style="color: black;
        font-weight: bold;"
        wire:click.prevent="signOffUser({{ $model->id }})"
        />
    </span>
   
    
  </div>

</div>