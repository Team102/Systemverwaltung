<?php

/**
 * Der Datenbankadapter für die Lieferanten
 * User: Keeyzar
 * Date: 25.07.2016
 * Time: 22:19
 */
require_once("../module/baseDbAdapter.php");
require_once("../database_entities/Lieferant.php");
//require_once("module/baseDbAdapter.php");
//require_once("database_entities/Lieferant.php");
class LieferantenDBAdapter extends baseDbAdapter
{

    function __construct($user)
    {
        parent::__construct($user);
    }

    /**
     * Diese Funktion gibt gibt alle Lieferanten zurück
     * @return mixed array[Lieferant] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function selectLieferanten(){
        $sql = "SELECT * FROM lieferanten";
        $alleLieferanten = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($alleLieferanten == -1){
            return -1;
        }
        $lieferantenArray = array();
        foreach($alleLieferanten as $row){
            $lieferant = $this->getLieferantFromAssocArray($row);
            $lieferantenArray[] = $lieferant;
        }
        return $lieferantenArray;
    }

    /**
     * Fügt den Lieferanten hinzu
     * @param $lieferant Lieferant welcher Lieferant hinzugefügt werden soll
     * @return int
     */
    function insertLieferant($lieferant){
        return $this->insert("lieferanten", $lieferant);
    }

    /**
     * Fügt alle Lieferanten hinzu
     * @param $lieferantenArray array von Lieferanten, die hinzugefügt werden sollen
     */
    function insertLieferanten($lieferantenArray){
        foreach($lieferantenArray as $lieferant){
            $this->insertLieferant($lieferant);
        }
    }

    /**
     * @param $lieferant Lieferant welcher Lieferant upgedated werden soll
     */
    function updateLieferant($lieferant){
        $id = $lieferant->l_id;
        unset($lieferant->l_id);
        $this->update("lieferanten", $lieferant, "l_id = $id");
        $lieferant->l_id = $id;

    }

    /**
     * Löscht EINEN lieferanten
     * @param $lieferant Lieferant zu löschender Lieferant
     */
    function deleteLieferant($lieferant){
        $this->delete("lieferanten", "l_id = $lieferant->l_id");
    }

    /**
     * Löscht alle Lieferanten
     * @param $lieferantenArray array von Lieferanten
     */
    function deleteLieferanten($lieferantenArray){
        foreach($lieferantenArray as $lieferant){
            $this->deleteLieferant($lieferant);
        }
    }

    /**
     * Holt aus dem übergebenem assoziativen Array einen Lieferanten, der neu erstellt wird
     * @param $row array assoziatives Array vom Typ lieferant
     * @return Lieferant ein neuer Lieferant, mit den Daten die gefüllt wurden aus dem $row parameter
     */
    private function getLieferantFromAssocArray($row)
    {
        $lieferant = new Lieferant();
        $lieferant->l_id = $row["l_id"];
        $lieferant->l_firmenname = $row["l_firmenname"];
        $lieferant->l_strasse = $row["l_strasse"];
        $lieferant->l_plz = $row["l_plz"];
        $lieferant->l_ort = $row["l_ort"];
        $lieferant->l_tel = $row["l_tel"];
        $lieferant->l_mobil = $row["l_mobil"];
        $lieferant->l_fax = $row["l_fax"];
        $lieferant->l_email = $row["l_email"];
        return $lieferant;
    }
}