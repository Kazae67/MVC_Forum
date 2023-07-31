window.onload = function() {
    // Sélectionnez tous les liens de suppression de catégorie avec la classe 'confirm'
    var deleteLinks = document.querySelectorAll('.confirm');

    // Parcourez tous les liens de suppression de catégorie
    for (var i = 0; i < deleteLinks.length; i++) {
        // Ajoutez un gestionnaire d'événements 'onclick' à chaque lien de suppression de catégorie
        deleteLinks[i].onclick = function() {
            // Affichez une boîte de dialogue de confirmation lorsque l'utilisateur clique sur le lien de suppression de catégorie
            // Si l'utilisateur clique sur 'OK', le lien sera suivi
            // Si l'utilisateur clique sur 'Annuler', le lien ne sera pas suivi
            return confirm('Are you sure you want to ' + this.dataset.action + ' this category?');
        }
    }
}
