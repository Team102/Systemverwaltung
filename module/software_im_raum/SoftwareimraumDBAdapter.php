<?php

/**
 * Der Datenbankadapter für die SoftwareImRaum
 * User: Fadi Koch
 * Date: 25.07.2016
 * Time: 13:37
 */
require_once("module/baseDbAdapter.php");
require_once("database_entities/Software_In_Raum");
class SoftwareInRaumDBAdapter extends baseDbAdapter
{

    /**
     * Diese Funktion gibt gibt alle Lieferanten zurück
     * @return mixed array[Lieferant] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function selectAlleSoftwareInRaum(){
        $sql = "SELECT * FROM software_in_raum";
        $alleSoftwareImRaum = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($alleSoftwareImRaum == -1){
            return -1;
        }
        $SoftwareImRaumArray = array();
        foreach($alleSoftwareImRaum as $row){
            $SoftwareImRaum = $this->getSoftwareImRaumFromAssocArray($row);
            $SoftwareImRaumArray[] = $SoftwareImRaum;
        }
        return $SoftwareImRaumArray;
    }

    /**
     * Fügt diese Software_in_raum beziehung hinzu
     * @param $SoftwareImRaum Software_In_Raum entity
     */
    function insertSoftwareImRaum($SoftwareImRaum){
        $this->insert("software_in_raum", $SoftwareImRaum);
    }

    /**
     * updatet dieses entity
     * @param $softwareInRaum Software_In_Raum welches Entity upgedated werden soll
     */
    function updateSoftwareImRaum($softwareInRaum){
        unset($softwareInRaum->k_id);
        $this->update("software_in_raum", $softwareInRaum, "k_id = $softwareInRaum->k_id");

    }

    /**
     * Löscht EIN entity
     * @param $softwareImRaum Software_In_Raum zu löschender Lieferant
     */
    function deleteSoftwareImRaum($softwareImRaum){
        $this->delete("SoftwareImRaum", "k_id = $softwareImRaum->k_id");
    }

    /**
    * Holt aus dem übergebenem assoziativen Array ein Software_In_Raum, das neu erstellt wird
    * @param $row array assoziatives Array vom Typ Software_In_Raum
    * @return Software_In_Raum ein neues Entity, mit den Daten die gefüllt wurden aus dem $row parameter
    */
    private function getSoftwareImRaumFromAssocArray($row)
    {
        $SoftwareImRaum = new Software_In_Raum();
        $SoftwareImRaum->k_id = $row["k_id"];
        $SoftwareImRaum->r_id = $row["r_id"];

        return $SoftwareImRaum;
    }
}