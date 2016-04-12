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
    
    public function articleIsInBasket($basket){
        return true;
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
        if ($basket->getId() && existe()) {
            // The article has already been saved : update it
            $this->getDb()->update('t_basket', $basketData, array('bas_id' => $basket->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('t_basket', $basketData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $basket->setId($id);
        }
    }
    
}