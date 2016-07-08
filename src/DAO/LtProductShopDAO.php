<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/8/2016
 * Time: 3:26 PM
 */

namespace api\DAO;


use api\Domain\Lt_product_shop;

class LtProductShopDAO extends DAO
{
    public function find($id) {
        $sql = "select * from tl_produit_magasin where Id_Produit_Magasin=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No article matching id " . $id);
    }
    public function findByProductIdShopId($idProduct, $idShop) {
        $sql = "select * from tl_produit_magasin where Id_Produit=? AND Id_Magasin=?";
        $row = $this->getDb()->fetchAssoc($sql, array($idProduct, $idShop));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No article matching id " . $idProduct . " " . $idShop);
    }
    protected function buildDomainObject($row) {
        $ltProductStock = new Lt_product_shop();
        $ltProductStock->setId($row['Id_Produit_Magasin']);
        $ltProductStock->setIdProduct($row['Id_Produit']);
        $ltProductStock->setIdShop($row['Id_Magasin']);
        $ltProductStock->setIdTva($row['Id_TVA']);
        $ltProductStock->setPrice($row['Prix_HT']);
        return $ltProductStock;
    }
}