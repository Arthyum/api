<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 8:56 AM
 */

namespace api\Domain;


class Product
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var integer
     */
    private $id_category;

    /**
     * @return int
     */
    public function getIdCategory()
    {
        return $this->id_category;
    }

    /**
     * @param int $id_category
     */
    public function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
    }
    /**
     * @var integer
     */
    private $id_stock;
    /**
     * @var string
     */
    private $label;

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

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
    
}