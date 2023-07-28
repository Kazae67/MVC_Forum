<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\PostManager;
use Model\Managers\TopicManager;

class PostController extends AbstractController implements ControllerInterface
{
    private $postManager;
    private $topicManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->topicManager = new TopicManager();
    }

    // Méthode pour lister tous les posts
    public function index()
    {
        // Récupère tous les posts triés par date de création
        $posts = $this->postManager->findAll(["post_creation_date", "ASC"]);
        return $this->render("forum/listPosts.php", ["posts" => $posts]);
    }

    // Méthode pour lister tous les posts par sujet
    public function listPostByTopic($topicId)
    {
        // Vérifier si l'ID du sujet est valide
        if (!ctype_digit($topicId)) {
            $this->redirectTo('topic', 'listTopics');
        }

        // Récupère les posts associés à un sujet donné
        $posts = $this->postManager->findPostByTopic($topicId);

        // Récupère les informations du sujet
        $topic = $this->topicManager->findOneById($topicId);

        // Les données sont extraites et renvoyées sous forme d'un tableau associatif avec les clés 'view' et 'data'.
        return $this->render("forum/listPosts.php", ["posts" => $posts, "topic" => $topic]);
    }

    // Méthode générique pour afficher une vue avec des données
    private function render($view, $data)
    {
        return [
            "view" => VIEW_DIR . $view,
            "data" => $data
        ];
    }

    // Méthode pour ajouter un post à un sujet donné
    public function addPostByTopic($id)
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            Session::addFlash('error', 'You need to log in to add a new post.');
            $this->redirectTo('post', 'listPostByTopic', $id);
        }

        // Si la requête est de type POST, nous devons créer un nouveau post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Valider et filtrer les données du formulaire
            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
            $userId = $_SESSION['user']->getId();
            $topicId = (int) $id;

            // Vérifier si les données sont valides
            if (empty($text)) {
                Session::addFlash('error', 'Please enter a valid text.');
                $this->redirectTo('post', 'addPostByTopic', $id);
            }

            // Utiliser des requêtes préparées pour éviter les attaques par injection SQL
            $data = [
                'text' => $text,
                'user_id' => $userId,
                'topic_id' => $topicId,
                'post_creation_date' => date("Y-m-d H:i:s")
            ];

            // Appeler la méthode du gestionnaire pour créer le post en utilisant une requête préparée
            $result = $this->postManager->add($data);

            // Vérifier si la création du post s'est bien déroulée
            if (!$result) {
                Session::addFlash('error', 'There was an error creating your new post.');
            } else {
                Session::addFlash('success', 'Your new post has been successfully created.');
            }

            // Rediriger vers la liste des posts de ce topic
            $this->redirectTo('post', 'listPostByTopic', $id);
        }

        // Si la requête n'est pas de type POST, nous affichons simplement le formulaire
        $topic = $this->topicManager->findOneById($id);

        // Les données sont extraites et renvoyées sous forme d'un tableau associatif avec les clés 'view' et 'data'.
        return $this->render("forum/listPosts.php", ["topic" => $topic]);
        
    }
}
