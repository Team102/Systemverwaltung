<?php

/**
 * Dieses Modul ist das CRUD(Create read update delete) Modul für alle Rollen bezogenen Informationen.
 * User: Kevin
 * Date: 26.07.2016
 * Time: 13:17
 */
require_once("module/baseDbAdapter.php");
require_once("database_entities/Rollen.php");

class RollenDBAdapter extends baseDbAdapter
{
    /**
     * Diese Funktion gibt gibt alle Rollen zurück
     * @return mixed array[Rolle] oder einer der folgenden Fehlercodes
     * -1 = Fehler beim ausführen des SQL
     */
    function selectRollen(){
        $sql = "SELECT * FROM rollen";
        $alleRollen = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($alleRollen == -1){
            return -1;
        }
        $rollenArray = array();
        foreach($alleRollen as $row){
            $rollenArray[] = $this->getRolleFromAssocArray($row);
        }
        return $rollenArray;
    }

    /**
     * Fügt die Rolle hinzu
     * @param $rolle Rolle welche Rolle hinzugefügt werden soll
     */
    function insertRolle($rolle){
        $this->insert("rollen", $rolle);
    }

    /**
     * Fügt alle Rollen hinzu
     * @param $rollenArray array von Rollen, die hinzugefügt werden sollen
     */
    function insertRollen($rollenArray){
        foreach($rollenArray as $rolle){
            $this->insertRolle($rolle);
        }
    }

    /**
     * @param $rolle Rollen welcher Lieferant upgedated werden soll
     */
    function updateRolle($rolle){
        $rollenId = $rolle->ro_id;
        unset($rolle->ro_id);
        $this->update("rollen", $rolle, "ro_id = $rollenId");

    }

    /**
     * Löscht EINEN raum
     * @param $rolle Rollen zu löschende Rolle
     */
    function deleteRolle($rolle){
        $this->delete("rollen", "ro_id = $rolle->ro_id");
    }

    /**
     * Löscht alle Rollen
     * @param $rollenArray array von ROllen
     */
    function deleteRollen($rollenArray){
        foreach($rollenArray as $rolle){
            $this->deleteRolle($rolle);
        }
    }

    /**
     * Holt aus dem übergebenem assoziativen Array eine Rolle, die neu erstellt wird
     * @param $row array assoziatives Array vom Typ Rolle
     * @return Rollen ein neuer Raum, mit den Daten die gefüllt wurden aus dem $row parameter
     */
    private function getRolleFromAssocArray($row)
    {
        $rolle = new Rollen();
        $rolle->ro_id = $row["ro_id"];
        $rolle->ro_bezeichnung = $row["ro_bezeichnung"];
        $rolle->ro_wert = $row["ro_notiz"];
        return $rolle;
    }
}