<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\Manager;

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

    public function newTopic($id)
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            Session::addFlash('error', 'You need to log in to create a new topic.');
            $this->redirectTo('topic', 'listTopicsByCategory', $id);
        }
    
        $data = [];
        // Initialiser le résultat
        $result = null;

        // Si la requête est de type POST, nous devons créer un nouveau topic
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Stocker débogage
            $_SESSION['debug']['post'] = $_POST;
    
            // Vérifier si l'ID de l'utilisateur est défini dans $_SESSION['user']
            if ($_SESSION['user']->getId()) {
                // Récupérer l'ID de l'utilisateur
                $userId = $_SESSION['user']->getId();
    
                // Récupérer les données du formulaire
                $data = [
                    'title' => $_POST['title'],
                    'topic_description' => $_POST['topic_description'],
                    'user_id' => $userId,
                    'category_id' => $id
                ];
    
                // Appeler la méthode du gestionnaire pour créer le sujet
                $result = $this->topicManager->add($data);
    
                // Débogage result
                $_SESSION['debug']['result'] = $result;
    
                // Checker si la création du topic est passée
                if ($result == null) {
                    Session::addFlash('error', 'There was an error creating your new topic.');
                } else {
                    Session::addFlash('success', 'Your new topic has been successfully created.');
                }
    
                // Rediriger vers la liste des sujets de cette catégorie
                $this->redirectTo('topic', 'listTopicsByCategory', $id);
            } else {
                // Si l'ID de l'utilisateur n'est pas défini, afficher un message d'erreur
                Session::addFlash('error', 'User ID not found.');
                $this->redirectTo('topic', 'listTopicsByCategory', $id);
            }
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

    // Méthode pour lock un topic
    public function lockTopicFromTopic($id)
    {

        // Vérifier si l'utilisateur est connecté et est un administrateur
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'admin') {
            Session::addFlash('error', 'You must be an administrator to lock a topic.');
            $this->redirectTo('topic', 'listTopics');
        }

        // Récupérer le topic par son ID
        $topic = $this->topicManager->findOneById($id);

        // Si le topic n'existe pas, rediriger vers la liste des topics
        if (!$topic) {
            $this->redirectTo('topic', 'listTopics');
        }

        // Verrouiller le topic
        $result = $this->topicManager->lockTopicById($id);

        if (!$result) {
            Session::addFlash('error', 'There was an error locking the subject.');
        } else {
            Session::addFlash('success', 'The subject has been successfully locked.');
        }

        $this->redirectTo('topic', 'listAllTopics');
    }
        







    

        // prototype
        public function listAllTopics()
        {
            $topics = $this->topicManager->findAll(["id", "DESC"]);
        
            return [
                "view" => VIEW_DIR . "forum/listTopics.php",
                "data" => compact('topics')
            ];
        }
        
}
