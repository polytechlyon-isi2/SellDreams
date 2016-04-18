<?php
namespace SellDreams\DAO;

use SellDreams\Domain\Basket;
use SellDreams\Domain\Article;

class BasketDAO extends DAO
{

    
    /**
     * Returns an categorie matching the supplied id.
     *
     * @param integer $id
     *
     * @return \SellDreams\Domain\Article|throws an exception if no matching article is found
     */
    public function findAllByUser($id) {

        $sql = "SELECT bas_id, usr_id, B.art_id, bas_quantity, A.art_title, A.art_value FROM t_basket B, t_article A WHERE A.art_id = B.art_id AND usr_id=?";
        $result = $this->getDb()->fetchAll($sql, array($id));
        $baskets = array();
        $indice = 1;
        foreach ($result as $row) {
            $indice = $indice+1;
            $baskets[$indice] = $this->buildDomainObject($row);
        }
        return $baskets;
    }
    
    /**
     * Returns an categorie matching the supplied id.
     *
     * @param integer $id
     *
     * @return \SellDreams\Domain\Article|throws an exception if no matching article is found
     */
    public function findByUsrArt($usrid, $artid) {

        $sql = "SELECT bas_id, usr_id, B.art_id, bas_quantity, A.art_title, A.art_value FROM t_basket B, t_article A WHERE A.art_id = B.art_id AND usr_id=? AND B.art_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($usrid, $artid));
        if ($row){
            $basket=$this->buildDomainObject($row);
        }
        else{
            $basket=null;
        }
        return $basket;
    }
    
    
    /**
     * Creates an Basket object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \MicroCMS\Domain\Article
     */
    protected function buildDomainObject($row) {
        $basket = new Basket();
        $basket->setId($row['bas_id']);
        $basket->setUsrid($row['usr_id']);
        $basket->setArtid($row['art_id']);
        $basket->setQuantity($row['bas_quantity']);
        $basket->setTitle($row['art_title']);
        $basket->setValue($row['art_value']);
        return $basket;
    }

    
    
    /**
     * Saves a comment into the database.
     *
     * @param \sellDreams\Domain\Basket $basket The comment to save
     */
    public function save(Basket $basket) {
        $basketData = array(
            'usr_id' => $basket->getUsrid(),
            'art_id' => $basket->getArtid(),
            'bas_quantity' => $basket->getQuantity()
            );
        // The article has never been saved : insert it
        $this->getDb()->insert('t_basket', $basketData);
        // Get the id of the newly created comment and set it on the entity.
        $id = $this->getDb()->lastInsertId();
        $basket->setId($id);
    }
    
    /**
     * Saves a comment into the database.
     *
     * @param \sellDreams\Domain\Basket $basket The comment to save
     */
    public function update(Basket $basket) {
        $this->getDb()->delete('t_basket', array('bas_id' => $basket->getId()));
        $basketData = array(
            'usr_id' => $basket->getUsrid(),
            'art_id' => $basket->getArtid(),
            'bas_quantity' => $basket->getQuantity()
            );
        $this->getDb()->insert('t_basket', $basketData);
        $id = $this->getDb()->lastInsertId();
        $basket->setId($id);
    }
    
    /**
     * Removes an article from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('t_basket', array('bas_id' => $id));
    }
}