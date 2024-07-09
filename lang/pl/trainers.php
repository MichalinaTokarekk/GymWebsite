<?php

return [

    'attributes' => [
        'image' => 'Zdjęcie',
        'imie' => 'Imie',
        'nazwisko' => 'Nazwisko',
        'opis' => 'Opis',
        'trainer' => 'Trener prowadzący'
    ],
    'actions' => [
        'create' => 'Dodaj trenera',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano trenera :imie :nazwisko',
            'updated' => 'Zaktualizowano trenera :imie :nazwisko',
            'destroy' => 'Usunięto trenera :imie :nazwisko',
            'restore' => 'Przywrócono trenera :imie :nazwisko',
            'image_deleted' => 'Zdjecie dla trenera :imie :nazwisko zostalo usuniete',
        ],
        'errors' => [
            'image_deleted' => 'Nie udalo sie usunac zdjecia trenera :imie :nazwisko',
        ],
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego trenera',
        'edit_form_title' => 'Edycja trenera',
    ],

    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie trenera',
            'description' => 'Czy na pewno usunąć trenera :imie :nazwisko',
        ],
        'restore' => [
            'title' => 'Przywracanie trenera',
            'description' => 'Czy na pewno przywrócić trenera :imie :nazwisko',
        ],
        'image_delete' => [
            'title' => 'Usuwanie zdjęcia dla  trenera :imie',
            'description' => 'Czy na pewno usunac zdjecie dla trenera :imie',
        ],
    ],
   // 'filters' => [
       // 'category' => 'Nazwa kategorii',
   // ],
];
