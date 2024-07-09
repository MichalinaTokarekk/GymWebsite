<?php

return [

    'attributes' => [
        'name' => 'Nazwa',
        'description' => 'Opis',
        'image' => 'Zdjęcie',
        'imie' => 'Imie',
        'nazwisko' => 'Nazwisko',
        'opis' => 'Opis',
        'trainer' => 'Trener prowadzący'
    ],
    'actions' => [
        'create' => 'Dodaj zajęcia',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego zajęcia',
        'edit_form_title' => 'Edycja zajęcia',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano zajęcie :name.',
            'updated' => 'Zaktualizowano zajęcie :name.',
            'destroy' => 'Usunięto zajęcie :name.',
            'restore' => 'Przywrócono zajęcie :name.',
            'image_deleted' => 'Usunięto zdjęcie zajęcia :name.',
        ],
    ],
    // activities.messages.successes.image_deleted
    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie zajęcia',
            'description' => 'Czy na pewno usunąć zajęcie :name???',
        ],
        'restore' => [
            'title' => 'Przywracanie zajęcia',
            'description' => 'Czy na pewno przywrócić zajęcie :name???',
        ],
        'image_delete' => [
            'title' => 'Usuwanie zajęcia',
            'description' => 'Czy na pewno usunąć zdjęcie z zajęcia :name???',
        ],
    ],
];
