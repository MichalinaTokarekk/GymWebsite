<x-app-layout>
    <x-slot name='header'>
        <h2 class="text-x1 font-semibold leading-tight text-center text-5xl" style="color:rgb(119, 57, 39); font-family:cursive">
       <strong> {{__('translation.navigation.activities')}}</strong>
        </h2>
    </x-slot>
    <div class="py-12" style="background-image: url('/storage/tlo.png')">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg" style="  background-color: #ded6dc">

                @if (isset($activity))
                    <livewire:activities.activity-form :activity="$activity" :editMode="true" />

                @else
                    <livewire:activities.activity-form :editMode="false" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
