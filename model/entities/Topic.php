<?php

namespace Model\Entities;

use App\Entity;
use DateTime;

final class Topic extends Entity
{
    private int $id;
    private string $title;
    private DateTime $topic_creation_date;
    private bool $is_locked;
    private $user;
    private $category;
    private string $format;
    private string $topic_description;
    protected $countPost;
    private ?string $lastActivity; 

    public function __construct(array $data)
    {
        $this->hydrate($data);
        if (isset($data['topic_creation_date'])) {
            $this->setTopic_creation_date(new DateTime($data['topic_creation_date']));
        } else {
            $this->topic_creation_date = new DateTime();
        }
        if (isset($data['topic_description'])) {
            $this->setTopic_description($data['topic_description']);
        } else {
            $this->topic_description = ""; 
        }
        $this->is_locked = isset($data['is_locked']) ? (bool) $data['is_locked'] : false;
        $this->lastActivity = $data['lastActivity'] ?? null; 
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
    public function getIs_locked(): bool
    {
        return $this->is_locked;
    }

    /**
     * Set the value of is_locked
     *
     * @return self
     */ 
    public function setIs_locked(bool $is_locked): self
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

    /**
     * Get the value of topic_description
     */
    public function getTopic_description(): ?string
    {
        return $this->topic_description;
    }
    

    /**
     * Set the value of topic_description
     * 
     * @return self
     */
    public function setTopic_description(string $topic_description): self
    {
        $this->topic_description = $topic_description;
        return $this;
    }

    // Méthode pour définir le nombre de posts
    public function setCountPost($countPost)
    {
        $this->countPost = $countPost;
    }

    // Méthode pour récupérer le nombre de posts
    public function getCountPost()
    {
        return $this->countPost;
    }

    /**
     * Get the value of lastActivity
     */ 
    public function getLastActivity(): ?string
    {
        return $this->lastActivity;
    }

    /**
     * Set the value of lastActivity
     *
     * @return self
     */ 
    public function setLastActivity(?string $lastActivity): self
    {
        $this->lastActivity = $lastActivity;
        return $this;
    }
    

}

?>
