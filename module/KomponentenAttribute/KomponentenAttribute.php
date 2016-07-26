<?php
/**
 * Created by PhpStorm.
 * User: OSF
 * Date: 26.07.2016
 * Time: 14:39
 */
require("module/baseDbAdapter.php");
class KomponentenAttributeDBAdapter extends baseDbAdapter
{

    /**
     * Diese Funktion gibt gibt alle KomponentenAttribute zurück
     * @return mixed array[Lieferant] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function selectKomponentenAttribute(){
        $sql = "SELECT * FROM KomponentenAttribute";
        $alleKomponentenAttribute = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($alleKomponentenAttribute == -1){
            return -1;
        }
        $KomponentenAttributeArray = array();
        foreach($alleKomponentenAttribute as $row){
            $lieferant = $this->getKomponentenAttributeFromAssocArray();
            $KomponentenAttributeArray[] = $lieferant;
        }
        return $KomponentenAttributeArray;
    }

    /**
     * Fügt den KomponentenAttribute hinzu
     * @param $lieferant Lieferant welcher Lieferant hinzugefügt werden soll
     */
    function insertKomponentenAttribute($KomponentenAttribute){
        $this->insert("KomponentenAttribute", $KomponentenAttribute);
    }

    /**
     * @param $KomponentenAttribute KomponentenAttribute welcher KomponentenAttribute upgedated werden soll
     */
    function updateKomponentenAttribute($KomponentenAttribute){
        unset($KomponentenAttribute->l_id);
        $this->update("KomponentenAttribute", $KomponentenAttribute, "k_id = $KomponentenAttribute->l_id");

    }

    /**
     * Löscht EINEN KomponentenAttribute
     * @param $KomponentenAttribute KomponentenAttribute zu löschender KomponentenAttribute
     */
    function deleteKomponentenAttribute($KomponentenAttribute){
        $this->delete("KomponentenAttribute", "l_id = $KomponentenAttribute->k_id");
    }

    /**
     * Holt aus dem übergebenem assoziativen Array einen KomponentenAttribute, der neu erstellt wird
     * @param $row array assoziatives Array vom Typ KomponentenAttribute
     * @return KomponentenAttribute ein neuer KomponentenAttribute, mit den Daten die gefüllt wurden aus dem $row parameter
     */
    private function getKomponentenAttributeFromAssocArray($row)
    {
        $KomponentenAttribute = new KomponentenAttribute();
        $KomponentenAttribute->k_id = $row["k_id"];
        $KomponentenAttribute->kat_id = $row["kat_id"];
        $KomponentenAttribute->kha_wert = $row["kha_wert"];
        return $KomponentenAttribute;
    }
}


?>