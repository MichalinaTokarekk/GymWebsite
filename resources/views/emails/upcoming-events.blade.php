{{-- <!DOCTYPE html>
<html>
<head>
    <title>Nadchodzące Wydarzenia</title>
</head>
<body>
    <h1>Nadchodzące Wydarzenia</h1>
    @if (count($upcomingEvents) > 0)
        <ul>
            @foreach ($upcomingEvents as $event)
                <li>
                    <strong>{{ $event->title }}</strong><br>
                    Data: 
                    @if ($event->start instanceof \Carbon\Carbon)
                        {{ $event->start->format('Y-m-d H:i') }}
                    @else
                        {{ $event->start }}
                    @endif
                    Opis: {{ $event->description ?? 'Brak opisu' }}
                </li>
            @endforeach
        </ul>
    @else
        <p>Brak nadchodzących wydarzeń.</p>
    @endif
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>Nadchodzące Wydarzenia</title>
</head>
<body>
    <h1>Nadchodzące Wydarzenia</h1>
    @if (count($upcomingEvents) > 0)
        <ul>
            @foreach ($upcomingEvents as $event)
                <li>
                    <strong>{{ $event->title }}</strong><br>
                    Data rozpoczęcia: 
                    @if ($event->start instanceof \Carbon\Carbon)
                        {{ $event->start->format('Y-m-d H:i') }}
                    @else
                        {{ $event->start }}
                    @endif
                    <br>
                    Data zakończenia: 
                    @if ($event->end instanceof \Carbon\Carbon)
                        {{ $event->end->format('Y-m-d H:i') }}
                    @else
                        {{ $event->end }}
                    @endif
                    <br>
                    Opis: {{ $event->description ?? 'Brak opisu' }}
                </li>
            @endforeach
        </ul>
    @else
        <p>Brak nadchodzących wydarzeń.</p>
    @endif
</body>
</html>

