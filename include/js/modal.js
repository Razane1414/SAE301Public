var modal = document.getElementById('confirmation-modal');
var closeModal = document.getElementById('close-modal');
var confirmDeleteBtn = document.getElementById('confirm-delete');
var cancelDeleteBtn = document.getElementById('cancel-delete');

var eventIdToDelete = null;

function showModal(eventId) {
    eventIdToDelete = eventId;  // Sauvegarder l'ID de l'événement
    modal.style.display = "block";  // Afficher la modale
}

closeModal.onclick = function() {
    modal.style.display = "none";  // Masquer la modale
}

cancelDeleteBtn.onclick = function() {
    modal.style.display = "none";  // Masquer la modale
}

confirmDeleteBtn.onclick = function() {
    // Envoyer une requête DELETE à l'API
    fetch(`http://localhost/SAE301Local/api/api_events.php?id=${eventIdToDelete}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);  // Afficher la réponse de l'API
        if (data.success) {
            window.location.reload();  // Recharger la page après suppression
        }
    })
    .catch(error => {
        alert('Une erreur est survenue');
        console.error(error);
    });

    modal.style.display = "none";  // Masquer la modale après suppression
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
