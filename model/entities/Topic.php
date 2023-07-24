<?php

namespace Model\Entities;

use App\Entity;
use DateTime;

final class Topic extends Entity
{
    private int $id;
    private string $title;
    private DateTime $topic_creation_date;
    private $is_locked;
    private $user;
    private $category;
    private string $format;

    public function __construct(array $data)
    {
        $this->hydrate($data);
        if (isset($data['topic_creation_date'])) {
            $this->setTopic_creation_date(new DateTime($data['topic_creation_date']));
        } else {
            $this->topic_creation_date = new DateTime();
        }
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
     * Get the value of title
     */ 
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return self
     */ 
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of topic_creation_date
     */ 
    public function getTopic_creation_date(): DateTime
    {
        return $this->topic_creation_date;
    }

    /**
     * Set the value of topic_creation_date
     *
     * @return self
     */ 
    public function setTopic_creation_date(DateTime $date): self
    {
        $this->topic_creation_date = $date;
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
    public function setIs_locked($is_locked): self
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
    public function setUser($user): self
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
    public function setCategory($category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get the value of format
     */ 
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Set the value of format
     *
     * @return self
     */ 
    public function setFormat(string $format): self
    {
        $this->format = $format;
        return $this;
    }
}

?>
