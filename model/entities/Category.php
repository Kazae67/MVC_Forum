<?php

namespace Model\Entities;

use App\Entity;

final class Category extends Entity
{
    // Propriétés de la classe
    private int $id; 
    private string $categoryLabel; 

    // Constructeur de la classe
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * Méthode pour récupérer l'identifiant de la catégorie.
     * 
     * @return int
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Méthode pour définir l'identifiant de la catégorie.
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
     * Méthode pour récupérer le libellé de la catégorie.
     * 
     * @return string 
     */ 
    public function getCategoryLabel(): string
    {
        return $this->categoryLabel;
    }

    /**
     * Méthode pour définir le libellé de la catégorie.
     *
     * @param string $categoryLabel
     * @return self
     */ 
    public function setCategoryLabel(string $categoryLabel): self
    {
        $this->categoryLabel = $categoryLabel;
        return $this;
    }
}
?>
