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

    public function index() {
        $posts = $this->postManager->findAll(["post_creation_date", "ASC"]);
        return $this->render("forum/listPosts.php", ["posts" => $posts]);
    }

    // Méthode générique pour afficher une vue avec ses données
    private function render($view, $data) {
        return [
            "view" => VIEW_DIR . $view,
            "data" => $data
        ];
    }
}
