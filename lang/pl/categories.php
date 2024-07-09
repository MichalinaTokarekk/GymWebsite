<?php

return [

    'attributes' => [
        'name' => 'Nazwa',
    ],
    'actions' => [
        'create' => 'Dodaj kategorię',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej kategorii',
        'edit_form_title' => 'Edycja kategorii',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano kategorię :name',
            'updated' => 'Zaktualizowano kategorię :name',
            'destroy' => 'Usunięto kategorię :name',
            'restore' => 'Przywrócono kategorię :name',
        ],
    ],
    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie kategorii',
            'description' => 'Czy na pewno usunąć kategorię :name',
        ],
        'restore' => [
            'title' => 'Przywracanie kategorii',
            'description' => 'Czy na pewno przywrócić kategorię :name',
        ],
    ],
];
