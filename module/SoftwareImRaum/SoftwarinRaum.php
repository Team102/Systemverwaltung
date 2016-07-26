<?php
/* Der Datenbankadapter für die SoftwareImRaum
 * User: Fadi Koch
 * Date: 25.07.2016
 * Time: 13:37
 */

require("module/baseDbAdapter.php");
class SoftwareImRaumDBAdapter extends baseDbAdapter
{

    /**
     * Diese Funktion gibt gibt alle Lieferanten zurück
     * @return mixed array[Lieferant] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function SoftwareImRaum(){
        $sql = "SELECT * FROM SoftwareImRaum";
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

    function insertSoftwareImRaum($SoftwareImRaum){
        $this->insert("SoftwareImRaum", $SoftwareImRaum);
    }

    /**
     * @param $lieferant Lieferant welcher Lieferant upgedated werden soll
     */
    function updateSoftwareImRaum($SoftwareImRaum){
        unset($SoftwareImRaum->k_id);
        $this->update("SoftwareImRaum", $SoftwareImRaum, "k_id = $SoftwareImRaum->k_id");

    }

    /**
     * Löscht EINEN lieferanten
     * @param $lieferant Lieferant zu löschender Lieferant
     */
    function deleteSoftwareImRaum($SoftwareImRaum){
        $this->delete("SoftwareImRaum", "k_id = $SoftwareImRaum->k_id");
    }
    /*
    * Holt aus dem übergebenem assoziativen Array einen Lieferanten, der neu erstellt wird
    * @param $row array assoziatives Array vom Typ lieferant
    * @return Lieferant ein neuer Lieferant, mit den Daten die gefüllt wurden aus dem $row parameter
    */
    private function getSoftwareImRaumFromAssocArray($row)
    {
        $SoftwareImRaum = new SoftwareImRaum();
        $SoftwareImRaum->k_id = $row["k_id"];
        $SoftwareImRaum->r_id = $row["r_id"];

        return $SoftwareImRaum;
    }
}
?>