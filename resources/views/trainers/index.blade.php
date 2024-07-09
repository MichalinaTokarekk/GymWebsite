<x-app-layout>
    <x-slot name='header'>
     
        <h2 class="text-x1 leading-tight text-center text-5xl" style="color:rgb(119, 57, 39); font-family:cursive">
            <strong>{{__('translation.navigation.trainers')}}</strong>
        </h2>
       
    </x-slot>
    <div class="py-12"; style="background-image: url('/storage/tlo.png')">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg" id="table-view-wrapper" style="padding:2cm;  background-color: #ded6dc">
                
                <h2 class="text-x1 font-bold leading-tight text-center text-3xl" 
                style="color: rgb(119, 57, 39); font-family:cursive">Trenerzy</h2>
                
                    <livewire:trainers.trainers-grid-view/>
                
                <h2 class="text-x1 font-bold leading-tight text-center text-3xl" 
                style="color: rgb(119, 57, 39); font-family:cursive">Dietetycy</h2>
                    
                    <livewire:trainers.dieticians-grid-view/>

                <h2 class="text-x1 font-bold leading-tight text-center text-3xl" 
                style="color: rgb(119, 57, 39); font-family:cursive">Fizjoterapeuci</h2>
                    
                    <livewire:trainers.physiotherapists-grid-view/>
                
            </div>
        </div>
    </div>
</x-app-layout>