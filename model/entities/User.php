<?php

namespace Model\Entities;

use App\Entity;

final class User extends Entity
{
    private $id;
    private $nickName;
    private $password;
    private $email;
    private $user_registration_date;
    private $role;

    public function __construct($data)
    {
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
     * Get the value of nickName
     */ 
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * Set the value of nickName
     */ 
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of user_registration_date
     */ 
    public function getUser_registration_date()
    {
        return $this->user_registration_date;
    }

    /**
     * Set the value of user_registration_date
     */ 
    public function setUser_registration_date($user_registration_date)
    {
        $this->user_registration_date = $user_registration_date;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}
?>