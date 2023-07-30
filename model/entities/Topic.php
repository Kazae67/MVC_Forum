<?php

namespace Model\Entities;

use App\Entity;
use DateTime;

final class Topic extends Entity
{
    // Propriétés de la classe
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

    // Constructeur de la classe
    public function __construct(array $data)
    {
        $this->hydrate($data);

        // Si la date de création du topic est fournie, on l'instancie en objet DateTime.
        // Sinon, on utilise la date et l'heure actuelles.
        if (isset($data['topic_creation_date'])) {
            $this->setTopic_creation_date(new DateTime($data['topic_creation_date']));
        } else {
            $this->topic_creation_date = new DateTime();
        }

        // Si la description du topic est fournie, on la définit.
        // Sinon, on initialise la description à une chaîne vide.
        $this->topic_description = $data['topic_description'] ?? "";
        
        // Si le topic est verrouillé, on définit le booléen correspondant.
        // Sinon, le topic n'est pas verrouillé (false).
        $this->is_locked = isset($data['is_locked']) ? (bool) $data['is_locked'] : false;
        
        // On récupère la dernière activité du topic (s'il y en a une) ou on définit null.
        $this->lastActivity = $data['lastActivity'] ?? null; 
    }
    
    /**
     * Méthode pour récupérer l'identifiant du topic.
     * 
     * @return int 
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Méthode pour définir l'identifiant du topic.
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
     * Méthode pour récupérer le titre du topic.
     * 
     * @return string 
     */ 
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Méthode pour définir le titre du topic.
     *
     * @param string $title 
     * @return self
     */ 
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Méthode pour récupérer la date de création du topic.
     * 
     * @return DateTime 
     */ 
    public function getTopic_creation_date(): DateTime
    {
        return $this->topic_creation_date;
    }

    /**
     * Méthode pour définir la date de création du topic.
     *
     * @param DateTime $date 
     * @return self
     */ 
    public function setTopic_creation_date(DateTime $date): self
    {
        $this->topic_creation_date = $date;
        return $this;
    }

    /**
     * Méthode pour savoir si le topic est verrouillé.
     * 
     * @return bool 
     */ 
    public function getIs_locked(): bool
    {
        return $this->is_locked;
    }

    /**
     * Méthode pour définir si le topic est verrouillé.
     *
     * @param bool $is_locked 
     * @return self
     */ 
    public function setIs_locked(bool $is_locked): self
    {
        $this->is_locked = $is_locked;
        return $this;
    }

    /**
     * Méthode pour récupérer l'utilisateur associé au topic.
     * 
     * @return mixed 
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Méthode pour définir l'utilisateur associé au topic.
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
     * Méthode pour récupérer la catégorie à laquelle le topic appartient.
     * 
     * @return mixed 
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Méthode pour définir la catégorie à laquelle le topic appartient.
     *
     * @param mixed $category 
     * @return self
     */ 
    public function setCategory($category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Méthode pour récupérer le format du topic.
     * 
     * @return string 
     */ 
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Méthode pour définir le format du topic.
     *
     * @param string $format 
     * @return self
     */ 
    public function setFormat(string $format): self
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Méthode pour récupérer la description du topic.
     * 
     * @return string|null 
     */
    public function getTopic_description(): ?string
    {
        return $this->topic_description;
    }
    
    /**
     * Méthode pour définir la description du topic.
     * 
     * @param string $topic_description 
     * @return self
     */
    public function setTopic_description(string $topic_description): self
    {
        $this->topic_description = $topic_description;
        return $this;
    }

    /**
     * Méthode pour définir le nombre de posts associés au topic.
     * 
     * @param int $countPost 
     * @return self
     */
    public function setCountPost(int $countPost): self
    {
        $this->countPost = $countPost;
        return $this;
    }

    /**
     * Méthode pour récupérer le nombre de posts associés au topic.
     * 
     * @return int 
     */
    public function getCountPost(): int
    {
        return $this->countPost;
    }

    /**
     * Méthode pour récupérer la date de la dernière activité du topic.
     * 
     * @return string|null 
     */ 
    public function getLastActivity(): ?string
    {
        return $this->lastActivity;
    }

    /**
     * Méthode pour définir la date de la dernière activité du topic.
     *
     * @param string|null $lastActivity 
     * @return self
     */ 
    public function setLastActivity(?string $lastActivity): self
    {
        $this->lastActivity = $lastActivity;
        return $this;
    }
}
?>
