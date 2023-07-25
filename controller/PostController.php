<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\PostManager;
use Model\Managers\TopicManager;

class PostController extends AbstractController implements ControllerInterface {
 
    // Méthode pour lister tous les posts
    public function index()
    {
        // Récupère tous les posts triés par date de création
        $postManager = new PostManager();
        $posts = $postManager->findAll(["post_creation_date", "ASC"]);
        return $this->render("forum/listPosts.php", ["posts" => $posts]);
    }

    // Méthode pour lister tous les posts par sujet
    public function listPostByTopic($topicId)
    {
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        // Récupère les posts associés à un sujet donné
        $posts = $postManager->findPostByTopic($topicId);
        // Récupère les informations du sujet
        $topic = $topicManager->findOneById($topicId);
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

        $data = [];
        // Si la requête est de type POST, nous devons créer un nouveau post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Stocker débogage
            $_SESSION['debug']['post'] = $_POST;

            // Vérifier si l'ID de l'utilisateur est défini dans $_SESSION['user']
            if ($_SESSION['user']->getId()) {
                // Récupérer l'ID de l'utilisateur
                $userId = $_SESSION['user']->getId();

                // Récupérer les données du formulaire
                $data = [
                    'text' => $_POST['text'],
                    'user_id' => $userId,
                    'topic_id' => $id,
                    'post_creation_date' => date("Y-m-d H:i:s")
                ];

                $postManager = new PostManager();
                // var_dump($postManager);die;
                // Appeler la méthode du gestionnaire pour créer le post
                $result = $postManager->add($data);
                var_dump($data);die;

                // Débogage result
                // $_SESSION['debug']['result'] = $result;

                // Checker si la création du post est passée
                if ($result == null) {
                    Session::addFlash('error', 'There was an error creating your new post.');
                } else {
                    Session::addFlash('success', 'Your new post has been successfully created.');
                }

                // Rediriger vers la liste des posts de ce topic
                $this->redirectTo('post', 'listPostByTopic', $id);
            } else {
                // Si l'ID de l'utilisateur n'est pas défini, afficher un message d'erreur
                Session::addFlash('error', 'User ID not found.');
                $this->redirectTo('post', 'listPostByTopic', $id);
            }
        }

        // Si la requête n'est pas de type POST, nous affichons simplement le formulaire
        return [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "data" => [
                "topic" => $topic
            ]
        ];
    }


    // Méthode pour renvoyer la vue de modification d'un post
    public function returnModifyPost($id)
    {
        // Vérifie les autorisations avant de renvoyer la vue de modification du post
        if ($_SESSION["user"]->getRole() == 'admin' || $_SESSION["user"]->getRole() == 'moderator') {
            return [
                "view" => VIEW_DIR . "forum/modifyPost.php",
                "data" => [
                    "post" => (new PostManager())->findOneById($id)
                ]
            ];
        }
    }
}
