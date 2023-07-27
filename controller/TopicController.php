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

    // Méthode pour lister les topics par catégorie
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
        // Les données incluent les topics trouvés par la catégorie et la catégorie elle-même.
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

        // Initialiser le résultat
        $result = null;

        // Si la requête est de type POST, nous devons créer un nouveau topic
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Valider et filtrer les données du formulaire
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $topicDescription = filter_input(INPUT_POST, 'topic_description', FILTER_SANITIZE_STRING);
            $userId = $_SESSION['user']->getId();
            $categoryId = (int) $id;

            // Vérifier si les données sont valides
            if (empty($title) || empty($topicDescription)) {
                Session::addFlash('error', 'Please fill in all the required fields.');
                $this->redirectTo('topic', 'newTopic', $id);
            }

            // Utiliser des requêtes préparées pour éviter les attaques par injection SQL
            $data = [
                'title' => $title,
                'topic_description' => $topicDescription,
                'user_id' => $userId,
                'category_id' => $categoryId
            ];

            // Appeler la méthode du gestionnaire pour créer le topic en utilisant une requête préparée
            $result = $this->topicManager->add($data);

            // Vérifier si la création du topic s'est bien déroulée
            if (!$result) {
                Session::addFlash('error', 'There was an error creating your new topic.');
            } else {
                Session::addFlash('success', 'Your new topic has been successfully created.');
            }

            // Rediriger vers la liste des topics de cette catégorie
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

    // Méthode pour verrouiller un topic
    public function lockTopicFromTopic($id)
    {
        // Vérifie si l'utilisateur est connecté et s'il est administrateur ou l'auteur du topic
        if (!isset($_SESSION['user']) || ($_SESSION['user']->getRole() !== 'admin' && $_SESSION['user']->getId() !== $this->topicManager->getTopicAuthorId($id))) {
            Session::addFlash('error', 'You must be an administrator or the author of the topic to lock it.');
            $this->redirectTo('topic', 'listTopicsByCategory', $id);
        }
    
        // Verrouille le topic
        $result = $this->topicManager->lockTopicById($id);
    
        // Si le topic est verrouillé avec succès, affiche un message de succès, sinon affiche un message d'erreur
        if($result) {
            Session::addFlash('success', 'The subject has been successfully locked.');
        } else {
            Session::addFlash('error', 'An error occurred while locking the subject.');
        }
    
        // Redirige vers la liste des topics de cette catégorie
        $this->redirectTo('topic', 'listTopicsByCategory', $id);
    }

    // Méthode pour déverrouiller un topic
    public function unlockTopicFromTopic($id)
    {
        // Vérifie si l'utilisateur est connecté et s'il est administrateur ou l'auteur du topic
        if (!isset($_SESSION['user']) || ($_SESSION['user']->getRole() !== 'admin' && $_SESSION['user']->getId() !== $this->topicManager->getTopicAuthorId($id))) {
            Session::addFlash('error', 'You must be an administrator or the author of the topic to unlock it.');
            $this->redirectTo('topic', 'listTopicsByCategory', $id);
        }
    
        // Déverrouille le topic
        $result = $this->topicManager->unlockTopicById($id);
    
        // Si le topic est déverrouillé avec succès, affiche un message de succès, sinon affiche un message d'erreur
        if ($result) {
            Session::addFlash('success', 'The subject has been successfully unlocked.');
        } else {
            Session::addFlash('error', 'An error occurred when unlocking the subject.');
        }
    
        // Redirige vers la liste des topics de cette catégorie
        $this->redirectTo('topic', 'listTopicsByCategory', $id);
    }

    public function deleteTopic($id)
    {
        if (!isset($_SESSION['user']) || ($_SESSION['user']->getRole() !== 'admin' && $_SESSION['user']->getId() !== $this->topicManager->getTopicAuthorId($id))) {
            Session::addFlash('error', 'You must be an administrator or the author of the topic to delete it.');
            $this->redirectTo('topic', 'listTopicsByCategory', $id);
        }

        $result = $this->topicManager->deleteTopicById($id);

        if (!$result) {
            Session::addFlash('error', 'There was an error deleting the topic.');
        } else {
            Session::addFlash('success', 'The topic has been successfully deleted.');
        }

        $this->redirectTo('topic', 'listTopicsByCategory', $id);
    }
    
    // Prototype, supprimer si perte de temps
    public function listAllTopics()
    {
        $topics = $this->topicManager->findAll(["id", "DESC"]);

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => compact('topics')
        ];
    }
}
