<?php

return [

    'attributes' => [
        'name' => 'Nazwa',
        'number' => 'Ilość wejść/Dni',
        'price' => 'Cena',
        'type' => 'Typ',
        'prices' => 'Po cenie',
        'types' => 'Po typie',
        'qty' => 'Szt',
        'data_rozpoczecia' => 'Data rozpoczęcia',
        'data_zakonczenia' => 'Data ważności',

    ],
    'actions' => [
        'create' => 'Dodaj pozycję',
        'add_to_cart' => 'Dodaj',
        'edit' => 'Edytuj pozycję',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej pozycji w cenniku',
        'edit_form_title' => 'Edycja pozycji ',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano pozycję :name',
            'updated' => 'Zaktualizowano pozycję :name',
            'destroy_title' => 'Usunieto karnet',
            'destroy' => 'Usunięto karnet :name',
            'restore_title' => 'Przywrócono karnett',
            'restore' => 'Przywrócono karnet :name',
            'added_to_cart' => 'Dodano do koszyka  :name',
            'login' => 'Aby dokonać zakupu musisz się zalogować.'
        ],
    ],
    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie pozycji z cennika',
            'description' => 'Czy na pewno usunąć pozycję ":name" z cennika?',
        ],
        'restore' => [
            'title' => 'Przywracanie pozycji do cennika',
            'description' => 'Czy na pewno przywrócić pozycję ":name" do cennika?',
        ],
    ],
    'filters' => [
        'price_range' => 'Price Range',
        'price_ranges' => [
            '0_50' => '0 - 50',
            '51_100' => '51 - 100',
            '101_200' => '101 - 200',
            // Dodaj tłumaczenia dla innych przedziałów cenowych
        ],
    ],
];
