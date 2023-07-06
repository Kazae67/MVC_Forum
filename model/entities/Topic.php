<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $title;
        private $user;
        private $creation_date;
        private $is_locked;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }

        public function getcreation_date(){
            $formattedDate = $this->creation_date->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setcreation_date($date){
            $this->creation_date = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of is_locked
         */ 
        public function getis_locked()
        {
                return $this->is_locked;
        }

        /**
         * Set the value of is_locked
         *
         * @return  self
         */ 
        public function setis_locked($is_locked)
        {
                $this->is_locked = $is_locked;

                return $this;
        }
    }
