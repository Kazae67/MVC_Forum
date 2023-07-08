<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

/*
La classe TopicManager est utilisée pour la gestion des sujets (topics). Elle hérite de la classe Manager qui fournit la connexion à la base de données.
*/
class TopicManager extends Manager
{
    // Nom de la classe correspondante et de la table dans la base de données
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    // Méthode constructeur qui établit la connexion à la base de données
    public function __construct()
    {
        parent::connect();
    }

    // Méthode pour obtenir tous les sujets (topics) associés à une catégorie spécifique
    public function findTopicsByCategory($categoryId)
    {
        // Requête SQL pour obtenir tous les sujets associés à une catégorie spécifique, triés par la date de création
        $sql = "SELECT *
                FROM " . $this->tableName . "
                WHERE category_id = :categoryId
                ORDER BY creation_date DESC";

        // Exécute la requête et renvoie le résultat sous forme de multiples instances de la classe Topic, ou un tableau vide si aucun sujet n'a été trouvé
        return $this->getMultipleResults(
            DAO::select($sql, ['categoryId' => $categoryId], false),
            $this->className
        );
    }
}
