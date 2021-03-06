<?php

/**
 * Dieses Modul ist das CRUD(Create read update delete) Modul für alle Rollen bezogenen Informationen.
 * User: Kevin
 * Date: 26.07.2016
 * Time: 13:35
 */

require_once(__DIR__ . "/../baseDbAdapter.php");
require_once(__DIR__ . "/../Komponentenmodul/komponentenDbAdapter.php");
require_once(__DIR__ . "/../baseDbAdapter.php");
require_once(__DIR__ . "/../../database_entities/komponente.php");
require_once(__DIR__ . "/../../database_entities/Benutzer.php");
class BenutzerDBAdapter extends baseDbAdapter
{

    function __construct($user)
    {
        parent::__construct($user);
    }

    /**
    * Diese Funktion gibt gibt alle Benutzer zurück
    * @return mixed array[Benutzer] oder einer der folgenden Fehlercodes
    * -1 = Fehler beim ausführen des SQL
    */
    function selectBenutzer(){
        $sql = "SELECT * FROM benutzer";
        $alleBenutzer = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        if($alleBenutzer == -1){
            return -1;
        }
        $benutzerArray = array();
        foreach($alleBenutzer as $row){
            $benutzerArray[] = $this->getBenutzerFromAssocArray($row);
        }
        return $benutzerArray;
    }

    /**
     * Holt einen einzigen Benutzer zurück aus der Datenbank.
     * @param $username String der zu suchende Username
     * @return Benutzer der gefundene Benutzer wird zurück gegeben.
     */
    function selectBenutzerByName($username){
        $username = "'$username'";
        $sql = "SELECT * FROM benutzer WHERE be_login = $username";
        $alleBenutzer = $this->execSQL($sql);
        $benutzerArray = array();
        foreach($alleBenutzer as $row){
            $benutzerArray[] = $this->getBenutzerFromAssocArray($row);
        }

        //falls keiner gefunden wird, dann kommt hier ein info die soll
        //unterdrückt werden
        return @$benutzerArray[0];
    }

    /**
     * Fügt den Benutzer hinzu aber hasht vorher das passwort
     * @param $benutzer Benutzer welche Benutzer hinzugefügt werden soll
     * @return int ID von dem eingefügten benutzer
     */
    function insertBenutzer($benutzer){
        $benutzer->be_pwd = password_hash($benutzer->be_pwd, PASSWORD_DEFAULT);
        return $this->insert("benutzer", $benutzer);
    }

    /**
     * Fügt alle Benutzer hinzu
     * @param $benutzerArray array von Benutzer, die hinzugefügt werden sollen
     */
    function insertMulBenutzer($benutzerArray){
        foreach($benutzerArray as $benutzer){
            $this->insertBenutzer($benutzer);
        }
    }

    /**
     * @param $benutzer Benutzer welcher Benutzer upgedated werden soll
     */
    function updateBenutzer($benutzer){
        $benutzerId = $benutzer->be_id;
        unset($benutzer->be_id);

        //überprüfen ob das PW geändert wurde -- gegen die DB prüfen
        $pwEqual = $benutzer->be_pwd == $this->selectBenutzerByName("$benutzer->be_login")->be_pwd;
        if(!$pwEqual){
            //wenn nicht equal, dann hat sich das PW geändert!
            $benutzer->be_pwd = password_hash($benutzer->be_pwd, PASSWORD_DEFAULT);
        }

        $this->update("benutzer", $benutzer, "be_id = $benutzerId");
        $benutzer->be_id = $benutzerId;

    }

    /**
     * Löscht EINEN Benutzer
     * @param $benutzer Benutzer zu löschende Benutzer
     */
    function deleteBenutzer($benutzer){
        $this->delete("benutzer", "be_id = $benutzer->be_id");
    }

    /**
     * Löscht alle Benutzer
     * @param $benutzerArray array von Benutzern
     */
    function deleteMulBenutzer($benutzerArray){
        foreach($benutzerArray as $benutzer){
            $this->deleteBenutzer($benutzer);
        }
    }

    /**
     * Holt aus dem übergebenem assoziativen Array einen Benutzer, die neu erstellt wird
     * @param $row array assoziatives Array vom Typ Benutzer
     * @return Benutzer ein neuer Benutzer, mit den Daten die gefüllt wurden aus dem $row parameter
     */
    private function getBenutzerFromAssocArray($row)
    {
        $rolle = new Benutzer();
        $rolle->be_id = $row["be_id"];
        $rolle->be_vorname = $row["be_vorname"];
        $rolle->be_nachname = $row["be_nachname"];
        $rolle->be_login = $row["be_login"];
        $rolle->be_pwd = $row["be_pwd"];
        $rolle->be_rechte = $row["be_rechte"];
        return $rolle;
    }
}