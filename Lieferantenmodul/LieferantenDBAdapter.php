<?php

/**
 * Der Datenbankadapter für die Lieferanten
 * User: Keeyzar
 * Date: 25.07.2016
 * Time: 22:19
 */
class LieferantenDBAdapter extends baseDbAdapter
{

    /**
     * Diese Funktion gibt gibt alle Lieferanten zurück
     * @return array[Lieferant];
     */
    function selectLieferanten(){
        $this->dbConnect();

        $sql = "SELECT * FROM lieferanten";
        $alleLieferanten = $this->execSQL($sql);
        //TODO erfragen wie ich an den error komme
        $lieferantenArray = array();
        foreach($alleLieferanten as $row){
            $lieferant = $this->getLieferantFromAssocArray($row);
            $lieferantenArray[] = $lieferant;
        }
        return $lieferantenArray;
    }

    /**
     * Selektiert Lieferanten anhand der übergebenen Condition
     */
    function selectLieferantenByCondition(){
        $this->dbConnect();
        $condition;
        $sql = "SELECT * FROM lieferanten WHERE $condition";
        $parameter;
        $alleLieferanten = $this->execSQLParameters($sql, $parameter);
    }

    /**
     * Fügt den Lieferanten hinzu
     * @param $lieferant Lieferant welcher Lieferant hinzugefügt werden soll
     */
    function insertLieferant($lieferant){
        $this->dbConnect();
    }

    /**
     * Fügt alle Lieferanten hinzu
     * @param $lieferantenArray array von Lieferanten, die hinzugefügt werden sollen
     */
    function insertLieferanten($lieferantenArray){
        $this->dbConnect();
        foreach($lieferantenArray as $lieferant){
            $this->insertLieferant($lieferant);
        }
    }

    /**
     * @param $lieferant Lieferant welcher Lieferant upgedated werden soll
     */
    function updateLieferant($lieferant){
        $this->dbConnect();
        $lieferantParameter = array();

        $lieferantParameter["l_id"] = $lieferant->l_id;
        $lieferantParameter["l_firmenname"] = $lieferant->l_firmenname;
        $lieferantParameter["l_strasse"] = $lieferant->l_strasse;
        $lieferantParameter["l_plz"] = $lieferant->l_plz;
        $lieferantParameter["l_ort"] = $lieferant->l_ort;
        $lieferantParameter["l_tel"] = $lieferant->l_tel;
        $lieferantParameter["l_mobil"] = $lieferant->l_mobil;
        $lieferantParameter["l_fax"] = $lieferant->l_fax;
        $lieferantParameter["l_email"] = $lieferant->l_email;

        $this->update("lieferant", $lieferantParameter, "l_id = $lieferant->l_id");

    }

    /**
     * Löscht EINEN lieferanten
     * @param $lieferant Lieferant zu löschender Lieferant
     */
    function deleteLieferant($lieferant){
        $this->dbConnect();
        $this->delete("lieferant", "l_id = $lieferant->l_id");
        //TODO erfragen wegen message
    }

    /**
     * Löscht alle Lieferanten
     * @param $lieferantenArray array von Lieferanten
     */
    function deleteLieferanten($lieferantenArray){
        foreach($lieferantenArray as $lieferant){
            $this->deleteLieferant($lieferant);
        }
    }

    /**
     * Holt aus dem übergebenem assoziativen Array einen Lieferanten, der neu erstellt wird
     * @param $row array assoziatives Array vom Typ lieferant
     * @return Lieferant ein neuer Lieferant, mit den Daten die gefüllt wurden aus dem $row parameter
     */
    private function getLieferantFromAssocArray($row)
    {
        $lieferant = new Lieferant();
        $lieferant->l_id = $row["id"];
        $lieferant->l_firmenname = $row["l_firmenname"];
        $lieferant->l_strasse = $row["l_strasse"];
        $lieferant->l_plz = $row["l_plz"];
        $lieferant->l_ort = $row["l_ort"];
        $lieferant->l_tel = $row["l_tel"];
        $lieferant->l_mobil = $row["l_mobil"];
        $lieferant->l_fax = $row["l_fax"];
        $lieferant->l_email = $row["l_email"];
        return $lieferant;
    }
}