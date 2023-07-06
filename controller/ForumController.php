<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        /* (1) Crée une nouvelle instance de la classe "TopicManager" en utilisant l'instruction "new". 
               Il est supposé que la classe "TopicManager" est une classe définie dans l'espace de noms "Model\Managers".
           (2) le code retourne un tableau avec deux clés : "view" et "data". 
               La clé "view" contient le chemin complet du fichier de vue qui sera utilisé pour afficher la liste des sujets. 
               La constante "VIEW_DIR" est utilisée pour représenter le répertoire des vues.
           (3) La clé "data" contient un tableau associatif avec une clé "topics" 
               et une valeur qui est le résultat de l'appel à la méthode "findAll" de l'objet "$topicManager". 
           (4) La méthode "findAll" est supposée renvoyer un tableau contenant tous les sujets. 
               Les sujets sont triés par ordre décroissant de leur date de création, 
               par l'argument ["creationdate", "DESC"] est passé à la méthode "findAll"
        */
        public function index(){
          

           $topicManager = new TopicManager(); // (1)

            return [
                "view" => VIEW_DIR."forum/listTopics.php", // (2)
                "data" => [ // (3)
                    "topics" => $topicManager->findAll(["creation_date", "DESC"]) // (4)
                ]
            ];
        
        }

        // Autres function de redirection

    }
