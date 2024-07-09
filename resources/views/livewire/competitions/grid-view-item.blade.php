@props([
  'image' => '',
  'title' => '',
  'description' => '',
  'date' => '',
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
    
  <img src="{{ $image }}" alt="{{ $image }}" style="float:left" class="rounded-md h-80  w object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}">

  @endif

  <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
    <div class="flex items-start">
      <div class="flex-1">
        <h3 class="font-bold leading-6 text-blue-600  text-center   {{ $model->deleted_at ? 'line-through' : ''}}" style="font-size: x-large">          @if ($hasDefaultAction)
            <a href="#!" class="hover:underline" style="text-center" style="text-align: right" wire:click.prevent="onCardClick({{ $model->getKey() }})">
              {!! $title !!} 
            </a>
          @else
           
             <a href="{{ route('competitions.show', [$model])}}" class="hover:underline" style="text-align: center">
              {!! $title !!}
            </a><br><br>
          @endif

        </h3>
          @if ($categories)
            <span class="flex justify-end text-sm text-gray-600">
                @foreach ($categories as $category)
                    <span
                        class="mr-2 rounded px-2.5 py-0.5 text-xs font-semibold text-gray-800 dark:bg-gray-700 dark:text-gray-300" style="background-color: #F2DF80">{{ $category->name }}</span>
                @endforeach
            </span>
        @endif

        @if (isset($date))
        <p class="line-clamp-5 mt-2 font-bold text-right" style="color: #F25C05" >
          {!! $date !!}
        </p>
      @endif   
      </div>
      

      {{-- @if (count($actions))
        <div class="flex justify-end items-center">
          <x-lv-actions.drop-down :actions="$actions" :model="$model" />
        </div>
      @endif --}}

      @if (count($actions))
      <div class="flex justify-end items-center">
          @if ($user && $user->id === auth()->id() || auth()->user()->hasRole('admin'))
            <x-lv-actions.drop-down :actions="$actions" :model="$model" />
          @endif
      </div>
    @endif

    </div>
    



    @if (isset($description))
      <p class="line-clamp-3 mt-2 font-serif text-center ">
        {!! $description !!}
      </p>
    @endif
    <br>
    

    @if ($user)
      <span class="text-sm text-black-600" style="float:right;">
          {{ __('Trener organizujący') }}: {{ $user->imie}} {{ $user->nazwisko}}
      </span>
    @endif

    @can('canAttaching', $model)
        <br>
        @if (!$model->deleted_at)

        {{-- <a href="{{ route('competitions.record', [$model])}}"> <x-button wire:click="zapis({{ $model->getKey() }})" type="submit" style="color: black; font-bold; float:right" class="btn btn-primary btn-block bg-orange-500"> Zapisz się  </x-button> </a> --}}
            
        {{-- <x-button wire:click="zapis({{ $model->getKey() }})" type="submit" style="color: black; font-bold; float:right" class="btn btn-primary btn-block bg-orange-500"> Zapisz się  </x-button>  --}}
        
        

      {{-- <script>
          function checker() {
            var result = confirm('Czy na pewno chcesz się zapisać?');
            if (result) {
              return wire:click="zapis(".{{ $model->getKey() }}.")";
            } else
              return false;
          }
      </script> --}}

        {{-- <x-button a href="{{ route('competitions.record', [$model])}}" type="submit" style="color: black; font-bold; float:right" class="btn btn-primary btn-block bg-orange-500"> Zapisz się  </x-button>  --}}

        {{-- <x-button wire:click="zapis({{ $model->getKey() }})" type="submit" style="color: black; font-bold; float:right" class="btn btn-primary btn-block bg-orange-500"> Zapisz się  </x-button> --}}


        @auth
        @if (auth()->user()->hasRole('user') && !auth()->user()->hasRole('admin'))
          @if ($model->date > now())
              <x-button a href="{{ route('competitions.record', [$model])}}" type="submit" style="color: black; font-bold; float:right" class="btn btn-primary btn-block bg-orange-500"> Zapisz się  </x-button>
          @else
        <p style="display: inline-block; float: right; margin-right: -11px; background-color: rgb(243, 95, 95); color: rgb(14, 13, 13); padding: 5px;">Zapisy na te zawody są zakończone.</p>

        @endif
    @endif
@endauth

{{-- <a href="{{ route('competitions.participants', [$model]) }}" class="btn btn-secondary btn-block mt-2" style="color: black; font-bold; float:right">Uczestnicy</a> --}}

@if(auth()->check() && auth()->user()->isAdmin())
    <a href="{{ route('competitions.participants', [$model]) }}" class="btn btn-secondary btn-block mt-2" style="color: black; font-bold; float:right">Uczestnicy</a>
@endif
    
        {{-- <script>
          if (confirm() == true) {
            wire:click="zapis({{ $model->getKey() }})"
          } 
        </script> --}}

        {{-- <script>
          function zapisz() {
              if (confirm('Czy chcesz zapisać zmiany?')) {
                  Livewire.emit('zapis', {{$model->getKey()}});
              }
          }
      </script> --}}

        @endif
    @endcan

  

    
    @auth
    @cannot('canAttaching', $model)
        <br>
        @if (!$model->deleted_at)
         <x-button wire:click="wypis({{ $model->getKey() }})" type="submit" style="color: black; font-bold; float:right" class="btn btn-primary btn-block bg-red-500">Wypisz się</x-button>
        @endif
    @endcannot
    @endauth
  </div>

</div>