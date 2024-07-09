<?php


return [
    'attributes' => [
        'imie' => 'Imie',
        'nazwisko' => 'Nazwisko',
        'email' => 'Email',
        'password' => 'Hasło',
        'opis' => 'Opis',
        'image' => 'Zdjęcie',
        'specializations' => 'Specjalizacje',


        'roles' => 'Role',
        'email_verified_at' => 'Email zweryfikowany',
        'activities' => 'Zajęcia',
    ],
    'actions' => [
        'create' => 'Dodaj użytkownika',
        'assign_admin_role' => 'Ustaw role admina',
        'remove_admin_role' => 'Odbierz role admina',
        'assign_worker_role' => 'Ustaw role pracownika',
        'remove_worker_role' => 'Odbierz role pracownika',
        'assign_trainer_role' => 'Ustaw role trenera',
        'remove_trainer_role' => 'Odbierz role trenera',
        'assign_dietician_role' => 'Ustaw role dietetyka',
        'remove_dietician_role' => 'Odbierz role dietetyka',
        'assign_physiotherapist_role' => 'Ustaw role fizjoterapeuty',
        'remove_physiotherapist_role' => 'Odbierz role fizjoterapeuty',
    ],
    'messages' => [
        'successes' => [
            'admin_role_assigned' => 'Ustawiono role admina dla :imie :nazwisko',
            'admin_role_removed' => 'Odebrano role admina dla :imie :nazwisko',
            'worker_role_assigned' => 'Ustawiono role pracownika dla :imie :nazwisko',
            'worker_role_removed' => 'Odebrano role pracownika dla :imie :nazwisko',
            'trainer_role_assigned' => 'Ustawiono role trenera dla :imie :nazwisko',
            'trainer_role_removed' => 'Odebrano role trenera dla :imie :nazwisko',
            'dietician_role_assigned' => 'Ustawiono role dietetyka dla :imie :nazwisko',
            'dietician_role_removed' => 'Odebrano role dietetyka dla :imie :nazwisko',
            'physiotherapist_role_assigned' => 'Ustawiono role fizjoterapeuty dla :imie :nazwisko',
            'physiotherapist_role_removed' => 'Odebrano role fizjoterapeuty dla :imie :nazwisko',
            'destroy' => "Usunięto użytkownika :imie :nazwisko",
            'restore' => "Przywrócono użytkownika :imie :nazwisko",
            'updated' => "Zaktualizowano użytkownika :imie :nazwisko",
            'image_deleted' => "Usunięto zdjęcie użytkownika :imie :nazwisko",
            'stored' => "Dodano nowego użytkownika :imie :nazwisko"
        ]
    ],
    'dialogs' =>[
        'assign_role' => [
            'title' => 'Nadawanie roli!',
            'admin' => 'Czy chcesz nadać rolę admina dla użytkownika :imie :nazwisko?',
            'worker' => 'Czy chcesz nadać rolę pracownika dla użytkownika :imie :nazwisko?',
            'trainer' => 'Czy chcesz nadać rolę trenera dla użytkownika :imie :nazwisko?',
            'dietician' => 'Czy chcesz nadać rolę dietetyka dla użytkownika :imie :nazwisko?',
            'physiotherapist' => 'Czy chcesz nadać rolę fizjoterapeuty dla użytkownika :imie :nazwisko?'
        ],
        'remove_role' => [
            'title' => 'Usuwanie roli!',
            'admin' => 'Czy chcesz usunąć rolę admina dla użytkownika :imie :nazwisko?',
            'worker' => 'Czy chcesz usunąć rolę pracownika dla użytkownika :imie :nazwisko?',
            'trainer' => 'Czy chcesz usunąć rolę trenera dla użytkownika :imie :nazwisko?',
            'dietician' => 'Czy chcesz usunąć rolę dietetyka dla użytkownika :imie :nazwisko?',
            'physiotherapist' => 'Czy chcesz usunąć rolę fizjoterapeuty dla użytkownika :imie :nazwisko?'
        ],
        'soft_delete' => [
            'title' => 'Usuwanie użytkownika!',
            'description' => 'Czy chcesz usunąć uzytkownika :imie :nazwisko?'
        ],
        'restore' => [
            'title' => 'Przywracanie uzytkownika!',
            'description' => 'Czy chcesz przywrócić uzytkownika :imie :nazwisko?'
        ],
        'image_delete' => [
            'title' => 'Usuwanie zdjęcia!',
            'description' => 'Czy chcesz usunąć zdkęcie użytkownika :imie :nazwisko?'
        ]
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego użytkownika',
        'edit_form_title' => 'Edycja użytkownika',
    ],
];