<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 8:50 AM
 */

namespace api\Domain;


class Shop
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var integer
     */
    private $id_country;
    /**
     * @var string
     */
    private $shop_name;
    /**
     * @var string
     */
    private $town_name;

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
    public function getIdCountry()
    {
        return $this->id_country;
    }

    /**
     * @param int $id_country
     */
    public function setIdCountry($id_country)
    {
        $this->id_country = $id_country;
    }

    /**
     * @return string
     */
    public function getShopName()
    {
        return $this->shop_name;
    }

    /**
     * @param string $shop_name
     */
    public function setShopName($shop_name)
    {
        $this->shop_name = $shop_name;
    }

    /**
     * @return string
     */
    public function getTownName()
    {
        return $this->town_name;
    }

    /**
     * @param string $town_name
     */
    public function setTownName($town_name)
    {
        $this->town_name = $town_name;
    }
    
}