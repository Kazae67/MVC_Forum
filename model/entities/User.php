<?php

namespace Model\Entities;

use App\Entity;

final class User extends Entity
{
    private int $id;
    private string $nickName;
    private string $password;
    private string $email;
    private $user_registration_date;
    private string $role;
    private $ban;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Récupérer la valeur de id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Définir la valeur de id
     *
     * @return  self
     */ 
    public function setId_user(int $id): self
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Récupérer la valeur de nickName
     */ 
    public function getNickName(): string
    {
        return $this->nickName;
    }

    /**
     * Définir la valeur de nickName
     */ 
    public function setNickName(string $nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * Récupérer la valeur de password
     */ 
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Définir la valeur de password
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Récupérer la valeur de email
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Définir la valeur de email
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Récupérer la valeur de user_registration_date
     */ 
    public function getUser_registration_date()
    {
        return $this->user_registration_date;
    }

    /**
     * Définir la valeur de user_registration_date
     */ 
    public function setUser_registration_date($user_registration_date)
    {
        $this->user_registration_date = $user_registration_date;

        return $this;
    }

    /**
     * Récupérer la valeur de role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Définir la valeur de role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Vérifier si l'utilisateur a le rôle donné
     *
     * @param string $role Le rôle à vérifier
     * 
     * @return bool True si l'utilisateur a le rôle, False sinon
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Récupérer la valeur de ban
     */ 
    public function getBan()
    {
        return $this->ban;
    }

    /**
     * Définir la valeur de ban
     *
     * @return  self
     */ 
    public function setBan($ban)
    {
        $this->ban = $ban;

        return $this;
    }
}

?>
