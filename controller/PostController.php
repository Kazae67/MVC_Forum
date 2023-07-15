<?php
namespace Controller;

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


}
