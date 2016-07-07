<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 9:34 AM
 */

namespace api\DAO;

use api\Domain\Product;

class ProductDAO extends DAO
{
    public function findAll() {
        $sql = "select * from produit order by Id_Produit desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $products = array();
        foreach ($result as $row) {
            $productID = $row['Id_Produit'];
            $products[$productID] = $this->buildDomainObject($row);
        }
        return $products;
    }
    public function findProductByCategoryId($id) {
        $sql = "select * from produit where Id_Categorie=?";
        $result = $this->getDb()->fetchAssoc($sql, array($id));
        $products = array();
        foreach ($result as $row) {
            $productID = $row['Id_Produit'];
            $products[$productID] = $this->buildDomainObject($row);
        }
        return $products;

    }
    public function findProductsByStoreIdCategoryId($id_store, $id_category){
        $sql = "select * from produit p INNER JOIN tl_produit_magasin t ON p.Id_Produit=t.Id_Produit INNER JOIN categorie c ON c.Id_Categorie = p.Id_Categorie WHERE t.Id_Magasin = ? AND c.Id_Categorie = ?";
        $result = $this->getDb()->fetchAssoc($sql, array($id_store, $id_category));

        // Convert query result to an array of domain objects
        $products = array();
        foreach ($result as $row) {
            $productID = $row['Id_Produit'];
            $products[$productID] = $this->buildDomainObject($row);
        }
        return $products;
    }
    protected function buildDomainObject($row) {
        $product = new Product();
        $product->setId('Id_Produit');
        $product->setIdCategory('Id_Categorie');
        $product->setIdStock('Id_Stock');
        $product->setLabel('Libelle');
        return $product;
    }
}