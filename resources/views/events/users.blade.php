<x-app-layout>
    <x-slot name='header'>
        <h2 class="text-x1 leading-tight text-center text-5xl" style="color:rgb(119, 57, 39); font-family:cursive">
         <strong>  {{ __('translation.navigation.trainers') }}</strong>
        </h2>
    </x-slot>
    <div class="py-12" style="background-image: url('/storage/tlo.png')">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg" w-full id="table-view-wrapper"
            style="padding:2cm;  background-color: #ded6dc" >
                <div class="grid justify-items-stretch pt-2 pr-2 w-full">
                    <div class="card card-border card-compact lg:card-normal w-full">
                        <div class="card-body mt-4">
                            <h2 class="card-title font-bold text-2xl pb-3 text-blue-600 text-center" style="color: #F25C05">
                                Lista użytkowników z zajęcia {{ $event->title }}
                            </h2><br/>
                            <div class="grid justify-items-stretch pt-2 pr-2">
                                <table class="table-auto">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2">Imię</th>
                                            <th class="px-4 py-2">Nazwisko</th>
                                            <th class="px-4 py-2">Email</th>
                                            <th class="px-4 py-2">Akcje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $user->imie }}</td>
                                                <td class="border px-4 py-2">{{ $user->nazwisko }}</td>
                                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                                <td class="border px-4 py-2">

                                                    @if($user->id != $event->trainer_id)
                                                    <form action="{{ route('events.removeUser', ['event' => $event, 'user' => $user]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- <button class="text-red-500 hover:text-red-700" onclick="confirmUnsubscribe('{{ route('events.removeUser', ['event' => $event, 'user' => $user]) }}')">Wypisz użytkownika</button> --}}
                                                        <button type="submit" class="text-red-500 hover:text-red-700">Wypisz użytkownika</button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                <a href="javascript:history.go(-1)" class="text-blue-500 hover:text-blue-700">Wstecz</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        function confirmUnsubscribe(url) {
            event.preventDefault(); 
            if (confirm('Czy na pewno chcesz wypisać użytkownika?')) {
                window.location.href = url;
            }
        }
    </script> --}}
</x-app-layout>