// Sélectionnez tous les éléments avec la classe 'confirm'
var elements = document.querySelectorAll('.confirm');

// Parcours tous les éléments sélectionnés
for (var i = 0; i < elements.length; i++) {
    // Si l'élément est un lien (<a>), ajoute un gestionnaire d'événements 'onclick'
    if (elements[i].tagName === 'A') {
        elements[i].onclick = function() {
            // Lorsque l'utilisateur clique sur le lien, affiche une boîte de dialogue de confirmation
            // Si l'utilisateur clique sur 'OK', le lien sera suivi
            // Si l'utilisateur clique sur 'Annuler', le lien ne sera pas suivi
            return confirm('Are you sure you want to ' + this.dataset.action + ' this user?');
        }
    }
    // Si l'élément est une liste déroulante (<select>), ajoute un gestionnaire d'événements 'onchange'
    else if (elements[i].tagName === 'SELECT') {
        elements[i].onchange = function() {
            // Lorsque l'utilisateur change la sélection, vérifie si une option autre que 'Select role' a été sélectionnée
            // Si c'est le cas, affiche une boîte de dialogue de confirmation
            if (this.value && confirm('Are you sure you want to ' + this.dataset.action + ' this user?')) {
                // Si l'utilisateur clique sur 'OK', soumet le formulaire en cliquant sur le bouton de soumission caché
                document.getElementById('roleSubmit').click();
            } else {
                // Si l'utilisateur clique sur 'Annuler', réinitialise la sélection à 'Select role'
                this.value = '';
            }
        }
    }
}
