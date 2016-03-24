<?php

namespace SellDreams\Domain;

class Categorie
{
    /**
     * categorie id
     *
     * @var integer
     */
    private $id;

    /**
     * Categorie title
     *
     * @var string
     */
    private $title;

    /**
     * Categorie content
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

    public function setContent($Content) {
        $this->content = $Content;
    }
    
    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
    }
}