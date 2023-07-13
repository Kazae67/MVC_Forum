<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager
{
    // Classe gérée et table correspondante
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct()
    {
        parent::connect(); 
    }

    public function findTopicsByCategory($categoryId)
    {
        parent::connect();

        // Sélection des sujets basés sur l'ID de catégorie, triés par date du dernier message
        $sql = "SELECT t.*, DATE_FORMAT(topic_creation_date, '%d/%m/%Y %H:%i') AS formattedTopicDate,
                DATE_FORMAT((SELECT MAX(post_creation_date) FROM post WHERE topic_id = t.id_topic), '%d/%m/%Y %H:%i') AS lastPostDate,
                (SELECT COUNT(*) FROM post WHERE topic_id = t.id_topic) AS countPost 
                FROM topic t 
                WHERE t.category_id = :id
                ORDER BY lastPostDate DESC
                ";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $categoryId], true), 
            $this->className 
        );
    }
}
