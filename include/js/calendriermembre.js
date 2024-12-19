document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'élément du calendrier
    var calendarEl = document.getElementById('calendar'); 

    // Initialiser le calendrier FullCalendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',  // Vue par défaut (mois)
        events: function(info, successCallback, failureCallback) {
            // Récupérer les événements depuis l'API avec AJAX
            fetch('http://localhost/SAE301Local/api/get_event.php') // L'URL de votre API
                .then(response => response.json())
                .then(data => {
                    // Ajouter les événements dans FullCalendar
                    const events = data.events.map(event => ({
                        id: event.id,  // ID de l'événement
                        title: event.titre,
                        start: event.date_event,  // Date de début de l'événement
                        description: event.description,  // Description de l'événement
                    }));
                    
                    successCallback(events); // Ajouter les événements au calendrier
                })
                .catch(error => console.error('Erreur lors de la récupération des événements:', error));
        },

        // Gestion du clic sur un événement pour afficher les détails
        eventClick: function(info) {
            const eventId = info.event.id;

            // Requête pour récupérer les détails de l'événement sélectionné
            fetch(`http://localhost/SAE301Local/api/get_event.php?id=${eventId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const event = data.events[0]; // Récupérer le premier événement (car id unique)
                        
                        // Mettre à jour la section content-section avec les détails
                        document.querySelector('.event-title').textContent = event.titre;
                        document.querySelector('.description').textContent = event.description;
                        document.querySelector('.event-date').textContent = `Date : ${event.date_event}`;
                        document.querySelector('.event-location').textContent = `Lieu : ${event.lieu}`;
                        document.querySelector('.event-type').textContent = `Type : ${event.type}`;
                        
                        // Afficher le bouton d'inscription
                        document.getElementById('btn-inscription').style.display = 'block';
                    } else {
                        console.error('Erreur lors de la récupération des détails de l\'événement:', data.message);
                    }
                })
                .catch(error => console.error('Erreur lors de la récupération des détails de l\'événement:', error));
        },
    });

    // Rendre le calendrier visible
    calendar.render();
});
