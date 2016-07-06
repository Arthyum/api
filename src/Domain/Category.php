<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 8:49 AM
 */

namespace api\Domain;


class Category
{
    /**
     * @var integer
     */
    private $id;
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