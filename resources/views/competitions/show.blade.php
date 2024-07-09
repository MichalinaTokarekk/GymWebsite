<x-app-layout>
    <x-slot name='header'>
        <h2 class="text-x1 font-semibold leading-tight text-center text-5xl" style="color:rgb(119, 57, 39); font-family:cursive">
            <strong>  {{__('translation.navigation.competitions')}} </strong> 
        </h2>
    </x-slot>
    <div class="py-12" style="background-image: url('/storage/tlo.png');">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-50 overflow-hidden shadow-xl sm:rounded-lg" w-full id="table-view-wrapper" style="padding:2cm;  background-color: #ded6dc">
                <div class="grid justify-items-stretch pt-2 pr-2 w-full">
        
                    <div class="card card-border card-compact lg:card-normal w-full">
                    <div class="flex flex-col w-full items-center">
                    <figure>
                        <img src="/storage/{{ $competition->image }}"  width="900px" image-center>
                    </figure> 
                    </div>
                    <div class="card-body mt-4 ">
                        
                        <h2 class="card-title font-bold text-2xl pb-3 text-blue-600 text-center ">{{ $competition->title}}</h2> 

                        @if ( $competition->categories)
                        <span class="flex justify-end text-sm text-gray-600">
                            @foreach ( $competition->categories as  $competition->category)
                                <span
                                    class="mr-2 rounded px-2.5 py-0.5 text-xs font-semibold text-gray-800 dark:bg-gray-700 dark:text-gray-300" style="background-color: #F2DF80">{{  $competition->category->name }}</span>
                            @endforeach
                        </span>
                    @endif

                    <p class="line-clamp-5 mt-2 font-bold text-right" style="color: #F25C05" >
                        {!! $competition->date !!}
                      </p>

                    <p class="text-black text-center font-semibold text-2xl">{{ $competition->description}}</p>

                    @if ($competition->trainer)<br><br>
                    <span class="text-sm text-gray-600" style="float:right;">
                        {{ __('Trener organizujący') }}: {{ $competition->trainer->imie}} {{ $competition->trainer->nazwisko}}
                    </span>
                @endif

                    </div>
                    </div>
                </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-button href="{{ route('competitions.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
            {{-- <x-button type="submit" primary label="{{ __('translation.save') }}" spinner /> --}}

            {{-- <x-button wire:click="zapis({{ $model->getKey() }})" type="submit" style="color: black; font-bold; float:right" class="btn btn-primary btn-block bg-orange-500"> Zapisz się  </x-button> --}}

        </div>
        <div class="flex justify-end pt-2">
            @auth
                @if (auth()->user()->hasRole('user') && !auth()->user()->hasRole('admin'))
                    @if ($competition->date < now())
                        <x-button a href="{{ route('competitions.record', [$competition]) }}" type="submit" style="color: black; font-bold; float:right" class="btn btn-primary btn-block bg-orange-500"> Zapisz się  </x-button>
                    @else
                        <p style="display: inline-block; float: right; margin-right: -11px; background-color: rgb(243, 95, 95); color: rgb(14, 13, 13); padding: 5px;">Zapisy na te zawody są zakończone.</p>
                    @endif
                @endif
            @endauth
        </div>
        
        </div>
        
    </div>   

    
</div>


</x-app-layout>

