//////////////////////////////////////////////////////////////////////////////////////////////////// 
//                                    SKRYPTU NAVIGATION-MENU-BLADE                              //    
//////////////////////////////////////////////////////////////////////////////////////////////////

//  Skrypt dropdownu panelu administratora 

    function dropdownAdminPanel() {
        hideOpenDropdowns();
        document.getElementById("dropdownAdminPanel").classList.toggle("show");
    }


// Skrypt dropdownu menu użytkownika 

    function dropdownAccount() {
        hideOpenDropdowns();
        document.getElementById("dropdownAccount").classList.toggle("show");
    }


// Skrypt dropdownu zawodów 

    function dropdownCompetitions() {
        hideOpenDropdowns();
        document.getElementById("dropdownCompetitions").classList.toggle("show");
    }

// Skrypt dropdownu zajęć 

    function dropdownActivities() {
        hideOpenDropdowns();
        document.getElementById("dropdownActivities").classList.toggle("show");
    }

// Skrypt dropdownu karnetów 

    function dropdownTariffs() {
        hideOpenDropdowns();
        document.getElementById("dropdownTariffs").classList.toggle("show");
    }

// Skrypt zamykania otwartych dropdownów

function hideOpenDropdowns() {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
    }
}

// Skrypt zamykania dropdownu klikając na stronie

    window.onclick = function(event) {
        // hideOpenDropdowns();
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

// Skrypt dropdownu powiadomien 

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
        });
    }


//////////////////////////////////////////////////////////////////////////////////////////////////// 
//                                    KONIEC SKRYPTÓW                                            //    
//////////////////////////////////////////////////////////////////////////////////////////////////