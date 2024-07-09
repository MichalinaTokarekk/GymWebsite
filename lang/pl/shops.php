<?php

return [

    'attributes' => [
        'image' => 'Zdjęcie',
        'title' => 'Tytuł',
        'link' => 'Link',
        'description' => 'Opis',
    ],
    'actions' => [
        'create' => 'Dodaj nowy sklep',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano sklep :title',
            'updated' => 'Zaktualizowano sklep :title',
            'destroy' => 'Usunięto sklep :title',
            'restore' => 'Przywrócono sklep :title',
            'image_deleted' => 'Zdjecie dla sklepu :title zostalo usuniete',
        ],
        'errors' => [
            'image_deleted' => 'Nie udalo sie usunac zdjecia sklepu :title',
        ],
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowych sklepów',
        'edit_form_title' => 'Edycja sklepu',
    ],

    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie sklepu',
            'description' => 'Czy na pewno usunąć sklep :title?',
        ],
        'restore' => [
            'title' => 'Przywracanie sklepu',
            'description' => 'Czy na pewno przywrócić sklep :title?',
        ],
        'image_delete' => [
            'title' => 'Usuwanie zdjęcia dla sklepu',
            'description' => 'Czy na pewno usunac zdjecie dla sklepu :title?',
        ],
    ],
];
