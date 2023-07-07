<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Controller\ForumController;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }
        public function findOneByEmail($email){

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.email = :email;
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false), 
                $this->className
            );
        }
        public function findOneByNickname($nickName){

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.nickName = :nickName;
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['nickName' => $nickName], false), 
                $this->className
            );
        }
        
        public function banUserById($id){
            parent::connect();

        $sql =  "UPDATE " . $this->tableName .
            " SET ban = 1 
             WHERE id_user = :id";


        return DAO::update($sql, ['id' => $id]);
        }
        
        public function unbanUserById($id){
            parent::connect();

        $sql =  "UPDATE " . $this->tableName .
            " SET ban = 0 
             WHERE id_user = :id";


        return DAO::update($sql, ['id' => $id]);
        }

        public function modifyPasswordByUser($id, $newPassword){
            parent::connect();

        $sql = "UPDATE " . $this->tableName . 
            " SET password = :newPassword 
            WHERE id_user = :id";

            return DAO::update($sql, ['id' => $id, 'newPassword' => $newPassword]);

        }
    }
    ?>