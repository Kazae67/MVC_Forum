<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;

class TopicController extends AbstractController implements ControllerInterface
{
    public function index()
    {
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
            "data" => [
                "categories" => $categoryManager->findAll(["categoryLabel", "DESC"])
            ]
        ];
    }

    public function listTopicsByCategory($id)
    {
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);

        if (!$category) {
            $this->redirectTo('category', 'index');
        }

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findTopicsByCategory($id),
                "category" => $category,
            ]
        ];
    }

}