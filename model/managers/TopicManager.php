<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager
{
    protected $tableName = "topic";
    protected $className = "Model\Entities\Topic";

    public function __construct()
    {
        parent::connect();
    }

    // recherche et récupère tous les topics correspondant à une catégorie spécifiée par l'ID
    public function findTopicsByCategoryId($id)
    {
        $sql = "
            SELECT *
            FROM {$this->tableName} table
            WHERE table.category_id = :category_id
            ORDER BY creation_date DESC
        ";

        // Les résultats de la requête sont ensuite traités à l'aide de la méthode getMultipleResults() de la classe Manager, qui convertit les résultats en instances de la classe $this->className (ici, Model\Entities\Topic).
        return $this->getMultipleResults(
            DAO::select($sql, ['category_id' => $id]),
            $this->className
        );
    }

}
