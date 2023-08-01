// Sélectionne tous les liens d'action avec la classe 'confirm'
var actionLinks = document.querySelectorAll('.confirm');

// Parcours tous les liens d'action
for (var i = 0; i < actionLinks.length; i++) {
    // Ajoute un gestionnaire d'événements 'onclick' à chaque lien d'action
    actionLinks[i].onclick = function() {
        // Affiche une boîte de dialogue de confirmation lorsque l'utilisateur clique sur le lien d'action
        // Si l'utilisateur clique sur 'OK', le lien sera suivi
        // Si l'utilisateur clique sur 'Annuler', le lien ne sera pas suivi
        return confirm('Are you sure you want to ' + this.dataset.action + ' this topic ?');
    }
}
