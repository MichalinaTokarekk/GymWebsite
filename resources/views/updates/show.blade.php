<x-app-layout>
    <x-slot name='header'>
        <h2 class="text-x1 font-serif leading-tight text-center text-5xl" style="color:rgb(119, 57, 39); font-family:cursive">
            <strong> {{__('translation.navigation.updates')}} </strong> 
        </h2>
    </x-slot>
    <div class="py-12" style="background-image: url('/storage/tlo.png')">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="padding:2cm; background-color: #ded6dc">                
            <x-button href="{{ route('updates.index') }}" secondary class="mr-2" label="{{ __('translation.back') }}" />
  
            <div class="grid justify-items-stretch pt-2 pr-2 w-full">
                    
                    <div class="card card-border card-compact lg:card-normal w-full">
                        @if($update->image !== null)
                        <div class="flex flex-col w-full items-center">
                            <figure>
                                <img src="/storage/{{ $update->image }}"  width="900px" image-center>
                            </figure> 
                        </div>
                        @endif
                        <div class="card-body mt-4 ">
                            
                            <h2 class="card-title font-bold text-2xl pb-3 text-blue-600 text-center ">{{ $update->title}}</h2> 

                            <p class="text-black text-center font-semibold text-2xl">{{ $update->description}}</p>
                            

                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
