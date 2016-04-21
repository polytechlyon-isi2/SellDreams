<?php
namespace SellDreams\DAO;

use SellDreams\Domain\Categorie;

class CategorieDAO extends DAO
{
    /**
     * Return a list of all categorie, sorted by date (most recent first).
     *
     * @return array A list of all categorie.
     */
    public function findAll() {
        $sql = "select * from t_categorie order by cat_id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $categories = array();
        foreach ($result as $row) {
            $categorieId = $row['cat_id'];
            $categories[$categorieId] = $this->buildDomainObject($row);
        }
        return $categories;
    }
    
    /**
     * Creates an Categorie object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \MicroCMS\Domain\Article
     */
    protected function buildDomainObject($row) {
        $categorie = new Categorie();
        $categorie->setId($row['cat_id']);
        $categorie->setTitle($row['cat_title']);
        $categorie->setContent($row['cat_content']);
        $categorie->setImg($row['cat_img']);
        return $categorie;
    }
    
    /**
     * Returns an categorie matching the supplied id.
     *
     * @param integer $id
     *
     * @return \MicroCMS\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from t_categorie where cat_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row){
            return $this->buildDomainObject($row);
        }
        else{
            throw new \Exception("No categorie matching id " . $id);
        }
    }
}