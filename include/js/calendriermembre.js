document.addEventListener('DOMContentLoaded', function () {
    let selectedEventId = null;

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: function(info, successCallback, failureCallback) {
            fetch('http://localhost:8888/SAE301Local/api/get_event.php')
                .then(response => response.json())
                .then(data => {
                    const events = data.events.map(event => ({
                        id: event.id,
                        title: event.titre,
                        start: event.date_event,
                        description: event.description,
                    }));
                    successCallback(events);
                })
                .catch(error => console.error('Erreur lors de la récupération des événements:', error));
        },
        eventClick: function(info) {
            const eventId = info.event.id;
            selectedEventId = eventId;

            fetch(`http://localhost:8888/SAE301Local/api/get_event.php?id=${eventId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const event = data.events[0];
                        document.querySelector('.event-title').textContent = event.titre;
                        document.querySelector('.description').textContent = event.description;
                        document.querySelector('.event-date').textContent = `Date : ${event.date_event}`;
                        document.querySelector('.event-location').textContent = `Lieu : ${event.lieu}`;
                        document.querySelector('.event-type').textContent = `Type : ${event.type}`;
                        document.getElementById('btn-inscription').style.display = 'block';
                    }
                });
        },
    });

    calendar.render();

    // Gestion du clic sur le bouton d'inscription
    document.getElementById('btn-inscription').addEventListener('click', function () {
    
        fetch('http://localhost/SAE301Local/api/inscription_event.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `event_id=${selectedEventId}`,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Inscription réussie.');
                    document.getElementById('btn-inscription').style.display = 'none';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Erreur lors de l\'inscription:', error));
    });
    
});
