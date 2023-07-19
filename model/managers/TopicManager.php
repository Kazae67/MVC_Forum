<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

// TopicManager hérite de la classe Manager de base pour gérer les opérations spécifiques aux topics
class TopicManager extends Manager
{
    // Définir la classe gérée par ce Manager et la table correspondante dans la base de données
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct()
    {
        // Appel du constructeur de la classe parente pour s'assurer que la connexion à la base de données est établie
        parent::connect(); 
    }

    // Cette méthode récupère tous les sujets associés à une catégorie donnée, triés par la date du dernier post
    public function findTopicsByCategory($categoryId)
    {
        // Définition de la requête SQL
        $sql = "SELECT t.*, DATE_FORMAT(topic_creation_date, '%d/%m/%Y %H:%i') AS formattedTopicDate,
                DATE_FORMAT((SELECT MAX(post_creation_date) FROM post WHERE topic_id = t.id_topic), '%d/%m/%Y %H:%i') AS lastPostDate,
                (SELECT COUNT(*) FROM post WHERE topic_id = t.id_topic) AS countPost 
                FROM topic t 
                WHERE t.category_id = :id
                ORDER BY lastPostDate DESC
                ";

        // Exécution de la requête et retour des résultats
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $categoryId], true), 
            $this->className 
        );
    }

    // Cette méthode verrouille un sujet par son ID, empêchant de nouveaux posts d'être créés
    public function lockTopicById($id)
    {
        // Définition de la requête SQL
        $sql =  "UPDATE " . $this->tableName .
            " SET locked = 1
             WHERE id_topic = :id";

        // Exécution de la requête et retour du résultat
        return DAO::update($sql, ['id' => $id]);
    }

    // Cette méthode déverrouille un sujet par son ID, permettant de nouveaux posts d'être créés
    public function unlockTopicById($id)
    {
        // Définition de la requête SQL
        $sql =  "UPDATE " . $this->tableName .
            " SET locked = 0 
             WHERE id_topic = :id";

        // Exécution de la requête et retour du résultat
        return DAO::update($sql, ['id' => $id]);
    }

    public function createTopic($title, $text, $userId, $categoryId)
    {
        // Définition de la requête SQL
        $sql =  "INSERT INTO " . $this->tableName .
            " (title, text, user_id, category_id)
             VALUES (:title, :text, :user_id, :category_id)";
    
        // Exécution de la requête et retour du résultat
        return DAO::update($sql, ['title' => $title, 'text' => $text, 'user_id' => $userId, 'category_id' => $categoryId]);
    }
}
