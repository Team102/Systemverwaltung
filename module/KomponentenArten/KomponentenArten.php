<?php
/**
 * Created by PhpStorm.
 * User: Fadi koch
 * Date: 26.07.2016
 * Time: 14:38
 */

/**
 * Der Datenbankadapter für die Lieferanten
 * User: Fadi Koch
 * Date: 25.07.2016
 * Time: 14:08
 */
require("module/baseDbAdapter.php");
class komponentenartenDBAdapter extends baseDbAdapter
{

    /**
     * Diese Funktion gibt gibt alle komponentenarten zurück
     * @return mixed array[Lieferant] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function selectkomponentenarten(){
        $sql = "SELECT * FROM komponentenarten";
        $allekomponentenarten = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($allekomponentenarten == -1){
            return -1;
        }
        $komponentenartenArray = array();
        foreach($allekomponentenarten as $row){
            $lieferant = $this->getkomponentenartenFromAssocArray();
            $komponentenartenArray[] = $lieferant;
        }
        return $komponentenartenArray;
    }

    /**
     * Fügt den komponentenarten hinzu
     * @param $lieferant Lieferant welcher Lieferant hinzugefügt werden soll
     */
    function insertkomponentenarten($komponentenarten){
        $this->insert("komponentenarten", $komponentenarten);
    }

    /**
     * @param $komponentenarten komponentenarten welcher komponentenarten upgedated werden soll
     */
    function updatekomponentenarten($komponentenarten){
        unset($komponentenarten->l_id);
        $this->update("komponentenarten", $komponentenarten, "kar_id = $komponentenarten->kar_id");

    }

    /**
     * Löscht EINEN komponentenarten
     * @param $komponentenarten komponentenarten zu löschender komponentenarten
     */
    function deletekomponentenarten($komponentenarten){
        $this->delete("komponentenarten", "kar_id = $komponentenarten->kar_id");
    }

    /**
     * Holt aus dem übergebenem assoziativen Array einen komponentenarten, der neu erstellt wird
     * @param $row array assoziatives Array vom Typ komponentenarten
     * @return komponentenarten ein neuer komponentenarten, mit den Daten die gefüllt wurden aus dem $row parameter
     */
    private function getkomponentenartenFromAssocArray($row)
    {
        $komponentenarten = new komponentenarten();
        $komponentenarten->kar_id = $row["kar_id"];
        $komponentenarten->kar_bezeichnung = $row["kar_bezeichnung"];
        return $komponentenarten;
    }
}

?>