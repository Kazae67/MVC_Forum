<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;

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

}
