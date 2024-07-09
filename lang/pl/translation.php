<?php

return [
    'currency' => 'zł',
    'attributes' => [
        'created_at' => 'Utworzono',
        'updated_at' => 'Zaktualizowano',
        'deleted_at' => 'Usunieto',  
    ],
    'messages' => [
        'login' => 'Musisz być zalogowany!',
        'successes' => [
            'stored_title' => 'Utworzono',
            'updated_title' => 'Zaktualizowano',
            'destroy_title' => 'Usunięto',
            'restore_title' => 'Przywrócono',
            'cart_title' => 'Koszyk zakupowy',
            
        ]
        
    ],
    'actions' => [
        'edit' => 'Edytuj',
        'destroy' => 'Usuń',
        'restore' => 'Przywróć',
        'sign_off' => 'Wypisz',
    ],
    'dialogs' =>[
        'soft_delete' => [
            'title' => 'Usuwanie ',
            'description' => 'Czy na pewno chcesz usunąć :name ?',
        ],
        'restore' => [
            'title' => 'Przywracanie',
            'description' => 'Czy na pewno przywrócić :name ?'
        ]
    ],
    'yes' => 'Tak',
    'no' => 'Nie',
    'cancel' => 'Anuluj',
    'store' => 'Utwórz',
    'update' => 'Aktualizuj',
    'save' => 'Zapisz',
    'back' => 'Wstecz',
    'enter' => 'Wprowadź wartość',
    'select' => 'Wybierz wartość',
    'account' => [
        'name2' => 'Nazwa',
        'manage_account' => 'Zarządzanie profilem',
        'profile' => 'Profil',
        'name' => 'Nazwisko i imie',
        'password' => 'Hasło',
        'password_confirm' => 'Powtórz hasło',
        'password_reset' => 'Resetuj hasło',
        'email' => 'Email',
        'remember_me' => 'Zapamiętaj mnie',
        'already_registered' => 'Już zarejestrowany',
        'confirm' => 'Potwierdź',
        'confirm_password_info' => 'Dostęp do tej funkcjonalności wymaga uprawnień',
        'forgot_password' => 'Zapomniałeś hasła?',
        'forgot_password_info' => 'Zapomniałeś hasła? Podaj adres email, a wyślemy token resetu hasła.',
        'send' => 'Wyślij',
        'logout' => 'Wyloguj się',
        'login' => 'Zaloguj się',
        'register' => 'Zarejestruj',              
        'api_tokens' => [
            'manage' => 'Zarządzaj tokenami API',
            'create_new' => 'Stwórz nowy API token',
            'description' => "API tokens allow third-party serives authentication",
            'toke_name' => 'Nazwa tokenu',
            'permissions' => 'Uprawnienia'
        ],
        'team' => [
            'manage' => 'Zarządzanie zespołem',
            'settings' => 'Ustawienie zespołu',
            'create_new' => 'Stwórz nowy zespol',
            'switch' => 'Zmien zespół',
        ]
    ],
    'navigation' => [
        'dashboard' => 'Dashboard',
        'users' => 'Użytkownicy',
        'trainers' => 'Kadra',
        'categories' => 'Kategorie zawodów',
        'competitions' => 'Zawody',
        'updates' => 'Aktualności',
        'activities' => 'Zajęcia prowadzone przez siłownię',
        'specializations' => 'Specializacje',
        'shops' => 'Sklepy współpracujące',
        'myCompetition' => 'Moje zawody',
        'myActivities' => 'Moje zajęcia',
        'tariffs' => 'Karnety',
        'tariffsPrices' => 'Cennik',
        'myTariffs' => 'Moje karnety',
        'calendar' => 'Kalendarz zajęć',
        'events' => 'Zajęcia',
        'conductedCompetition' => 'Prowadzone zawody',
        'order_wizard' => 'Składanie zamówień',
        'question' => 'Zadaj pytanie',
        'films' => 'Zdalny trening',
        'branches' => 'Filie',
        'trainerActivities' => 'Prowadzone zajęcia',

    ],
    'profile' => [
        'profile_information' => 'Informacje o profilu',
        'profile_information_description' => 
            'Zaktualizuj informacje profilowe i adres email swojego konta',
        'photo' => [
            'name'=>'Zdjęcie profilowe',
            'select_photo'=>'Wybierz nowe zdjęcie profilowe',
            'remove_photo'=>'Usuń zdjęcie profilowe',
        ],
        'name' => 'Nazwisko i imię',
        'email' => [
            'name' => 'Email',
            'unverified' => 'Twój adres email jest niezweryfikowany.',
            're-send' => 'Kliknij tutaj, aby ponownie wysłać email z weryfikacyją.',
            'info_link' => 'Nowy link weryfikacyjny został wysłany na Twój adres e-mail.',
        ],
        'places' => 'Miejscowości',
        'country' => 'Kraj',
        'interests' => 'Zainteresowania',
        'update_password' => 'Zaaktualizuj hasło',
        'update_password_description' => 
            'Upewnij się, że Twoje konto używa długiego, losowego hasła, aby zachować bezpieczeństwo.',
        'current_password' => 'Hasło bieżące',
        'password' => 'Hasło',
        'confirmpassword' => 'Potwierdź hasło',
        'new_password' => 'Nowe hasło',
        'confirm_new_password' => 'Zatwierdź nowe hasło',
        'confirm' => 'Zatwierdź',
        'saved' => 'Zapisano.',
        'save' => 'ZAPISZ',
        'disable' => 'Wyłącz',
        'enable' => 'WŁĄCZ',
        'enable2' => 'Włącz',
        'cancel' => 'Anuluj',
        'log_out_sessions' => 'WYLOGUJ SIĘ Z POZOSTAŁYCH SESJI PRZEGLĄDARKI',
        'done' => 'Wykonano.',
        'delete' => 'USUŃ KONTO',
        'two_factor_authentication' => 'Uwierzytelnianie dwuskładnikowe',
        'two_factor_authentication_description' => 
            'Dodaj dodatkowe zabezpieczenia do swojego konta, korzystając z uwierzytelniania dwuskładnikowe.',
        'two_factor_authentication_finish' => 'Zakończ włączanie uwierzytelniania dwuskładnikowego.',
        'two_factor_authentication_enable' => 'Uwierzytelniania dwuskładnikowe jest włączone.',
        'two_factor_authentication_enable_description' => 
            'Uwierzytelnianie dwuskładnikowe jest teraz włączone. 
            Zeskanuj poniższy kod QR za pomocą aplikacji uwierzytelniającej w telefonie 
            lub wprowadź klucz konfiguracji.',
        'two_factor_authentication_not_enable' => 'Nie włączyłeś uwierzytelniania dwuskładnikowego.',
        'two_factor_authentication_not_enable_description' =>
            'Gdy włączone jest uwierzytelnianie dwuskładnikowe, 
            podczas uwierzytelniania zostaniesz poproszony o podanie bezpiecznego, losowego tokena.
            Możesz pobrać ten token z aplikacji Google Authenticator w telefonie.',
        'two_factor_authentication_confirm' =>
            'Aby zakończyć włączanie uwierzytelniania dwuskładnikowego, 
            zeskanuj następujący kod QR za pomocą aplikacji uwierzytelniającej 
            w telefonie lub wprowadź klucz konfiguracji i podaj wygenerowany kod OTP.',
        'setup_key' => 'Klucz konfiguracyjny',
        'code' => 'Kod',
        'recovery_codes' => 
            'Zachowaj te kody odzyskiwania w bezpiecznym miejscu.
            Kody odzyskiwania można użyć do odzyskania dostępu do konta w przypadku utraty urządzenia 
            odpowiedzialnego za uwierzytelnianie dwuskładnikowe.',
        'regenerate_recovery_codes' => 
            'Wygeneruj ponownie kody odzyskiwania',
        'show_recovery_codes' => 
            'Pokaż kody odzyskiwania',
        'browser_sessions' => 'Sesje przeglądarki',
        'browser_sessions_description' => 'Zarządzaj i wyloguj swoje aktywne sesje w innych przeglądarkach i urządzeniach.',
        'browser_sessions_description2' => 
            'W razie potrzeby możesz wylogować się ze wszystkich innych sesji przeglądarki na wszystkich swoich urządzeniach. 
            Poniżej wymieniono niektóre z Twoich ostatnich sesji, jednak ta lista może nie być wyczerpująca. 
            Jeśli uważasz, że Twoje konto zostało przejęte, powinieneś również zaktualizować swoje hasło.',
        'browser_sessions_password' => 
            'Wprowadź hasło, aby potwierdzić,
            że chcesz wylogować się z innych sesji przeglądarki na wszystkich swoich urządzeniach.',
        'unknown' => 'Nieznane',
        'this_device' => 'To urządzenie',
        'last_active' => 'Ostantia aktywność ',
        'delete_account' => 'Usuń konto',
        'delete_account_description' => 
            'Trwale usuń swoje konto',
        'delete_account_description2' => 
            'Po usunięciu konta wszystkie jego zasoby i dane zostaną trwale usunięte.
             Przed usunięciem konta pobierz wszelkie dane lub informacje, które chcesz zachować.',
        'delete_confirm' => 
            'Czy na pewno chcesz usunąć swoje konto? 
            Po usunięciu konta wszystkie jego zasoby i dane zostaną trwale usunięte. 
            Wprowadź hasło, aby potwierdzić, że chcesz trwale usunąć swoje konto. ',
        
        
    ],
];
