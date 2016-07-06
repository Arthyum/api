<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 9:04 AM
 */

namespace api\Domain;


class Lt_product_shop
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var integer
     */
    private $id_shop;
    /**
     * @var integer
     */
    private $id_product;
    /**
     * @var integer
     */
    private $id_tva;
    /**
     * @var double
     */
    private $price;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdShop()
    {
        return $this->id_shop;
    }

    /**
     * @param int $id_shop
     */
    public function setIdShop($id_shop)
    {
        $this->id_shop = $id_shop;
    }

    /**
     * @return int
     */
    public function getIdProduct()
    {
        return $this->id_product;
    }

    /**
     * @param int $id_product
     */
    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;
    }

    /**
     * @return int
     */
    public function getIdTva()
    {
        return $this->id_tva;
    }

    /**
     * @param int $id_tva
     */
    public function setIdTva($id_tva)
    {
        $this->id_tva = $id_tva;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}