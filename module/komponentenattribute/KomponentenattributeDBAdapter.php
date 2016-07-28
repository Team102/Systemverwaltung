<?php

/**
 * Der Datenbankadapter für die Lieferanten
 * User: Fadi Koch
 * Date: 25.07.2016
 * Time: 14:08
 */
require_once(__DIR__ . "/../baseDbAdapter.php");
require_once(__DIR__ . "/../../database_entities/KomponentenAttribute.php");
class KomponentenAttributeDBAdapter extends baseDbAdapter
{

    /**
     * Diese Funktion gibt alle KomponentenAttribute zurück
     * @return mixed array[KomponentenAttrbibute] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function selectKomponentenAttribute(){
        $sql = "SELECT * FROM komponentenattribute";
        $alleKomponentenAttribute = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($alleKomponentenAttribute == -1){
            return -1;
        }
        $KomponentenAttributeArray = array();
        foreach($alleKomponentenAttribute as $row){
            $komponentenattribute = $this->getKomponentenAttributeFromAssocArray($row);
            $KomponentenAttributeArray[] = $komponentenattribute;
        }
        return $KomponentenAttributeArray;
    }

    /**
     * Diese Funktion gibt alle KomponentenAttribute der ID zurück
     * @return mixed array[KomponentenAttrbibute] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function selectKomponentenAttributeFormID( $kat_id ){
        $sql ="SELECT * FROM komponentenattribute WHERE kat_id = " . $kat_id;
        $alleAttributeDerKomponente = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        echo bla;
        if($alleAttributeDerKomponente == -1){
            return -1;
        }
        $KomponentenAttributeArray = array();
        foreach($alleAttributeDerKomponente as $row){
            $komponentenattribute = $this->getKomponentenAttributeFromAssocArray($row);
            $KomponentenAttributeArray[] = $komponentenattribute;
        }
        return $KomponentenAttributeArray;
    }


    /**
     * Fügt den KomponentenAttribute hinzu
     * @param $komponentenattribut KomponentenAttribute welches KompAttribut hinzugefügt werden soll
     */
    function insertKomponentenAttribute($KomponentenAttribute){
        $this->insert("komponentenattribute", $KomponentenAttribute);
    }

    /**
     * updated das übergebene Komponentenattribut
     * @param $komponentenAttribute KomponentenAttribute welcher KomponentenAttribute upgedated werden soll
     */
    function updateKomponentenAttribute($komponentenAttribute){
        $kat_id = $komponentenAttribute->kat_id;
        unset($komponentenAttribute->kat_id);
        $this->update("komponentenattribute", $komponentenAttribute, "kat_id = $kat_id");

    }

    /**
     * Löscht EIN KomponentenAttribut
     * @param $KomponentenAttribute KomponentenAttribute zu löschender KomponentenAttribute
     */
    function deleteKomponentenAttribute($KomponentenAttribute){
        $this->delete("KomponentenAttribute", "kat_id = $KomponentenAttribute->kat_id");
    }

    /**
     * Holt aus dem übergebenem assoziativen Array einen KomponentenAttribute, der neu erstellt wird
     * @param $row array assoziatives Array vom Typ KomponentenAttribute
     * @return KomponentenAttribute ein neuer KomponentenAttribute, mit den Daten die gefüllt wurden aus dem $row parameter
     */
    private function getKomponentenAttributeFromAssocArray($row)
    {
        $KomponentenAttribute = new KomponentenAttribute();
        $KomponentenAttribute->kat_id = $row["kat_id"];
        $KomponentenAttribute->kat_bezeichnung = $row["kat_bezeichnung"];
        return $KomponentenAttribute;
    }
}