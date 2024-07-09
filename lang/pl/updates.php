<?php

return [

    'attributes' => [
        'image' => 'Zdjęcie',
        'nazwa' => 'Nazwa',
        'opis' => 'Opis',
        'title' => 'Tytuł'
    ],
    'actions' => [
        'create' => 'Dodaj nowy wpis',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano wpis :title',
            'updated' => 'Zaktualizowano wpis :title',
            'destroy' => 'Usunięto wpis :title',
            'restore' => 'Przywrócono wpis :title',
            'image_deleted' => 'Zdjecie dla wpisu :nazwa zostalo usuniete',
        ],
        'errors' => [
            'image_deleted' => 'Nie udalo sie usunac zdjecia wpisu :title',
        ],
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego wpisu',
        'edit_form_title' => 'Edycja wpisu',
    ],

    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie wpisu',
            'description' => 'Czy na pewno usunąć wpis :title',
        ],
        'restore' => [
            'title' => 'Przywracanie wpis',
            'description' => 'Czy na pewno przywrócić wpisu :title',
        ],
        'image_delete' => [
            'title' => 'Usuwanie zdjęcia dla  wpisu :title',
            'description' => 'Czy na pewno usunac zdjecie dla wpisu :title',
        ],
    ],

];
