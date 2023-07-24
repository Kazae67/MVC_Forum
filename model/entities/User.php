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

    public function getId(): int
    {
        return $this->id;
    }

    public function setId_user(int $id): self
    {
        $this->id = $id;
    
        return $this;
    }

    public function getNickName(): string
    {
        return $this->nickName;
    }

    public function setNickName(string $nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getUser_registration_date()
    {
        return $this->user_registration_date;
    }

    public function setUser_registration_date($user_registration_date)
    {
        $this->user_registration_date = $user_registration_date;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

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
     * @return bool Vrai si l'utilisateur a le rôle, sinon, faux
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function getBan()
    {
        return $this->ban;
    }

    public function setBan($ban)
    {
        $this->ban = $ban;

        return $this;
    }
}

?>
