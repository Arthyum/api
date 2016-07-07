<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 9:14 AM
 */

namespace api\DAO;


use api\Domain\Category;

class CategoryDAO extends DAO
{

    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "select * from categorie order by Id_Categorie desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $categories = array();
        foreach ($result as $row) {
            $categoryId = $row['Id_Categorie'];
            $categories[$categoryId] = $this->buildDomainObject($row);
        }
        return $categories;
    }

    /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id The article id.
     *
     * @return \api\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from categorie where Id_Categorie=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No category matching id " . $id);
    }

    public function findCategoryIdByIdProduct($id){
        $sql = "select * from categorie where Id_Categorie=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No category matching id " . $id);
    }
    /**
     * Saves an article into the database.
     *
     * @param \api\Domain\Article $article The article to save
     */
    public function save(Category $category) {
        $categoryData = array(
            'Id_Categorie' => $category->getId(),
            'Libelle' => $category->getLabel()
        );

        if ($category->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('categorie', $categoryData, array('Id_Categorie' => $category->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('categorie', $categoryData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $category->setId($id);
        }
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('categorie', array('Id_Categorie' => $id));
    }

    /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Category data.
     * @return \api\Domain\Category
     */
    protected function buildDomainObject($row) {
        $category = new Category();
        $category->setId($row['Id_Categorie']);
        $category->setLabel($row['Libelle']);
        return $category;
    }

}