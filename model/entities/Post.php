<?php

namespace Model\Entities;

use App\Entity;
use DateTime;

final class Post extends Entity
{
    private int $id;
    private string $text;
    private ?DateTime $post_creation_date = null; //  '?' pour rendre le type nullable
    private $user;
    private $topic;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return self
     */ 
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of text
     */ 
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return self
     */ 
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get the value of post_creation_date
     */ 
    public function getPostCreationDate(): ?DateTime // ajout du '?' pour rendre le type nullable
    {
        return $this->post_creation_date;
    }

    /**
     * Set the value of post_creation_date
     *
     * @return self
     */ 
    public function setPostCreationDate(?DateTime $post_creation_date): self // '?' pour rendre le type nullable
    {
        $this->post_creation_date = $post_creation_date;
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
     * @return self
     */ 
    public function setUser($user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get the value of topic
     */ 
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the value of topic
     *
     * @return self
     */ 
    public function setTopic($topic): self
    {
        $this->topic = $topic;
        return $this;
    }
}

?>
