<?php

return [

    'attributes' => [
        'video' => 'Film',
        'title' => 'Tytuł',
        'description' => 'Opis',
    ],
    'actions' => [
        'create' => 'Dodaj nowy trening',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano trening :title',
            'updated' => 'Zaktualizowano trening :title',
            'destroy' => 'Usunięto trening :title',
            'restore' => 'Przywrócono trening :title',
            'film_deleted' => 'Film dla treningu :title został usuniety',
        ],
        'errors' => [
            'film_deleted' => 'Nie udalo sie usunac trening :title',
        ],
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego treningu zdalnego',
        'edit_form_title' => 'Edycja treningu',
    ],

    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie treningu zdalnego',
            'description' => 'Czy na pewno usunąć trening :title?',
        ],
        'restore' => [
            'title' => 'Przywracanie treningu',
            'description' => 'Czy na pewno przywrócić trening :title?',
        ],
        'film_delete' => [
            'title' => 'Usuwanie zdjęcia dla treningu zdalnego',
            'description' => 'Czy na pewno usunac wideo dla treningu :title?',
        ],
    ],
];
