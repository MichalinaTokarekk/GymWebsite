{{-- 
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->imie }} {{ $user->nazwisko }}</li>
        @endforeach
    </ul> --}}

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Uczestnicy {{ $competition->title }}</title>
    
        <style>
            .my-4 {
                margin-top: 1.5rem;
                margin-bottom: 1.5rem;
            }
    
            .card {
                border: 1px solid rgba(0, 0, 0, 0.125);
                border-radius: 0.25rem;
                margin-bottom: 1.5rem;
            }
    
            .card-header {
                background-color: #007bff;
                color: #fff;
                padding: 0.75rem 1.25rem;
                border-bottom: 1px solid rgba(0, 0, 0, 0.125);
                border-top-left-radius: 0.25rem;
                border-top-right-radius: 0.25rem;
            }
    
            .card-body {
                padding: 1.25rem;
            }
    
            .table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
            }
    
            .table th, .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }
    
            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }
    
            .thead-dark th {
                color: #fff;
                background-color: #343a40;
                border-color: #454d55;
            }
    
            .mt-3 {
                margin-top: 1rem;
            }
        </style>
    </head>
    <body>
    
        <h1 class="my-4">Uczestnicy {{ $competition->title }}</h1>
    
        <div class="card">
            
            <div class="card-body">
                @if(count($users) > 0)
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Imię</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->imie }}</td>
                                    <td>{{ $user->nazwisko }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mt-3">Brak uczestników.</p>
                @endif
            </div>
        </div>
    
    </body>
    </html>
    
    
