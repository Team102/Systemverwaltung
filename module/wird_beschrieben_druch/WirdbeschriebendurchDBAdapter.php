<?php

/**
 * Der Datenbankadapter für die Tabelle Wird_Beschrieben_Durch
 * User: Fadi Koch
 * Date: 25.07.2016
 * Time: 13:37
 */
require_once(__DIR__ . "/../baseDbAdapter.php");
require_once(__DIR__ . "/../../database_entities/Wird_Beschrieben_Durch.php");
class WirdbeschriebendurchDBAdapter extends baseDbAdapter
{

    /**
     * Diese Funktion gibt gibt alle Entitys der Datenbnak zurück
     * @return mixed array[Wird_Beschrieben_Durch] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function wirdBeschriebenDurch(){
        $sql = "SELECT * FROM wird_beschrieben_durch";
        $allewirdBeschriebenDurch = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($allewirdBeschriebenDurch == -1){
            return -1;
        }
        $wirdBeschriebenDurchArray = array();
        foreach($allewirdBeschriebenDurch as $row){
            $wirdBeschriebenDurch = $this->getwirdBeschriebenDurchFromAssocArray($row);
            $wirdBeschriebenDurchArray[] = $wirdBeschriebenDurch;
        }
        return $wirdBeschriebenDurchArray;
    }

    /**
     * Fügt das Entity hinzu hinzu
     * @param $wirdBeschriebenDurch Wird_Beschrieben_Durch welches entity der DB hinzugefügt werden soll
     */
    function insertwirdBeschriebenDurch($wirdBeschriebenDurch){
        $this->insert("wird_beschrieben_durch", $wirdBeschriebenDurch);
    }

   /**
     * @param $wirdBeschriebenDurch Wird_Beschrieben_Durch welches Entity upgedated werden soll
     */
    function updatewirdBeschriebenDurch($wirdBeschriebenDurch){
        $kar_id = $wirdBeschriebenDurch->kar_id;
        $kat_id = $wirdBeschriebenDurch->kat_id;
        unset($wirdBeschriebenDurch->kar_id);
        unset($wirdBeschriebenDurch->kat_id);
        $this->update("wird_beschrieben_durch", $wirdBeschriebenDurch, "kar_id = $kar_id AND kat_id = $kat_id");

    }

    /**
     * Löscht EIN Entity
     * @param $wirdBeschriebenDurch Wird_Beschrieben_Durch zu löschendes Entity
     */
    function deletewirdBeschriebenDurch($wirdBeschriebenDurch){
        $this->delete("wird_beschrieben_durch", "kar_id = $wirdBeschriebenDurch->kar_id AND kat_id = $wirdBeschriebenDurch->kat_id");
    }

     /**
     * Holt aus dem übergebenem assoziativen Array eine Entity, der neu erstellt wird
     * @param $row array assoziatives Array vom Typ Wird_Beschrieben_Durch
     * @return Wird_Beschrieben_Durch ein neues Entity, mit den Daten die gefüllt wurden aus dem $row parameter
     */
    private function getwirdBeschriebenDurchFromAssocArray($row)
    {
        $wirdBeschriebenDurch = new Wird_Beschrieben_Durch();
        $wirdBeschriebenDurch->kar_id = $row["kar_id"];
        $wirdBeschriebenDurch->kat_id = $row["kat_id"];

        return $wirdBeschriebenDurch;
    }

    /**
     * Diese Funktion gibt alle KomponentenAttribute der ID zurück
     * @return mixed array[KomponentenAttrbibute] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function selectKomponentenAttributeFormID( $kar_id ){
        $sql ="SELECT * FROM Wird_Beschrieben_Durch WHERE kar_id = " . $kar_id;
        $alleAttributeDerKomponente = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        echo bla;
        if($alleAttributeDerKomponente == -1){
            return -1;
        }
        $KomponentenAttributeArray = array();
        foreach($alleAttributeDerKomponente as $row){
            $komponentenattribute = $this->getwirdBeschriebenDurchFromAssocArray($row);
            $KomponentenAttributeArray[] = $komponentenattribute;
        }
        return $KomponentenAttributeArray;
    }
}