<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 9:10 AM
 */

namespace api\Domain;


use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class Sell
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var integer
     */
    private $id_client;
    /**
     * @var integer
     */
    private $id_product_shop;
    /**
     * @var DateTime
     */
    private $date;
    /**
     * @var integer
     */
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
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * @param int $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    /**
     * @return int
     */
    public function getIdProductShop()
    {
        return $this->id_product_shop;
    }

    /**
     * @param int $id_product_shop
     */
    public function setIdProductShop($id_product_shop)
    {
        $this->id_product_shop = $id_product_shop;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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