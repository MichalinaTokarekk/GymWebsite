<?php

return [

    'attributes' => [
        'name' => 'Nazwa',
    ],
    'actions' => [
        'create' => 'Dodaj specializację',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej specializacji',
        'edit_form_title' => 'Edycja specializacji',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano specializację :name',
            'updated' => 'Zaktualizowano specializację :name',
            'destroy' => 'Usunięto specializację :name',
            'restore' => 'Przywrócono specializację :name',
        ],
    ],
    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie specializacji',
            'description' => 'Czy na pewno usunąć specializację :name?',
        ],
        'restore' => [
            'title' => 'Przywracanie kategorii',
            'description' => 'Czy na pewno przywrócić specializację :name?',
        ],
    ],
];
