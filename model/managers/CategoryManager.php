<?php
/*
Un Manager est dédié à chaque "entité", contrairement au Controller qui regroupe des actions.
Les Managers sont également des classes.
C'est ici que nous écrivons nos requêtes SQL,
qui seront appelées par la suite par le CONTROLLER.
*/
namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategoryManager extends Manager
{
    protected $className = "Model\Entities\Category";
    protected $tableName = "category";

    // La méthode constructeur
    public function __construct()
    {
        parent::connect();
    }

    // Méthode pour trouver une catégorie par son ID
    public function findOneById($id)
    {
        
        // Requête SQL pour obtenir une catégorie par son ID
        $sql = "SELECT *
                    FROM ".$this->tableName."
                    WHERE id_".$this->tableName." = :id
                    ";

        // Exécute la requête et renvoie un seul résultat ou null si aucune catégorie n'a été trouvée
        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false),
            $this->className
        );
    }

    // La méthode delete
    public function delete($id)
    {
        $sql = "DELETE FROM ".$this->tableName."
                WHERE id_".$this->tableName." = :id
                ";

        return DAO::delete($sql, ['id' => $id]);
    }

    // Méthode pour update l'edit
    public function update($id, $categoryLabel) {
        $sql = "UPDATE ".$this->tableName."
                SET categoryLabel = :categoryLabel
                WHERE id_".$this->tableName." = :id
                ";
    
        return DAO::update($sql, ['id' => $id, 'categoryLabel' => $categoryLabel]);
    }
}

?>
