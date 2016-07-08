<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/8/2016
 * Time: 9:30 AM
 */

namespace api\DAO;

use api\Domain\Stock;


class StockDAO extends DAO
{
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "select * from stock order by Id_Stock desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $stocks = array();
        foreach ($result as $row) {
            $stockId = $row['Id_Stock'];
            $stocks[$stockId] = $this->buildDomainObject($row);
        }
        return $stocks;
    }

    /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id The article id.
     *
     * @return \api\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from stock where Id_Stock=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No stock matching id " . $id);
    }

    /**
     * Saves an article into the database.
     *
     * @param \api\Domain\Article $article The article to save
     */
    public function save(Stock $stock) {
        $stockData = array(
            'Id_Stock' => $stock->getIdStock(),
            'Id_Magasin' => $stock->getIdStore(),
            'Id_Produit' => $stock->getIdProduct(),
            'Quantite' => $stock->getQuantity(),
        );

        if ($stock->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('stock', $stockData, array('Id_Stock' => $stock->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('stock', $stockData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $stock->setId($id);
        }
    }
    public function findStockByIdProductIdStore($idProduct, $idStore){
        $sql = "select * from stock where Id_Produit=? AND Id_Magasin =?";
        $row = $this->getDb()->fetchAssoc($sql, array($idProduct, $idStore));
        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No stock matching id " . $idProduct . " " . $idStore);
    }
    public function updateQuantity(Stock $stock){
        $idProduct = $stock->getIdProduct();
        $idStore = $stock->getIdStore();
        $quantity = $stock->getQuantity();
        $stockTarget = $this->findStockByIdProductIdStore($idProduct, $idStore);
        $stockData = array(
            'Id_Stock' => $stockTarget->getId(),
            'Id_Magasin' => $stockTarget->getIdStore(),
            'Id_Produit' => $stockTarget->getIdProduct(),
            'Quantite' => $stockTarget->getQuantity() - $quantity,
        );

        $this->getDb()->update('stock', $stockData, array('Id_Stock' => $stock->getId()));
    }
    /**
     * Removes an article from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('stock', array('Id_Stock' => $id));
    }

    /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \api\Domain\Article
     */
    protected function buildDomainObject($row) {
        $stock = new Stock();
        $stock->setId(($row['Id_Stock']));
        $stock->setIdStore(($row['Id_Magasin']));
        $stock->setIdStore(($row['Id_Produit']));
        $stock->setQuantity($row['Quantite']);
        return $stock;
    }
}