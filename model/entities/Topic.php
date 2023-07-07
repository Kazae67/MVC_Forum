<?php

namespace Model\Entities;

use App\Entity;

final class Topic extends Entity
{
    private $id;
    private $title;
    private $topic_creation_date;
    private $is_locked;
    private $user;
    private $category;

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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of topic_creation_date
     */ 
    public function getTopic_creation_date()
    {
        $formattedDate = $this->topic_creation_date->format("d/m/Y, H:i:s");
        return $formattedDate;
    }

    /**
     * Set the value of topic_creation_date
     *
     * @return self
     */ 
    public function setTopic_creation_date($date)
    {
        $this->topic_creation_date = new \DateTime($date);
        return $this;
    }

    /**
     * Get the value of is_locked
     */ 
    public function getIs_locked()
    {
        return $this->is_locked;
    }

    /**
     * Set the value of is_locked
     *
     * @return self
     */ 
    public function setIs_locked($is_locked)
    {
        $this->is_locked = $is_locked;
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
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
}

?>
