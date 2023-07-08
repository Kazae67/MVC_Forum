<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;
class PostManager extends Manager
{
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";
    
    
    public function __construct()
    {
        parent::connect();

        $sql = "SELECT *
        FROM " . $this->tableName . " a
        WHERE a.topic_id = :id
        ";
    }
}