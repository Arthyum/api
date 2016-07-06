<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 8:43 AM
 */

namespace api\Domain;


/**
 * Class Client
 * @package api\Domain
 */
class Client
{

    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $nom;
    /**
     * @var string
     */
    private $prenom;
    /**
     * @var string
     */
    private $dateNaissance;

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param string $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }


}