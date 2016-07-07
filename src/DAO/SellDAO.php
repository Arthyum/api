<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 9:34 AM
 */

namespace api\DAO;

use api\Domain\Sell;

class SellDAO extends DAO
{

    public function findAll() {
        $sql = "select * from Vente order by Id_Vente desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $sells = array();
        foreach ($result as $row) {
            $sellID = $row['Id_Vente'];
            $sells[$sellID] = $this->buildDomainObject($row);
        }
        return $sells;
    }

   /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The country id.
     *
     * @return \api\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from Vente where Id_Vente=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No sell matching id " . $id);
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The Vente id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('Vente', array('Id_Vente' => $id));
    }

    /**
     * Saves an article into the database.
     *
     * @param \api\Domain\Article $article The article to save
     */
    public function save(Sell $sell) {
        $sellData = array(
            'Id_Vente' => $sell->getId(),
            'Id_Produit_Magasin' => $sell->getIdProductShop(),
            'Id_Client' => $sell->getIdClient(),
            'Quantite' => $sell->getQuantity(),
            'DateVente' => $sell->getDate(),
        );

        if ($sell->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('Vente', $sellData, array('Id_Vente' => $sell->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('Vente', $sellData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $sell->setId($id);
        }
    }


    protected function buildDomainObject($row) {
        $sell = new Sell();
        $sell->setId($row['Id_Vente']);
        $sell->setIdProductShop($row['Id_Produit_Magasin']);
        $sell->setIdClient($row['Id_Client']);
        $sell->setQuantity($row['Quantite']);
        $sell->setDate($row['DateVente']);
        return $sell;
    }
}