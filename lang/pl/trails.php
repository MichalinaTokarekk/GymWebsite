<?php

return [

    'attributes' => [

        'picture' => 'Zdjęcie',
        'name' => 'Nazwa',
        'opis' => 'Opis',
    ],
    'actions' => [
        'create' => 'Dodaj szlak',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego szlaku',
        'edit_form_title' => 'Edycja szlaku',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano szlak :name',
            'updated' => 'Zaktualizowano szlak :name',
            'destroy' => 'Usunięto szlak :name',
            'restore' => 'Przywrócono szlak :name',

        ],
    ],
    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie szlaku',
            'description' => 'Czy na pewno usunąć szlak :name',
        ],

        'restore' => [
            'title' => 'Przywracanie szlaku',
            'description' => 'Czy na pewno przywrócić szlak :name',
        ],
    ],
];
