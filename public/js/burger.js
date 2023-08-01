// Sélectionner l'élément HTML avec la classe "burger" et le stocker dans une variable "burger"
const burger = document.querySelector('.burger');

// Sélectionner l'élément HTML "nav" et le stocker dans une variable "nav"
const nav = document.querySelector('nav');

// Ajouter un listener d'événements de clic sur l'élément "burger"
burger.addEventListener('click', () => {
  // Lorsque l'élément "burger" est cliqué, ajoute ou supprime la classe "show" de l'élément "nav"
  // La classe "show" est utilisée pour afficher ou masquer le menu de navigation sur les appareils mobiles
  // Lorsque la classe "show" est présente, le menu est affiché, sinon il est masqué
  nav.classList.toggle('show');
});
