<?php

return [

    'attributes' => [

        'picture' => 'Zdjęcie',
        'name' => 'Nazwa',
        'opis' => 'Opis',
    ],
    'actions' => [
        'create' => 'Dodaj schronisko',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego schroniska',
        'edit_form_title' => 'Edycja schroniska',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano schronisko :name',
            'updated' => 'Zaktualizowano schronisko :name',
            'destroy' => 'Usunięto schronisko :name',
            'restore' => 'Przywrócono schronisko :name',

        ],
    ],
    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie schroniska',
            'description' => 'Czy na pewno usunąć schronisko :name',
        ],
        'restore' => [
            'title' => 'Przywracanie schroniska',
            'description' => 'Czy na pewno przywrócić schronisko :name',
        ],
    ],
];
