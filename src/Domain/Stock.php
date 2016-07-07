<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 8:58 AM
 */

namespace api\Domain;


class Stock
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var integer
     */
    private $id_store;
    /**
     * @var integer
     */
    private $id_stock;

    private $id_product;

    /**
     * @return mixed
     */
    public function getIdProduct()
    {
        return $this->id_product;
    }

    /**
     * @param mixed $id_product
     */
    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;
    }
    /**
     * @return int
     */
    public function getIdStock()
    {
        return $this->id_stock;
    }

    /**
     * @param int $id_stock
     */
    public function setIdStock($id_stock)
    {
        $this->id_stock = $id_stock;
    }
    
    private $quantity;

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
    public function getIdStore()
    {
        return $this->id_store;
    }

    /**
     * @param int $id_store
     */
    public function setIdStore($id_store)
    {
        $this->id_store = $id_store;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

}