function scrollAndFocus() {
    // Fait défiler jusqu'au formulaire de réponse
    const formElement = document.getElementById('answer-form');
    formElement.scrollIntoView({ behavior: 'smooth' });

    // Attends un court instant avant de sélectionner le textarea pour laisser le temps au défilement de s'effectuer
    setTimeout(function() {
        const textareaElement = document.getElementById('text');
        textareaElement.focus();
    }, 200); // ajuster le délai
}
