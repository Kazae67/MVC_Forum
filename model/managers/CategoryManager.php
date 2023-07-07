<?php
/* 
Il y a 1 manager par "entities", ce n'est pas comme le controller qui regroupe des actions.
Les managers sont aussi des classes.
C'est la que je vais mettre mes requêtes SQL au serveur,
qui seront appelés par la suite par le CONTROLLER.
*/
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Controller\ForumController;

class CategoryManager extends Manager
{
    protected $className = "Model\Entities\Category";
    protected $tableName = "category";


    public function __construct()
    {
        parent::connect();
    }

    public function findOneById($id)
    {
        parent::connect();

        $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.id_".$this->tableName." = :id
                    ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false),
            $this->className
        );
    }
}
    //     public function createNewCategory(){
    //         if($_SESSION["user"]->getRole() == "admin"){
                
    //             //to be contineud
    //     }
    // }
    ?>