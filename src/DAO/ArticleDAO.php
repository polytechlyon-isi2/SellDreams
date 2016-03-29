<?php
namespace SellDreams\DAO;

use SellDreams\Domain\Article;
class ArticleDAO extends DAO
{
	/**
     * @var \MicroCMS\DAO\ArticleDAO
     */
    private $categorieDAO;
    public function setCategorieDAO(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAllByCategorie($categorieID) {
		//$categorie = $this->categorieDAO->find($categorieId);
        $sql = "select * from t_article where art_categorie=? order by art_id desc";
        $result = $this->getDb()->fetchAll($sql, array($categorieID));
        // Convert query result to an array of domain objects
        $articles = array();
        foreach ($result as $row) {
            $articleId = $row['art_id'];
            $articles[$articleId] = $this->buildDomainObject($row);
        }
        return $articles;
    }
    /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \MicroCMS\Domain\Article
     */
    protected function buildDomainObject($row) {
        $article = new Article();
        $article->setId($row['art_id']);
        $article->setTitle($row['art_title']);
        $article->setContent($row['art_content']);
        $article->setCategorie($row['art_categorie']);
        $article->setImg($row['art_img']);
        $article->setValue($row['art_value']);
        return $article;
    }
	/**
     * Returns an article matching the supplied id.
     *
     * @param integer $id
     *
     * @return \MicroCMS\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from t_article where art_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No article matching id " . $id);
    }
    
    public function findAll() {
        $sql = "select * from t_article order by art_id desc";
        $result = $this->getDb()->fetchAll($sql);
        $articles = array();
        foreach ($result as $row) {
            $articleId = $row['art_id'];
            $articles[$articleId] = $this->buildDomainObject($row);
        }
        return $articles;
    }
    
    /**
     * Saves an article into the database.
     *
     * @param \MicroCMS\Domain\Article $article The article to save
     */
    public function save(Article $article) {
        $articleData = array(
            'art_title' => $article->getTitle(),
            'art_content' => $article->getContent(),
            'art_categorie' => $article->getCategorie(),
            'art_img' => $article->getImg(),
            'art_value' => $article->getValue(),
            );
        if ($article->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('t_article', $articleData, array('art_id' => $article->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('t_article', $articleData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $article->setId($id);
        }
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('t_article', array('art_id' => $id));
    }
    
}