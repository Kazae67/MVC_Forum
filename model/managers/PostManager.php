<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

/*
La classe PostManager est dédiée à la gestion des posts. Elle hérite de la classe Manager qui permet une connexion à la base de données.
*/
class PostManager extends Manager
{
    // Nom de la classe correspondante et de la table dans la base de données
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    // Méthode constructeur qui se connecte à la base de données
    public function __construct()
    {
        parent::connect();
    }

    // Méthode pour trouver tous les posts associés à un topic spécifique
    public function findPostByTopic($topicId)
    {
        // Requête SQL pour obtenir tous les posts associés à un topic spécifique
        $sql = "SELECT *
                FROM " . $this->tableName . "
                WHERE topic_id = :topicId";

        // Exécute la requête et renvoie le résultat sous forme de multiples instances de la classe Post, ou un tableau vide si aucun post n'a été trouvé
        return $this->getMultipleResults(
            DAO::select($sql, ['topicId' => $topicId], true),
            $this->className
        );
    }
}
