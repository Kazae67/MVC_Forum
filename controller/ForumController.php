<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;

class ForumController extends AbstractController implements ControllerInterface {

    private $topicManager;

    // Constructeur pour l'injection de dépendance de TopicManager
    public function __construct() {
        // Initialisation de TopicManager
        $this->topicManager = new TopicManager();
    }

    // Méthode pour afficher la liste des sujets du forum
    public function index() {
        // Récupération des sujets depuis la base de données
        $topics = $this->topicManager->findAll(["topic_creation_date", "DESC"]);

        // Retourne la vue à afficher et les données à y injecter
        return [
            // Chemin vers le fichier de vue
            "view" => VIEW_DIR . "forum/listTopics.php",
            // Les données à passer à la vue (dans ce cas, les sujets)
            "data" => compact('topics')
        ];
    }

    
    // Autres fonctions de redirection

}
