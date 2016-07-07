<?php
/**
 * Created by PhpStorm.
 * User: Artyum
 * Date: 7/6/2016
 * Time: 9:34 AM
 */

namespace api\DAO;

use api\Domain\Pt_tva;

class Pt_tvaDAO extends DAO
{

    public function findAll() {
        $sql = "select * from TP_TVA order by Id_TVA desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $pt_tva = array();
        foreach ($result as $row) {
            $pt_tvaID = $row['Id_TVA'];
            $pt_tva[$pt_tvaID] = $this->buildDomainObject($row);
        }
        return $pt_tva;
    }

   /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The Pt_tva id.
     *
     * @return \api\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from TP_TVA where Id_TVA=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No TVA matching id " . $id);
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The Pt_tva id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('TP_TVA', array('Id_TVA' => $id));
    }

    /**
     * Saves an article into the database.
     *
     * @param \api\Domain\Article $pt_tva The article to save
     */
    public function save(Pt_tva $pt_tva) {
        $pt_tvaData = array(
            'Id_TVA' => $pt_tva->getId(),
            'Taux' => $pt_tva->getRate()
        );

        if ($pt_tva->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('TP_TVA', $pt_tvaData, array('Id_TVA' => $pt_tva->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('TP_TVA', $pt_tvaData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $pt_tva->setId($id);
        }
    }


    protected function buildDomainObject($row) {
        $pt_tva = new Pt_tva();
        $pt_tva->setId($row['Id_Pays']);
        $pt_tva->getRate($row['Taux']);
        return $pt_tva;
    }
}