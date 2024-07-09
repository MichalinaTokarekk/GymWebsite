{{-- <x-app-layout>
<h1>Dodaj nowe pytanie</h1>

    <form action="{{ route('question.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="head">Tytuł:</label>
            <input type="text" name="head" id="head" class="form-control">
        </div>
        <div class="form-group">
            <label for="questionContent">Treść pytania:</label>
            <textarea name="questionContent" id="questionContent" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj pytanie</button>
    </form>
</x-app-layout> --}}

<x-app-layout>
    <h1 class="text-2xl font-semibold mb-4">Dodaj nowe pytanie</h1>
    
    <form action="{{ route('question.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="head" class="block font-medium text-sm">Nagłówek:</label>
            <input type="text" name="head" id="head" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-400" required>
            @error('head')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="questionContent" class="block font-medium text-sm">Treść pytania:</label>
            <textarea name="questionContent" id="questionContent" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-400" rows="6" required></textarea>
            @error('questionContent')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-400">Dodaj pytanie</button>
    </form>
</x-app-layout>

