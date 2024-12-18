document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'élément du calendrier
    var calendarEl = document.getElementById('calendar');

    // Initialiser le calendrier FullCalendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',  // Vue par défaut (mois)
        events: function (info, successCallback, failureCallback) {
            // Récupérer les événements depuis l'API avec AJAX
            fetch('http://localhost/SAE301Local/api/get_event.php') // Remplacez par l'URL de votre API
                .then(response => response.json())
                .then(data => {
                    // Ajouter les événements dans FullCalendar
                    const events = data.events.map(event => ({
                        id: event.id,  // ID de l'événement pour l'édition
                        title: event.titre,
                        start: event.date_event,  // Date de début de l'événement
                        description: event.description,  // Description de l'événement
                        location: event.lieu,  // Lieu de l'événement
                        type: event.type,  // Type de l'événement
                    }));

                    successCallback(events); // Ajouter les événements au calendrier
                })
        },

    });

    // Rendre le calendrier visible
    calendar.render();
});

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'http://localhost/SAE301Local/api/get_event.php', // URL où les événements sont chargés
        eventClick: function (info) {
            // Récupérer les données de l'événement cliqué
            const title = info.event.title;
            const description = info.event.extendedProps.description;

            // Mettre à jour les éléments dans la section en dessous
            document.querySelector('.event-title').textContent = `Événement sélectionné : ${title}`;
            document.querySelector('.description').textContent = description;
        }
    });

    calendar.render();
});
