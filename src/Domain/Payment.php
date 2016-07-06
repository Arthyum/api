<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 8:52 AM
 */

namespace api\Domain;


class Payment
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var integer
     */
    private $id_ticket;
    /**
     * @var double
     */
    private $amount;
    /**
     * @var integer
     */
    private $payment_type;

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
    public function getIdTicket()
    {
        return $this->id_ticket;
    }

    /**
     * @param int $id_ticket
     */
    public function setIdTicket($id_ticket)
    {
        $this->id_ticket = $id_ticket;
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

    /**
     * @return int
     */
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * @param int $payment_type
     */
    public function setPaymentType($payment_type)
    {
        $this->payment_type = $payment_type;
    }
    
}