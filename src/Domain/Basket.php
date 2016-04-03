<?php

namespace SellDreams\Domain;

class Basket 
{
    
    /**
     * Basket id.
     *
     * @var integer
     */
    private $id;
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * User id.
     *
     * @var integer
     */
    private $usrid;
    public function getUsrid() {
        return $this->usrid;
    }

    public function setUsrid($usrid) {
        $this->usrid = $usrid;
    }
    
    /**
     * Article id.
     *
     * @var integer
     */
    private $artid;
    public function getArtid() {
        return $this->artid;
    }

    public function setArtid($artid) {
        $this->artid = $artid;
    }
    /**
     * Quantity
     *
     * @var integer
     */
    private $quantity;
    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
    /**
     * Article title.
     *
     * @var string
     */
    private $title;
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    /**
     * article value
     *
     * @var string
     */
    private $value;
    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }


}