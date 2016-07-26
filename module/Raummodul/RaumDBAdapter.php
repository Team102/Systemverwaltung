<?php

/**
 * Dieser Adapter enthält alle wichtigen DB Funktionalitaeten
 * für die Räume
 * User: Kevin
 * Date: 26.07.2016
 * Time: 13:05
 */
require("module/baseDbAdapter.php");
require_once("database_entities/Raum.php");
class RaumDBAdapter
{
    /**
     * Diese Funktion gibt gibt alle Räume zurück
     * @return mixed array[Raum] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function selectLieferanten(){
        $sql = "SELECT * FROM raeume";
        $alleRaeume = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($alleRaeume == -1){
            return -1;
        }
        $raeumeArray = array();
        foreach($alleRaeume as $row){
            $raeumeArray[] = $this->getRaeumeFromAssocArray($row);
        }
        return $raeumeArray;
    }

    /**
     * Fügt den Raum hinzu
     * @param $raum Raum welcher Raum hinzugefügt werden soll
     */
    function insertRaum($raum){
        $this->insert("raeume", $raum);
    }

    /**
     * Fügt alle Raeume hinzu
     * @param $raeumeArray array von Raeumen, die hinzugefügt werden sollen
     */
    function insertRaeume($raeumeArray){
        foreach($raeumeArray as $raum){
            $this->insertRaum($raum);
        }
    }

    /**
     * @param $raum Raum welcher Lieferant upgedated werden soll
     */
    function updateLieferant($raum){
        unset($raum->l_id);
        $this->update("raeume", $raum, "r_id = $raum->r_id");

    }

    /**
     * Löscht EINEN raum
     * @param $raum Raum zu löschender Lieferant
     */
    function deleteLieferant($raum){
        $this->delete("raeume", "l_id = $raum->r_id");
    }

    /**
     * Löscht alle Räume
     * @param $raeumeArray array von Räumen
     */
    function deleteLieferanten($raeumeArray){
        foreach($raeumeArray as $raum){
            $this->deleteLieferant($raum);
        }
    }

    /**
     * Holt aus dem übergebenem assoziativen Array einen Raum, der neu erstellt wird
     * @param $row array assoziatives Array vom Typ Raum
     * @return Raum ein neuer Raum, mit den Daten die gefüllt wurden aus dem $row parameter
     */
    private function getRaeumeFromAssocArray($row)
    {
        $raum = new Raum();
        $raum->r_id = $row["r_id"];
        $raum->r_nr = $row["r_nr"];
        $raum->r_bezeichnung = $row["r_bezeichnung"];
        $raum->r_notiz = $row["r_notiz"];
        return $raum;
    }
}