<?php

return [

    'attributes' => [
        'place' => 'Miejscowość',
        'name' => 'Nazwa',
        'address' => 'Adress',
        'phone' => 'Kontakt',
        'elements' => 'Udogodnienia',


    ],
    'actions' => [
        'zajeciagrupowe' => 'Zajecia grupowe',
        'atmosfera' => 'Przyjazna atmosfera',
        'sauna' => 'Sauna',
        'wifi' => 'WiFi',
        'parking' => 'Parking',
        'solarium' => 'Solarium',
        'szafki' => 'Szafki na kłódkę',
        'create' => 'Dodaj filie',
    ],

    'messages' => [
        'successes' => [
            'stored' => 'Dodano filię :name',
            'updated' => 'Zaktualizowano filię :name',
            'destroy' => 'Usunięto filię :name',
            'restore' => 'Przywrócono filię :name',
        ],
    ],


    'labels' => [
        'create_form_title' => 'Tworzenie nowej filii',
        'edit_form_title' => 'Edycja filii',
    ],

    'dialogs' => [
        'soft_delete' => [
            'title' => 'Usuwanie filii',
            'description' => 'Czy na pewno usunąć filie :name?',
        ],
    ]


];
