<?php

return [

    'attributes' => [
        'current_participants' => 'Obecna liczba uczestników',
        'description' => 'Opis zajęcia',
        'date_end' => 'Data zakończenia zajęć',
        'date_start' => 'Data rozpoczęcia zajęć',
        'max_participants' => 'Maksymalna liczba uczestników',
        'title' => 'Nazwa zajęcia',
        'time_end' => 'Godzina zakończenia zajęć',
        'time_start' => 'Godzina rozpoczęcia zajęć',
        'trainer' => 'Trener organizujący',
    ],
    'actions' => [
        'create' => 'Dodaj wpis do kalendarza',
        'edit' => 'Edytuj wpis kalendarza',
        'sign' => 'Zapisz się na zajęcia',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego wpisu',
        'edit_form_title' => 'Edycja wpisu',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano zajęcie :name.',
            'updated' => 'Zaktualizowano zajęcie :name.',
            'destroy' => 'Usunięto zajęcie :name.',
            'restore' => 'Przywrócono zajęcie :name.',
        ],
    ],
    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie wpisu',
            'description' => 'Czy na pewno usunąć zajęcie :name???',
        ],
        'restore' => [
            'title' => 'Przywracanie wpisu',
            'description' => 'Czy na pewno przywrócić zajęcie :name???',
        ],
        'sign_off_event' => [
            'user' =>[
                'title' => 'Wypisanie z zajęć',
                'description' => 'Czy na pewno chcesz wypisać użytkownika :name z zajęć :title???',
            ],
            'title' => 'Wypisanie się z zajęć',
            'description' => 'Czy na pewno chcesz się wypisać z zajęć :title???',
        ],
        
    ],
];
