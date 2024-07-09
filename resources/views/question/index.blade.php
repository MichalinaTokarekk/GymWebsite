<x-app-layout>
    {{-- <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight">{{ __('Lista pytań') }}</h1>
        <a href="{{ route('question.create') }}" class="text-blue-500 hover:underline">{{ __('Dodaj nowe pytanie') }}</a>
    </x-slot> --}}

    {{-- <ul class="mt-6">
        <div style="margin-left: 160px; margin-bottom: 40px">
            <h1 class="text-2xl font-semibold leading-tight">{{ __('Lista pytań') }}</h1>
            <a href="{{ route('question.create') }}" class="text-blue-500 hover:underline">{{ __('Dodaj nowe pytanie') }}</a>
        </div> 
        @foreach ($question as $question)
            <li class="mb-4">
                <a style="margin-left: 160px;" href="{{ route('question.show', $question) }}" class="text-blue-500 hover:underline">{{ $question->head }}</a>
                <div style="margin-left: 160px" class="text-gray-500 text-sm mt-1">Zadane przez: {{ $question->user->imie }} {{ $question->user->nazwisko }}</div>

                <div style="margin-left: 160px" class="text-gray-500 text-sm mt-1">Status: {{ $question->status->name }}</div>
            </li>
        @endforeach
    </ul> --}}

    <div style="margin-left: 30px; margin-bottom: 40px">
        <h1 class="text-2xl font-semibold leading-tight">{{ __('Lista pytań') }}</h1>
        <a href="{{ route('question.create') }}" class="text-blue-500 hover:underline">{{ __('Dodaj nowe pytanie') }}</a>
    </div>

    @foreach ($groupedQuestions as $status => $questions)
        @if ($status === 'OCZEKIWANE')
            <div style="background-color: #f2f2f2; padding: 10px; border: 1px solid #ccc; margin: 10px 0; margin-left: 30px; margin-right: 30px;">
                <h2 class="text-xl font-semibold leading-tight">OCZEKIWANE:</h2>
                <ul class="mt-4">
                    @foreach ($questions as $question)
                        <li class="mb-4">
                            <a href="{{ route('question.show', $question) }}" class="text-blue-500 hover:underline">{{ $question->head }}</a>
                            <div class="text-gray-500 text-sm mt-1">Zadane przez: {{ $question->user->imie }} {{ $question->user->nazwisko }}</div>
                            <div style="margin-left: 1px" class="text-gray-500 text-sm mt-1">Status: {{ $question->status->name }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            @if ($status === 'W TRAKCIE')
                <div style="background-color: #f2f2f2; padding: 10px; border: 1px solid #ccc; margin: 10px 0; margin-left: 30px; margin-right: 30px;">
                    <h2 class="text-xl font-semibold leading-tight">W TRAKCIE:</h2>
                    <ul class="mt-4">
                        @foreach ($questions as $question)
                            <li class="mb-4">
                                <a href="{{ route('question.show', $question) }}" class="text-blue-500 hover:underline">{{ $question->head }}</a>
                                <div class="text-gray-500 text-sm mt-1">Zadane przez: {{ $question->user->imie }} {{ $question->user->nazwisko }}</div>
                                <div style="margin-left: 1px" class="text-gray-500 text-sm mt-1">Status: {{ $question->status->name }}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div style="background-color: #f2f2f2; padding: 10px; border: 1px solid #ccc; margin: 10px 0; margin-left: 30px; margin-right: 30px;">
                    <h2 class="text-xl font-semibold leading-tight">ZAKOŃCZONE:</h2>
                    <ul class="mt-4">
                        @foreach ($questions as $question)
                            <li class="mb-4">
                                <a href="{{ route('question.show', $question) }}" class="text-blue-500 hover:underline">{{ $question->head }}</a>
                                <div class="text-gray-500 text-sm mt-1">Zadane przez: {{ $question->user->imie }} {{ $question->user->nazwisko }}</div>
                                <div style="margin-left: 1px" class="text-gray-500 text-sm mt-1">Status: {{ $question->status->name }}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
    @endforeach

</x-app-layout>
