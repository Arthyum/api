<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 9:34 AM
 */

namespace api\DAO;

use api\Domain\Country;

class CountryDAO extends DAO
{

    public function findAll() {
        $sql = "select * from Pays order by Id_Pays desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $countries = array();
        foreach ($result as $row) {
            $countryID = $row['Id_Pays'];
            $countries[$countryID] = $this->buildDomainObject($row);
        }
        return $countries;
    }

   /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The country id.
     *
     * @return \api\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from Pays where Id_Pays=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $id);
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The Country id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('Pays', array('Id_Pays' => $id));
    }

    /**
     * Saves an article into the database.
     *
     * @param \api\Domain\Article $article The article to save
     */
    public function save(Country $country) {
        $countryData = array(
            'Id_Pays' => $country->getId(),
            'Nom' => $country->getName()
        );

        if ($country->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('Pays', $countryData, array('Id_Categorie' => $country->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('Pays', $countryData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $country->setId($id);
        }
    }


    protected function buildDomainObject($row) {
        $country = new Country();
        $country->setId($row['Id_Pays']);
        $country->setNom($row['Nom']);
        return $country;
    }
}