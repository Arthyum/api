<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 9:02 AM
 */

namespace api\Domain;


class Ticket
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
     * @var double
     */
    private $amount;

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
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

}