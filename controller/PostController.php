<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\PostManager;
use Model\Managers\TopicManager;

class PostController extends AbstractController implements ControllerInterface {
    private $postManager;
    private $topicManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->topicManager = new TopicManager();
    }


    // Méthode pour lister tous les posts

    public function index() {
        // Récupère tous les posts triés par date de création
        $posts = $this->postManager->findAll(["post_creation_date", "ASC"]);
        return $this->render("forum/listPosts.php", ["posts" => $posts]);
    }


    // Méthode pour lister tous les posts par sujet
    public function listPostByTopic($topicId) {
        // Récupère les posts associés à un sujet donné
        $posts = $this->postManager->findPostByTopic($topicId);
        // Récupère les informations du sujet
        $topic = $this->topicManager->findOneById($topicId);
        return $this->render("forum/listPosts.php", ["posts" => $posts, "topic" => $topic]);
    }


    // Méthode générique pour afficher une vue avec des données
    private function render($view, $data) {
        return [
            "view" => VIEW_DIR . $view,
            "data" => $data
        ];
    }

    // Méthode pour ajouter un post à un sujet donné
    public function addPostByTopic($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text']) && !empty($_POST['text'])) {
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user = $_SESSION["user"]->getId();

            // Ajoute un nouveau post avec les informations fournies
            (new PostManager())->add(["topic_id" => $id, "user_id" => $user, "text" => $text]);
            Session::addFlash('success', 'Message successfully added');
        } else {
            Session::addFlash('error', "Failed to add message");
        }

        $this->redirectTo('post', 'listPostByTopic', $id);
    }


    // Méthode pour supprimer un post
    public function deletePost($id) {
        $postManager = new PostManager();
        $post = $postManager->findOneById($id);
        $topicId = $post->getTopic()->getId();

        // Vérifie les autorisations avant de supprimer le post
        if ($_SESSION["user"]->getRole() == 'admin' || $_SESSION["user"]->getRole() == 'moderator') {
            $postManager->delete($id);
            Session::addFlash('success', "Message successfully deleted");
        }

        $this->redirectTo('post', 'listPostByTopic', $topicId);
    }

    // Méthode pour modifier un post
    public function modifyPost($id) {
    $postManager = new PostManager();
    $post = $postManager->findOneById($id);
    $topicId = $post->getTopic()->getId();


        // Vérifie les autorisations avant de modifier le post
    if ($_SESSION["user"]->getRole() == 'admin' || $_SESSION["user"]->getRole() == 'moderator') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text']) && !empty($_POST['text'])) {
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // Met à jour le texte du post
            $postManager->updatePostById($id, $text);
            Session::addFlash('success', 'Message successfully modified');
        } else {
            Session::addFlash('error', 'Message modification failed');
        }

        $this->redirectTo('post', 'listPostByTopic', $topicId);
    }
}


    // Méthode pour renvoyer la vue de modification d'un post
    public function returnModifyPost($id) {
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
