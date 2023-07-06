<?php

namespace Model\Entities;

use App\Entity;

final class Post extends Entity
{
    private $id;
    private $text;
    private $creation_date;
    private $user;
    private $topic;

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
     * @return self
     */ 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return self
     */ 
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get the value of creation_date
     */ 
    public function getCreation_date()
    {
        return $this->creation_date;
    }

    /**
     * Set the value of creation_date
     *
     * @return self
     */ 
    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;
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
    public function setUser($user)
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
    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }
}

?>
