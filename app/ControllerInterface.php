<!-- 
Une interface est une sorte de contrat que les classes peuvent choisir d'implémenter. 
Lorsqu'une classe implémente une interface, elle doit définir toutes les méthodes que l'interface déclare.

Dans le cas présent, l'interface ControllerInterface déclare une seule méthode : index(). 
Cela signifie que toute classe qui implémente ControllerInterface doit définir une méthode index.

L'utilisation des interfaces offre plusieurs avantages :
Polymorphisme : Vous pouvez écrire du code qui fonctionne avec n'importe quelle classe qui implémente une interface spécifique, 
sans vous soucier des détails spécifiques de cette classe. 
Cela permet de rendre votre code plus flexible et extensible.

Cohérence : En forçant certaines classes à implémenter certaines méthodes, 
vous pouvez garantir que ces classes suivent un certain "modèle". 
C'est utile lorsque vous travaillez en équipe ou lorsque vous voulez vous assurer que certaines parties de votre code restent cohérentes.
-->
<?php

    namespace App;

    interface ControllerInterface{

        public function index();
    }