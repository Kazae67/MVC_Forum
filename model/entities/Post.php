<?php

namespace Model\Entities;

use App\Entity;
use DateTime;

final class Post extends Entity
{
    // Propriétés de la classe
    private int $id; 
    private string $text; 
    private ?DateTime $post_creation_date = null; 
    private $user;
    private $topic; 

    // Constructeur de la classe
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * Méthode pour récupérer l'identifiant du post.
     * 
     * @return int 
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Méthode pour définir l'identifiant du post.
     *
     * @param int $id 
     * @return self
     */ 
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Méthode pour récupérer le contenu du post.
     * 
     * @return string 
     */ 
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Méthode pour définir le contenu du post.
     *
     * @param string $text
     * @return self
     */ 
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Méthode pour récupérer la date de création du post.
     * 
     * @return DateTime|null 
     */ 
    public function getPostCreationDate(): ?DateTime
    {
        return $this->post_creation_date;
    }

    /**
     * Méthode pour définir la date de création du post.
     *
     * @param DateTime|null $post_creation_date
     * @return self
     */ 
    public function setPostCreationDate(?DateTime $post_creation_date): self
    {
        $this->post_creation_date = $post_creation_date;
        return $this;
    }

    /**
     * Méthode pour récupérer l'utilisateur associé au post.
     * 
     * @return mixed
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Méthode pour définir l'utilisateur associé au post.
     *
     * @param mixed $user
     * @return self
     */ 
    public function setUser($user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Méthode pour récupérer le sujet auquel le post appartient.
     * 
     * @return mixed 
     */ 
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Méthode pour définir le sujet auquel le post appartient.
     *
     * @param mixed $topic
     * @return self
     */ 
    public function setTopic($topic): self
    {
        $this->topic = $topic;
        return $this;
    }
}
?>
