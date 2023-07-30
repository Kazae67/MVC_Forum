<?php

namespace Model\Entities;

use App\Entity;

final class User extends Entity
{
    // Propriétés de la classe
    private int $id; 
    private string $nickName;
    private string $password;
    private string $email;
    private $user_registration_date;
    private string $role;
    private $ban; // Statut de bannissement de l'utilisateur (0 = non banni, 1 = banni)

    // Constructeur de la classe
    public function __construct($data)
    {
        $this->hydrate($data);
    }

    // Méthode pour hydrater les propriétés de la classe à partir d'un tableau de données
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
     * Méthode pour récupérer l'identifiant de l'utilisateur.
     * 
     * @return int 
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Méthode pour définir l'identifiant de l'utilisateur.
     *
     * @param int $id 
     * @return self
     */ 
    public function setId_user(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Méthode pour récupérer le pseudonyme de l'utilisateur.
     * 
     * @return string 
     */ 
    public function getNickName(): string
    {
        return $this->nickName;
    }

    /**
     * Méthode pour définir le pseudonyme de l'utilisateur.
     *
     * @param string $nickName 
     */ 
    public function setNickName(string $nickName)
    {
        $this->nickName = $nickName;
        return $this;
    }

    /**
     * Méthode pour récupérer le mot de passe de l'utilisateur.
     * 
     * @return string 
     */ 
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Méthode pour définir le mot de passe de l'utilisateur.
     *
     * @param string $password 
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Méthode pour récupérer l'adresse email de l'utilisateur.
     * 
     * @return string 
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Méthode pour définir l'adresse email de l'utilisateur.
     *
     * @param string $email 
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Méthode pour récupérer la date d'enregistrement de l'utilisateur.
     * 
     * @return mixed 
     */ 
    public function getUser_registration_date()
    {
        return $this->user_registration_date;
    }

    /**
     * Méthode pour définir la date d'enregistrement de l'utilisateur.
     *
     * @param mixed $user_registration_date
     */ 
    public function setUser_registration_date($user_registration_date)
    {
        $this->user_registration_date = $user_registration_date;
        return $this;
    }

    /**
     * Méthode pour récupérer le rôle de l'utilisateur.
     * 
     * @return mixed 
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Méthode pour définir le rôle de l'utilisateur.
     *
     * @param mixed $role 
     * @return self
     */ 
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Méthode pour vérifier si l'utilisateur a le rôle donné.
     *
     * @param string $role 
     * @return bool True si l'utilisateur a le rôle, False sinon
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Méthode pour récupérer le statut de bannissement de l'utilisateur.
     * 
     * @return int Le statut de bannissement de l'utilisateur (0 = non banni, 1 = banni)
     */ 
    public function getBan(): int
    {
        return $this->ban;
    }

    /**
     * Méthode pour définir le statut de bannissement de l'utilisateur.
     *
     * @param int $ban Le statut de bannissement de l'utilisateur (0 = non banni, 1 = banni)
     * @return  self
     */ 
    public function setBan(int $ban): self
    {
        $this->ban = $ban;
        return $this;
    }

    /**
     * Méthode pour vérifier si l'utilisateur est un administrateur.
     *
     * @return bool True si l'utilisateur est un administrateur, False sinon
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
?>
