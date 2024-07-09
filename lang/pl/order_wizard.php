<?php

return [
    'cart' => [
        'title' => 'Koszyk zakupów',
        'columns' => [
            'tariff' => 'Produkty',
            'qty' => 'Ilość',
            'unit_price' => 'Cena za szt.',
            'cost' => 'Wartość',
        ],
        'labels' => [
            'decrease_qty' => 'Zmniejsz ilość',
            'increase_qty' => "Zwiększ ilość",
            'empty' => 'Koszyk zakupowy jest pusty',
        ],
    ],
    
    'dialogs' => [
        'remove' => [
            'title' => 'Usuwanie pozycji z koszyka',
            'description' => 'Czy na pewno usunąć pozycję z koszyka :name?',
        ],
    ],
    'delivery' => [
        'title' => 'Dane zamówienia',
        'attribute' => [
            'name' => 'Zamawiający',
            'address' => 'Dane adresowe',
            'flat_number' => 'Nr lokalu',
            'building_number' => 'Nr budynku/domu',
            'postcode' => 'Kod pocztowy',
            'city' => 'Miasto',
            'street' => 'Ulica'
        ],
    ],
    'confirm_order' => [
        'title' => 'Potwierdzenie zamówienia',
        'columns' => [
            'product' => 'Produkty',
            'tariff' => 'Produkty',
            'qty' => 'Ilość',
            'unit_price' => 'Cena za szt.',
            'cost' => 'Wartość',
        ],
        'labels' => [
            'delivery' => 'Dane zamawiającego',
            'delivery_name' => 'Imię i nazwisko',
            'delivery_address' => 'Adres',
            'delivery_city' => 'Miasto',
            'delivery_street' => 'Ulica',
            'delivery_building_number' => 'Nr budynku/domu',
            'delivery_flat_number' => 'Nr lokalu',
            'delivery_postcode' => 'Kod pocztowy',
            'total_cost' => 'Koszt całkowity',
            'total_qty_items' => 'Ilość pozycji',
            'confirm_order' => 'Złóż zamówienie',
        ],
        'messages' => [
            'successes' => [	
                'ordered' => [
                    'title' => 'Złożono zamówienie',
                    'description' => 'Złożono zamówienie na produkty o wartosci :total_cost. Podsumowanie wysłano na maila.'
                ]
            ]
        ]
    ],
    'email_notification' => [
        'subject' => 'Zamówienie numer #:number',
        'labels' => [
            'ordered_products' => 'Zamówione produkty',
        ],
    ],
    
];
