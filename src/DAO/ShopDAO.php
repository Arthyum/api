<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 9:34 AM
 */

namespace api\DAO;

use api\Domain\Shop;

class ShopDAO extends DAO
{

    public function findAll() {
        $sql = "select * from Magasin order by Id_Magasin desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $shops = array();
        foreach ($result as $row) {
            $shopID = $row['Id_Magasin'];
            $shops[$shopID] = $this->buildDomainObject($row);
        }
        return $shops;
    }

   /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The country id.
     *
     * @return \api\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from Magasin where Id_Magasin=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No shop matching id " . $id);
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The Vente id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('Magasin', array('Id_Magasin' => $id));
    }

    /**
     * Saves an article into the database.
     *
     * @param \api\Domain\Article $article The article to save
     */
    public function save(Shop $shop) {
        $shopData = array(
            'Id_Magasin' => $shop->getId(),
            'Id_Pays' => $shop->getIdCountry(),
            'Nom_Ville' => $shop->getTownName(),
            'Nom_Magasin' => $shop->getShopName(),
        );

        if ($shop->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('Magasin', $shopData, array('Id_Magasin' => $shop->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('Magasin', $shopData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $shop->setId($id);
        }
    }


    protected function buildDomainObject($row) {
        $shop = new Shop();
        $shop->setId($row['Id_Magasin']);
        $shop->setIdCountry($row['Id_Pays']);
        $shop->setTownName($row['Nom_Ville']);
        $shop->setShopName($row['Nom_Magasin']);
        return $shop;
    }
}