<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight">{{ __('Odpowiedź') }}</h1>
        <a href="{{ route('answer.create') }}" class="text-blue-500 hover:underline">{{ __('Dodaj nową odpowiedź') }}</a>
    </x-slot>

    <ul class="mt-6">
        @foreach ($question as $question)
            <li class="mb-4">
                <a style="margin-left: 160px" href="{{ route('answer.show', $question) }}" class="text-blue-500 hover:underline">{{ $answer->comment }}</a>
                <div style="margin-left: 160px" class="text-gray-500 text-sm mt-1">Zadane przez: {{ $question->user->imie }} {{ $question->user->nazwisko }}</div>
            </li>
        @endforeach
    </ul>
</x-app-layout>
