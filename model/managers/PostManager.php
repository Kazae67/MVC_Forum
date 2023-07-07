<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;
use App\AbstractController;
use Model\Managers\TopicManager;
use Controller\ForumController;

class PostManager extends Manager
{

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";


    public function __construct()
    {
        parent::connect();
    }

    public function findPostByTopic($id)
    {

        parent::connect();

        $sql = "SELECT *
                FROM " . $this->tableName . " a
                WHERE a.topic_id = :id
                ";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id], true),
            $this->className
        );
    }

    public function deletePostsByTopic($id)
    {
        $sql = "DELETE FROM " . $this->tableName . " 
                WHERE topic_id = :id
                ";

        DAO::delete($sql, ['id' => $id]);
    }

    public function findPostsByUser($id)
    {
        parent::connect();

        $order = ["post_creation_date", "DESC"];

        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";

        $sql = "SELECT *
                FROM " . $this->tableName . " a
                WHERE a.user_id = :id
                " . $orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }
    public function find5lastPostsByUser($id)
    {
        parent::connect();

        $order = ["post_creation_date", "DESC"];
        
        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";

        $sql = "SELECT *
                FROM " . $this->tableName . " a
                WHERE a.user_id = :id
                " . $orderQuery. " limit 5";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function updatePostById($id, $text)
    {
        parent::connect();

        $sql = "UPDATE post 
                SET text = :textPost  
                WHERE id_post = :id 
                ";
        return DAO::update($sql, [':textPost' => $text, ':id' => $id]);
    }
}
