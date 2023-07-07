<?php

namespace Model\Entities;

use App\Entity;

final class Category extends Entity
{
    private $id;
    private $categoryLabel;

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
     * Get the value of categoryLabel
     */ 
    public function getCategoryLabel()
    {
        return $this->categoryLabel;
    }

    /**
     * Set the value of categoryLabel
     *
     * @return self
     */ 
    public function setCategoryLabel($categoryLabel)
    {
        $this->categoryLabel = $categoryLabel;
        return $this;
    }
}

?>
