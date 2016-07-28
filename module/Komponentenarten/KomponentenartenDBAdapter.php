<?php

/**
 * Der Datenbankadapter für die Lieferanten
 * User: Fadi Koch
 * Date: 25.07.2016
 * Time: 14:08
 */
require_once(__DIR__ . "/../baseDbAdapter.php");
require_once(__DIR__ . "/../../database_entities/KomponentenArten.php");
class KomponentenartenDBAdapter extends baseDbAdapter
{

    /**
     * Diese Funktion gibt alle komponentenarten zurück
     * @return mixed array[Komponetenarten] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function selectKomponentenarten(){
        $sql = "SELECT * FROM komponentenarten";
        $allekomponentenarten = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($allekomponentenarten == -1){
            return -1;
        }
        $komponentenartenArray = array();
        foreach($allekomponentenarten as $row){
            $komponentenart = $this->getkomponentenartenFromAssocArray($row);
            $komponentenartenArray[] = $komponentenart;
        }
        return $komponentenartenArray;
    }

    /**
     * Fügt den komponentenarten hinzu
     * @param $komponentenart KomponentenArten welche Komponente hinzugefügt werden soll
     */
    function insertkomponentenarten($komponentenart){
        $this->insert("komponentenarten", $komponentenart);
    }

    /**
     * @param $komponentenarten komponentenarten welcher komponentenarten upgedated werden soll
     */
    function updatekomponentenarten($komponentenarten){
        $kar_id = $komponentenarten->kar_id;
        unset($komponentenarten->kar_id);
        $this->update("komponentenarten", $komponentenarten, "kar_id = $kar_id");

    }

    /**
     * Löscht EINE komponentenarten
     * @param $komponentenarten komponentenarten zu löschender komponentenarten
     */
    function deletekomponentenarten($komponentenarten){
        $this->delete("komponentenarten", "kar_id = $komponentenarten->kar_id");
    }

    /**
     * Holt aus dem übergebenem assoziativen Array einen komponentenarten, der neu erstellt wird
     * @param $row array assoziatives Array vom Typ komponentenarten
     * @return komponentenarten eine neue komponentenart, mit den Daten die gefüllt wurden aus dem $row parameter
     */
    private function getkomponentenartenFromAssocArray($row)
    {
        $komponentenarten = new KomponentenArten();
        $komponentenarten->kar_id = $row["kar_id"];
        $komponentenarten->kar_bezeichnung = $row["kar_bezeichnung"];
        return $komponentenarten;
    }

    /**
     * selektiert eine einzelne Komponente
     * @param $id int die zu suchende ID
     * @return KomponentenArten|int;
     */
    public function selectKomponentenartById($id){
        $sql = "SELECT * FROM komponentenarten WHERE kar_id = $id";
        $allekomponentenarten = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($allekomponentenarten == -1){
            return -1;
        }
        return($this->getkomponentenartenFromAssocArray($allekomponentenarten[0]));
    }
}