<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class TopicController extends AbstractController implements ControllerInterface
{
    private $categoryManager;
    private $topicManager;

    // Injecter CategoryManager et TopicManager via le constructeur pour la réutilisation
    public function __construct()
    {
        $this->categoryManager = new CategoryManager();
        $this->topicManager = new TopicManager();
    }

    // La méthode index pour lister toutes les catégories
    public function index()
    {
        $categories = $this->categoryManager->findAll(["categoryLabel", "DESC"]);

        // Les données sont extraites et renvoyées sous forme d'un tableau associatif avec les clés 'view' et 'data'.
        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
            "data" => compact('categories') // Utilisation de compact() ici
        ];
    }

    // Méthode pour lister les sujets par catégorie
    public function listTopicsByCategory($id)
    {
        // Recherche de la catégorie par son ID
        $category = $this->categoryManager->findOneById($id);

        // Si la catégorie n'existe pas, on redirige vers l'index des catégories
        if (!$category) {
            $this->redirectTo('category', 'index');
        }

        $topics = $this->topicManager->findTopicsByCategory($id);

        // Les données sont extraites et renvoyées sous forme d'un tableau associatif avec les clés 'view' et 'data'.
        // Les données incluent les sujets trouvés par la catégorie et la catégorie elle-même.
        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => compact('topics', 'category') // Utilisation de compact() ici
        ];
    }

    public function NewTopic($id)
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            Session::addFlash('error', 'you need to loggin for creat a new topic.');
            $this->redirectTo('topic', 'listTopicsByCategory', $id);
        }

        // Si la requête est de type POST, nous devons créer un nouveau topic
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $title = $_POST['title'];
            $text = $_POST['text'];
            $userId = $_SESSION['user']->getId();

            // Appeler la méthode du gestionnaire pour créer le sujet
            $this->topicManager->createTopic($title, $text, $userId, $id);

            // Rediriger vers la liste des sujets de cette catégorie
            $this->redirectTo('topic', 'listTopicsByCategory', $id);
        }

        // Si la requête n'est pas de type POST, nous affichons simplement le formulaire
        else {
            $categoryManager = new CategoryManager();
            $category = $categoryManager->findOneById($id);

            return [
                "view" => VIEW_DIR . "forum/newTopic.php",
                "data" => [
                    "category" => $category
                ]
            ];
        }
    }

}
