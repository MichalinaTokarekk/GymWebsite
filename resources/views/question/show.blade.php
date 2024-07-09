{{-- <x-app-layout>
    <h1>{{ $question->head }}</h1>
    <p>{{ $question->questionContent }}</p>

    <h2>Odpowiedzi:</h2>
    @foreach ($question->answers as $answer)
        <div>{{ $answer->comment }}</div>
    @endforeach

    @auth
    <form method="post" action="{{ route('answer.store') }}">
        @csrf
        <textarea name="comment" rows="4" cols="50"></textarea>
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        <button type="submit">Dodaj odpowiedź</button>
    </form>
    @else
        <p>Musisz być zalogowany, aby dodać odpowiedź.</p>
    @endauth
</x-app-layout> --}}


<x-app-layout>
    <div style="background-color: #f4f4f4; padding: 20px; border: 1px solid #ddd; margin: 20px 0;">
        <h1>{{ $question->head }}</h1>
        <p>{{ $question->questionContent }}</p>
    </div>

    <div style="float: right; margin: 10px; margin-top: -15px; padding: 10px; border: 1px solid #007bff; border-radius: 5px; background-color: #f4f4f4;">
    @auth
        @if (auth()->user()->hasRole(['trainer', 'worker', 'admin']))
        <form method="post" action="{{ route('question.updateStatus', $question) }}">
            @csrf
            @method('PUT') 
    
            <select name="status_id" id="status_id">
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ $question->status_id === $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
    
            <button type="submit" style="background-color: #828486; color: #fff; border: none; padding: 8px 2px; border-radius: 5px; cursor: pointer; margin-top: 5px;">Aktualizuj</button>
        </form>
        @endif
    @endauth
    </div>

    <div style="margin-top: 20px; margin-left: 10px; margin-right: 500px">
        <h2>Odpowiedzi:</h2>
        @foreach ($question->answers as $answer)
            <div style="background-color: #e0e0e0; padding: 10px; margin: 10px 0;">
                <p><strong>Autor:</strong> {{ $answer->user->imie }} {{ $answer->user->nazwisko }}</p>
                {{ $answer->comment }}
            </div>
        @endforeach
    </div>

    

    {{-- @auth
    @if (auth()->user()->id === $question->user_id || auth()->user()->hasRole(['trainer', 'worker', 'admin']))
    <div style="margin-top: 20px;  margin-right: 500px">
        <form style="margin-left: 10px" method="post" action="{{ route('answer.store') }}">
            @csrf
            <textarea name="comment" rows="4" cols="50" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" placeholder="Dodaj odpowiedź..."></textarea>
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <button type="submit" style="background-color: #007bff; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Dodaj odpowiedź</button>
        </form>
    </div>
    @endif
    @else
        <p style="margin-top: 20px;">Musisz być zalogowany, aby dodać odpowiedź.</p>
    @endauth --}}

    @auth
    {{-- Debugging --}}
    @if (auth()->user()->id === $question->user_id || auth()->user()->hasRole(['trainer', 'worker', 'admin', 'physiotherapist']))
        @if ($question->status->name !== 'ZAKOŃCZONE')
            <div style="margin-top: 20px; margin-right: 500px">
                <form style="margin-left: 10px" method="post" action="{{ route('answer.store') }}">
                    @csrf
                    <textarea name="comment" rows="4" cols="50" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" placeholder="Dodaj odpowiedź..." required></textarea>
                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                    <button type="submit" style="background-color: #007bff; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Dodaj odpowiedź</button>
                </form>
            </div>
        @endif
    @else
        <p style="margin-top: 20px;">Musisz być zalogowany, aby dodać odpowiedź.</p>
    @endif
@endauth


</x-app-layout>
