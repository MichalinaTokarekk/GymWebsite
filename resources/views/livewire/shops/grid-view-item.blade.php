@props([
  'image' => '',
  'title' => '',
  'description' => '',
  'link' => '',
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
    
  <img src="{{ $image }}" alt="{{ $image }}" style="float:left" class="rounded-md h-48  w object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}">

  @endif

  <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
    <div class="flex items-start">
      <div class="flex-1">
        <h3 class="font-bold leading-6 text-center   {{ $model->deleted_at ? 'line-through' : ''}}" style="font-size: x-large">          
          @if ($hasDefaultAction)
            <a href="#!" class="hover:underline" style="text-center" style="text-align: right; color: yellow" wire:click.prevent="onCardClick({{ $model->getKey() }})">
              {!! $title !!} 
            </a>
          @else           
              {!! $title !!}
          @endif

        </h3>
         

        @if (isset($link))
          <a href="{{$link}}" class="line-clamp-5 mt-2 font-bold text-right" style="color: #F25C05" >
            {!! $link !!}
          </a>
        @endif  
      
        @if (isset($description))
          <p class="line-clamp-10 mt-2 font-serif text-center ">
            {!! $description !!}
          </p>
        @endif
        <br>

      </div>

      @if (count($actions))
        <div class="flex justify-end items-center">
          <x-lv-actions.drop-down :actions="$actions" :model="$model" />
        </div>
      @endif
      
    </div>

  </div>

</div>