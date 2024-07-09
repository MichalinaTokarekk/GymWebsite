<?php

return [

    'attributes' => [
        'image' => 'Zdjęcie',
        'title' => 'Tytuł',
        'description' => 'Opis',
        'date' => 'Data',
        'categories' => 'Kategoria wiekowa',
        'trainer' => 'Trener organizujący',
        
        'zapis' => [
            'imie' => 'Imie',
            'nazwisko' => 'Nazwisko',
            'numertelefonu' => 'Numer telefonu',
            'e-mail' => 'E-mail',
        ],
    ],
    'actions' => [
        'create' => 'Dodaj nowe zawody',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano zawody :title',
            'updated' => 'Zaktualizowano zawody :title',
            'destroy' => 'Usunięto zawody :title',
            'restore' => 'Przywrócono zawody :title',
            'image_deleted' => 'Zdjecie dla zawodów :title zostalo usuniete',
        ],
        'errors' => [
            'image_deleted' => 'Nie udalo sie usunac zdjecia zawodów :title',
        ],
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowych zawodów',
        'edit_form_title' => 'Edycja zawodów',
    ],

    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie zawodów',
            'description' => 'Czy na pewno usunąć zawody :title?',
        ],
        'restore' => [
            'title' => 'Przywracanie zawodów',
            'description' => 'Czy na pewno przywrócić zawody :title?',
        ],
        'image_delete' => [
            'title' => 'Usuwanie zdjęcia dla zawodów',
            'description' => 'Czy na pewno usunac zdjecie dla zawodów :title?',
        ],
    ],
   'filters' => [
       'categories' => 'Nazwa kategorii',
   ],
];
