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
}