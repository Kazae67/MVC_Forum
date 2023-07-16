<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

/*
La classe UserManager est utilisée pour gérer les utilisateurs. Elle hérite de la classe Manager qui fournit la connexion à la base de données.
*/
class UserManager extends Manager
{
    // Nom de la classe correspondante et de la table dans la base de données
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    // Méthode constructeur qui établit la connexion à la base de données
    public function __construct()
    {
        parent::connect();
    }

    // Méthode pour trouver un utilisateur par son email
    public function findOneByEmail($email)
    {
        // Requête SQL pour obtenir l'utilisateur avec l'email spécifié
        $sql = "SELECT *
                FROM " . $this->tableName . "
                WHERE email = :email";

        // Exécute la requête et renvoie le résultat sous forme d'une instance de la classe User, ou null si aucun utilisateur n'a été trouvé
        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );
    }

    // Méthode pour trouver un utilisateur par son pseudo
    public function findOneByNickname($nickname)
    {
        // Requête SQL pour obtenir l'utilisateur avec le pseudo spécifié
        $sql = "SELECT *
                FROM " . $this->tableName . "
                WHERE nickname = :nickname";

        // Exécute la requête et renvoie le résultat sous forme d'une instance de la classe User, ou null si aucun utilisateur n'a été trouvé
        return $this->getOneOrNullResult(
            DAO::select($sql, ['nickname' => $nickname], false),
            $this->className
        );
    }

    public function banUserById($id)
    {
        $sql =  "UPDATE " . $this->tableName .
            " SET ban = 1 
             WHERE id_user = :id";

        return DAO::update($sql, ['id' => $id]);
    }
    
}
