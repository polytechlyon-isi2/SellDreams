<?php

namespace SellDreams\Domain;

class Article 
{
    /**
     * Article id.
     *
     * @var integer
     */
    private $id;

    /**
     * Article title.
     *
     * @var string
     */
    private $title;

    /**
     * Article content.
     *
     * @var string
     */
    private $content;
    
    /**
     * Categorie content
     *
     * @var string
     */
    private $img;
    
    /**
     * Categorie content
     *
     * @var string
     */
    private $value;
    
    /**
     * Categorie content
     *
     * @var string
     */
    private $categorie;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }
    
    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
    }
    
    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }
    
    public function getCategorie() {
        return $this->categorie;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }
}