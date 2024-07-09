<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="">
        <div class="flex justify-between h-16">
            <div class="flex">
                
                <!-- Logo -->
                <div class="shrink-0 flex items-center" >
                    <a href="{{ route('updates.index') }}">
                    <img src="/storage/logoSilownia.png" width="40px" height="40px"
                    /></a>
                </div>

{{-- //////////////////////////////////////////////////////////////////////////////////////////////////// --}} 
{{--                                        MENU NAWIGACYJNE                                              --}} 
{{-- //////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" >

                    {{-- Aktualności --}}
                    <x-nav-link  href="{{ route('updates.index') }}" :active="request()->routeIs('updates.index')">
                        {{ __('translation.navigation.updates') }}
                    </x-nav-link>
                    {{-- /Aktualności --}}

                    {{-- Kalendarz Zajęć --}}
                    <x-nav-link  href="{{ route('calendar') }}" :active="request()->routeIs('calendar')">
                        {{ __('translation.navigation.calendar') }}
                    </x-nav-link>
                    {{-- /Kalendarz Zajęć --}}
                    
                    {{-- Filie --}}
                    <x-nav-link href="{{ route('branches.index') }}" :active="request()->routeIs('branches.index')">
                        {{ __('translation.navigation.branches') }}
                    </x-nav-link>
                    {{-- /Filie --}}

                    {{-- Zawody --}}
                    <div class="dropdown" >
                        <x-button onclick="dropdownCompetitions()" class="dropbtn">Zawody</x-button>
                        <div id="dropdownCompetitions" class="dropdown-content" >
                            <a href="{{ route('competitions.index') }}">
                                {{ __('translation.navigation.competitions') }}
                            </a>
                            @auth
                                @if(auth()->user()->hasRole('admin'))
                                    <a href="{{ route('categories.index') }}">
                                        {{ __('translation.navigation.categories') }}
                                    </a>
                                @endif
                        

                                <a href="{{ route('competitions.myCompetition', ['user' => Auth::user()]) }}">
                                    {{ __('translation.navigation.myCompetition') }}
                                </a>
                            
                                @if (auth()->user()->hasRole('trainer'))
                                    <a href="{{ route('competitions.conductedCompetition', ['user' => Auth::user()]) }}">
                                        {{ __('translation.navigation.conductedCompetition') }}
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                    {{-- /Zawody --}}
                   
                    {{-- Zajęcia --}}                 
                    <div class="dropdown">
                        <x-button onclick="dropdownActivities()" class="dropbtn">Zajęcia</x-button>
                        <div id="dropdownActivities" class="dropdown-content">
                            <a href="{{ route('activities.index') }}">
                                {{ __('translation.navigation.activities') }}
                            </a>
                            @auth
                                @if(Auth::user()->isOnlyUser())
                                    <a href="{{ route('events.myEvents', ['user' => Auth::user()]) }}">
                                        {{ __('translation.navigation.myActivities') }}
                                    </a>
                                @endif
                                @if(Auth::user()->hasRole('trainer'))
                                    <a href="{{ route('events.trainerEvents', ['user' => Auth::user()]) }}">
                                        {{ __('translation.navigation.trainerActivities') }}
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>                   
                    {{-- /Zajęcia  --}}

                    {{-- Karnety --}}                   
                    <div class="dropdown">
                        <x-button onclick="dropdownTariffs()" class="dropbtn">Karnety</x-button>
                        <div id="dropdownTariffs" class="dropdown-content">
                            
                            <a href="{{ route('tariffs.index') }}">
                                {{ __('translation.navigation.tariffsPrices') }}
                            </a>
                            @auth    
                                <a href="{{ route('myTariffs.myTariffs', ['user' => Auth::user()]) }}">
                                    {{ __('translation.navigation.myTariffs') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                    {{-- /Karnety --}}

                    {{-- Sklepy --}}
                    <x-nav-link href="{{ route('shops.index') }}" :active="request()->routeIs('shops.index')">
                        {{ __('translation.navigation.shops') }}
                    </x-nav-link>
                    {{-- /Sklepy --}}

                    {{-- Kadra --}}
                    <x-nav-link href="{{ route('trainers.index') }}" :active="request()->routeIs('trainers.index')">
                        {{ __('translation.navigation.trainers') }}
                    </x-nav-link>
                    {{-- /Kadra --}}
                   
                    {{-- Zdalny trening --}}
                    @auth                                     
                    <x-nav-link  href="{{ route('films.index') }}" :active="request()->routeIs('films')">
                        {{ __('translation.navigation.films') }}
                    </x-nav-link>
                    @endauth
                    {{-- /Zdalny trening --}} 

                    {{-- Pytania --}}   
                    <x-nav-link href="{{ route('question.index') }}" :active="request()->routeIs('question.index')">
                        {{ __('translation.navigation.question') }}
                    </x-nav-link>
                    {{-- /Pytania --}}                   
                     
                    {{-- Powiadomienia --}} 
                    @if(Auth::check())
                        <div class="notification-container">
                            <button class="notification-button" onclick="toggleUpcomingEvents()">
                                <span class="notification-icon">&#128276;</span><br>
                                    Powiadomienia
                                <span id="notification-count" class="notification-count">0</span>
                            </button>
                            <div id="eventsAlerts" class="dropdown-content">
                                <p>Oto nadchodzące wydarzenia:</p>
                                <ul id="upcomingEventsList"></ul>
                            </div>
                        </div>
                    @endif
                    {{-- /Powiadomienia --}} 
                </div> <!-- Zakończenie div'a od menu nawigacyjnego -->
            </div> <!-- Zakończenie div'a flex-->

{{-- //////////////////////////////////////////////////////////////////////////////////////////////////// --}} 
{{--                                   KONIEC MENU NAWIGACYJNE                                            --}} 
{{-- //////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            {{-- Sekcja Logowania i autoryzacji --}}
            <div class="hidden sm:flex sm:items-right sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
           
                @endif

                {{-- KOSZYK ZAKUPOWY --}}
                @auth
                    @if(Auth::user()->isOnlyUser())
                        <div class="" style="margin-right: 0px;">
                            <livewire:cart.cart-counter />
                        </div>
                    @endif
                @endauth
                {{-- /KOSZYK ZAKUPOWY --}}


                {{-- API token --}}
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <button href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </button>
                @endif
                {{-- /API token  --}}


                {{-- Authentication --}}
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @auth
                    @csrf    
                    
                    {{-- Panel administratora --}}
                    @if(auth()->user()->hasRole('admin'))
                    <div class="dropdown">
                        <x-button onclick="dropdownAdminPanel()" class="dropbtn"  style="background-color: #e8e2dd; margin-right: 1px">Panel administratora</x-button>
                        <div id="dropdownAdminPanel" class="dropdown-content" >
                            <a href="{{ route('users.index') }}">
                                {{ __('translation.navigation.users') }}
                            </a>
                            <a href="{{ route('specializations.index') }}">
                                    {{ __('translation.navigation.specializations') }}
                            </a>
                        </div>
                    </div>
                    @endif
                    {{-- /Panel administratora --}}
                    
                
                    {{-- Menu użytkownika --}}
                    <div class="dropdown">
                        <x-button onclick="dropdownAccount()" class="dropbtn" style="background-color: #e8e2dd; margin-right: 1px">
                            {{ Auth::user()->imie }} {{ Auth::user()->nazwisko }}
                        </x-button>
                        <div id="dropdownAccount" class="dropdown-content">
                            <a href="{{ route('profile.show') }}">
                                {{ __('Mój profil') }}
                            </a>
                            <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Wyloguj') }}
                            </a>
                            <a href="{{ route('myQuestions') }}">Moje pytania</a>
                        </div>
                    </div>
                    {{-- /Menu użytkownika --}}
                    
                    @else
                    @if (Route::has('login'))
                    <div class=" sm:top-0 sm:right-30 p-6 text-right">
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            {{__('translation.account.login')}}
                        </a>
            
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                {{__('translation.account.register')}}
                            </a>
                        @endif
                    </div>
                @endif
            @endauth
                </form>
                {{-- /Authentication --}}   

            </div>
            {{-- /Sekcja Logowania i autoryzacji --}}

            {{-- Menu responsywne --}}
            
            {{-- Hamburger --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            {{-- /Hamburger --}}
        </div>
    
        @auth
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <div class="border-t border-gary-200 pt-2">
                <livewire:cart.cart-counter />
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-responsive-nav-link>
                        @endcan

                        <div class="border-t border-gray-200"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                </div>
            </div>
        @endauth
        {{-- /Menu responsywne --}}
    </div>



{{-- //////////////////////////////////////////////////////////////////////////////////////////////////// --}} 
{{--                                       STYLE                                                          --}} 
{{-- //////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                    
<style>
        .red-badge {
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
        position: relative; /* Ustaw na "relative" zamiast "absolute" */
        top: 0;
        right: 0;
    }


 /* Styl dla menu na urządzeniach mobilnych */
 @media only screen and (max-width: 768px) {
    .sm\:hidden {
        display: none !important;
    }

    .sm\:block {
        display: block !important;
    }

    .sm\:flex {
        display: flex !important;
    }

    .sm\:items-right {
        align-items: flex-end !important;
    }

    .sm\:ml-6 {
        margin-left: 1.5rem !important;
    }

    .sm\:mr-2 {
        margin-right: 0.5rem !important;
    }

    .sm\:p-2 {
        padding: 0.5rem !important;
    }

    .sm\:py-3 {
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
    }

    .sm\:pt-4 {
        padding-top: 1rem !important;
    }

    .sm\:pb-1 {
        padding-bottom: 0.25rem !important;
    }

    .sm\:border-t {
        border-top-width: 1px !important;
    }
}

/* .dropdown-content {
    display: none;
    position: absolute; 
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
} */

/* .notification-container {
    position: relative; 
    display: inline-block;
}

.notification-button {
    background-color: transparent;
    border: none;
    cursor: pointer;
} */

/* .notification-container {
    position: relative; 
    display: inline-block;
}

.notification-button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    padding: 10px;
}

/* Styl dla napisu "Powiadomienie" */
.notification-button span.notification-icon {
    margin-right: 10px; 
}

/* .notification-button span.notification-count {
    background-color: #e5e5e5;
    border-radius: 50%; 
    padding: 5px 10px; 
    margin-left: 5px; 
    color: #333; 
} */

/* Styl dla dropdown-content */
.dropdown-content {
    /* display: none; */
    position: absolute; 
    background-color: #f9f9f9;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center; /*Wyśrodkowanie tekstu w dropdownie*/
}

/* Styl dla nadchodzących wydarzeń */
#eventsAlerts p {
    font-weight: bold;
    margin: 10px;
}

#upcomingEventsList {
    list-style-type: none;
    padding: 0;
}

#upcomingEventsList li {
    margin: 5px 0;
} 


</style>

{{-- //////////////////////////////////////////////////////////////////////////////////////////////////// --}} 
{{--                                            SKRYPTY                                                   --}} 
{{-- //////////////////////////////////////////////////////////////////////////////////////////////////// --}}

{{-- Biblioteka jquery odpowiedzialna za dzialanie skryptow --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- /Biblioteka --}}

{{-- Skrypt dropdownu panelu administratora --}}
<script>
    function dropdownAdminPanel() {
        hideOpenDropdowns();
        document.getElementById("dropdownAdminPanel").classList.toggle("show");
    }

// {{-- /Skrypt dropdownu panelu administratora --}}

// {{-- Skrypt dropdownu menu użytkownika --}}

    function dropdownAccount() {
        hideOpenDropdowns();
        document.getElementById("dropdownAccount").classList.toggle("show");
    }

// {{--/ Skrypt dropdownu menu użytkownika --}}

// {{-- Skrypt dropdownu zawodów --}}

    function dropdownCompetitions() {
        hideOpenDropdowns();
        document.getElementById("dropdownCompetitions").classList.toggle("show");
    }

// {{-- /Skrypt dropdownu zawodów --}}

// {{-- Skrypt dropdownu zajęć --}}

    function dropdownActivities() {
        hideOpenDropdowns();
        document.getElementById("dropdownActivities").classList.toggle("show");
    }

// {{-- /Skrypt dropdownu zajęć --}}

// {{-- Skrypt dropdownu karnetów --}}

    function dropdownTariffs() {
        hideOpenDropdowns();
        document.getElementById("dropdownTariffs").classList.toggle("show");
    }

// {{-- /Skrypt dropdownu karnetów --}}

// {{-- Skrypt zamykania otwartych dropdownów--}}

function hideOpenDropdowns() {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
    }
    if(typeof eventsAlerts !== 'undefined')
    eventsAlerts.style.display = "none";
}

// {{-- Skrypt zamykania otwartych dropdownów--}}

// {{-- Skrypt zamykania dropdownu klikając na stronie--}}

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            // Kod dla wszystkich event listenerów
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
            
        }
       
    }

// {{-- /Skrypt zamykania dropdownu klikając na stronie--}}

// {{-- Skrypt dropdownu powiadomien --}}

    var isUpcomingEventsVisible = false;

    function toggleUpcomingEvents() {
        if (isUpcomingEventsVisible) {
            // Jeśli widoczne, schowaj dropdown z nadchodzącymi wydarzeniami
            hideUpcomingEvents();
        } else {
            // Jeśli niewidoczne, pokaż dropdown i załaduj nadchodzące wydarzenia
            showUpcomingEvents();
            loadUpcomingEvents();
        }
    }

    function showUpcomingEvents() {
        hideOpenDropdowns();
        var eventsAlerts = document.getElementById("eventsAlerts");
        eventsAlerts.style.display = "block";
        isUpcomingEventsVisible = true;
    }

    function hideUpcomingEvents() {
        var eventsAlerts = document.getElementById("eventsAlerts");
        eventsAlerts.style.display = "none";
        isUpcomingEventsVisible = false;
    }

    document.addEventListener("DOMContentLoaded", function() {
        loadUpcomingEvents();
    });

    function loadUpcomingEvents() {
        $.get("/get-upcoming-events", function(data) {
            var upcomingEventsList = $("#upcomingEventsList");
            upcomingEventsList.empty();

             // Oblicz liczbę nadchodzących wydarzeń
                var numberOfEvents = data.length;
                
                // Zaktualizuj liczbę na przycisku "Powiadomienia"
                var notificationCount = $("#notification-count");
                notificationCount.text(numberOfEvents);
                
                // Jeśli jest przynajmniej jedno nadchodzące wydarzenie, możesz zmienić wygląd ikonki na czerwoną lub inny sposób oznaczenia liczby powiadomień
                if (numberOfEvents > 0) {
                    notificationCount.addClass("red-badge"); // Dodaj klasę, która zmienia wygląd ikonki lub innego wskaźnika
                } else {
                    notificationCount.removeClass("red-badge"); // Usuń klasę, jeśli nie ma powiadomień
                }


                $.each(data, function(index, event) {
                var eventDate = new Date(event.start);
                var formattedDate = eventDate.toLocaleString();
                var listItem = $("<li>").text("Jutro masz wydarzenie: " + event.title + " od " + formattedDate + " do " + event.end);
                upcomingEventsList.append(listItem);
            });

            if (window.innerWidth <= 768) {
            var responsiveNav = document.querySelector(".sm\\:hidden");
            if (responsiveNav) {
                responsiveNav.style.display = "none";
            }
        }
    });
    }
</script>
{{-- /Skrypt dropdownu powiadomień --}}


{{-- //////////////////////////////////////////////////////////////////////////////////////////////////// --}} 
{{--                                       KONIEC SKRYPTÓW                                                --}} 
{{-- //////////////////////////////////////////////////////////////////////////////////////////////////// --}}
</nav> <!-- Zamnkięcie sekcji menu nawigacyjnego -->