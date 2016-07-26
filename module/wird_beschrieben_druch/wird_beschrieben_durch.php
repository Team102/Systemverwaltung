<?php
/*
 * Der Datenbankadapter für die Lieferanten
 * User: Fadi Koch
 * Date: 25.07.2016
 * Time: 13:37
 *
 */
require("module/baseDbAdapter.php");
class wirdBeschriebenDurchDBAdapter extends baseDbAdapter
{

    /**
     * Diese Funktion gibt gibt alle Lieferanten zurück
     * @return mixed array[Lieferant] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function wirdBeschriebenDurch(){
        $sql = "SELECT * FROM wirdBeschriebenDurch";
        $allewirdBeschriebenDurch = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($allewirdBeschriebenDurch == -1){
            return -1;
        }
        $wirdBeschriebenDurchArray = array();
        foreach($allewirdBeschriebenDurch as $row){
            $wirdBeschriebenDurch = $this->getwirdBeschriebenDurchFromAssocArray($row);
            $wirdBeschriebenDurchArray[] = wirdBeschriebenDurch;
        }
        return $wirdBeschriebenDurchArray;
    }

//    /**
//     * Selektiert Lieferanten anhand der übergebenen Condition
//     */
//    function selectLieferantenByCondition(){
//        $condition;
//        $sql = "SELECT * FROM lieferanten WHERE $condition";
//        $parameter;
//        $alleLieferanten = $this->execSQLParameters($sql, $parameter);
//    }

    /**
     * Fügt den Lieferanten hinzu
     * @param $lieferant Lieferant welcher Lieferant hinzugefügt werden soll
     */
    function insertwirdBeschriebenDurch($wirdBeschriebenDurch){
        $this->insert("wirdBeschriebenDurch", $wirdBeschriebenDurch);
    }

    /**
     * @param $lieferant Lieferant welcher Lieferant upgedated werden soll
     */
    function updatewirdBeschriebenDurch($wirdBeschriebenDurch){
        unset($wirdBeschriebenDurch->l_id);
        $this->update("wirdBeschriebenDurch", $wirdBeschriebenDurch, "kar_id = $wirdBeschriebenDurch->kar_id");

    }

    /**
     * Löscht EINEN lieferanten
     * @param $lieferant Lieferant zu löschender Lieferant
     */
    function deletewirdBeschriebenDurch($wirdBeschriebenDurch){
        $this->delete("wirdBeschriebenDurch", "kat_id = $wirdBeschriebenDurch->kat_id");
    }
    /*
    * Holt aus dem übergebenem assoziativen Array einen Lieferanten, der neu erstellt wird
    * @param $row array assoziatives Array vom Typ lieferant
    * @return Lieferant ein neuer Lieferant, mit den Daten die gefüllt wurden aus dem $row parameter
    */
    private function getLieferantFromAssocArray($row)
    {
        $wirdBeschriebenDurch = new wirdBeschriebenDurch();
        $wirdBeschriebenDurch->kar_id = $row["kar_id"];
        $wirdBeschriebenDurch->kat_id = $row["kat_id"];

        return $wirdBeschriebenDurch;
    }
}

?>