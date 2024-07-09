<x-app-layout>
    <x-slot name='header'>
        <h2 class="text-x1  leading-tight text-center text-5xl" style="color:rgb(119, 57, 39); font-family:cursive" >
        <strong>{{__('translation.navigation.users')}}</strong>
        </h2>
    </x-slot>
    <div class="py-12 " style="background-image: url('/storage/tlo.png');">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-50 overflow-hidden shadow-xl sm:rounded-lg" id="table-view-wrapper"  style="padding:1cm; background-color: #ded6dc">
                {{-- <div class="grid justify-items-stretch pt-2 pr-2"> --}}
                        <x-button primary
                            label="{{ __('translation.back') }}"
                            href="javascript:history.go(-1)"
                            class="justify-self-start pt-2 ml-3 bg-blue-600" 
                            style="background-color: rgb(39, 67, 119)"/>
                        {{-- </div> --}}
                        <livewire:events.event-users-table-view :event="$event" />
                

            </div>
        </div>
    </div>
</x-app-layout>
