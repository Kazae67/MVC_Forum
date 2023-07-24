<?php

namespace Model\Entities;

use App\Entity;

final class Category extends Entity
{
    private int $id;
    private string $categoryLabel;

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
     * Get the value of categoryLabel
     */ 
    public function getCategoryLabel(): string
    {
        return $this->categoryLabel;
    }

    /**
     * Set the value of categoryLabel
     *
     * @return self
     */ 
    public function setCategoryLabel(string $categoryLabel): self
    {
        $this->categoryLabel = $categoryLabel;
        return $this;
    }
}

?>
