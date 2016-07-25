<?php
/**
 * Das ist die Hauptfunktionsklasse, diese hat alle nötigen Funktionen.
 * Zuerst muss man die init Funktion aufrufen, damit alle gebrauchten Module via require geladen werden.
 * Gefolgt von den jeweiligen Methoden die man nutzen möchte
 * User: Kevin
 * Date: 25.07.2016
 * Time: 11:35
 */

define("cLieferant",        "1");
define("cRaum",             "2");
define("cBenutzer",         "3");
define("cKompArt",          "4");
define("cKompArtAttr",      "5");

/**
 * Diese Funktion fügt je nach ausgewählten Typ die Daten in die Datebank.
 *
 * @param $welcheArt int Konstanten sind:
 *        cLieferant, cRaum, cBenutzer, cKompArt, cKompArtAttr.
 * @param $DatenbankEntity welches Datenbankentity
 * @return int 0 --> Erfolg
 * 0 --> Erfolg
 * 1 --> verwendete Konstante als erster Parameter nicht zulässlig
 * 2 --> Das assoziative Array darf nicht null sein
 * 3 --> Die Daten aus dem Array sind NICHT ausreichend für den Insert.
 * Für weitere Informationen bei Felix melden
 * 4 --> Die verwendeten Datentypen aus dem Array stimmen nicht
 * mit den Datentypen der Datenbank überein. Für weitere Informationen bei
 * Felix melden
 * 5 --> Autoriesierung fehlgeschlagen. Der Nutzer ist nicht berechtigt diesen Vorgang
 * auszuführen
 * 6 --> Unbekannter Fehler. Dieser kann TODO
 * @internal param array $dataArray Array das übergeben wird ist ein assoziatives Array, in denen alle
 * Felder die als not Null definiert sind eingetragen werden müssen.
 */
function db_insert($welcheArt, $DatenbankEntity){
    if(is_null($dataArray)) return 2;
    switch ($welcheArt){
        case cLieferant:
            break;
        case cRaum:
            break;
        case cBenutzer:
            break;
        case cKompArt:
            break;
        case cKompArtAttr:
            break;
        default:
            return 1;
    }
}

/**
 * Fügt je nach ausgewählter Art die Daten in die Datenbank
 * @param $welcheArt int definierte Konstante
 *        cLieferant, cRaum, cBenutzer, cKompArt, cKompArtAttr.
 * @param $datenTyp DatenbankEntity welcher Datenbanktyp not Null
 * @return int
 *         0 --> Erfolgreich
 *         1 --> TYP konstante existiert nicht
 *         2 --> $datenTyp darf nicht null sein
 *         3 --> User ist nicht authorisiert
 *         4 --> unbekannter Fehler TODO
 */
function db_update($welcheArt, $datenTyp){
    if(is_null($datenTyp)) return 2;
    switch ($welcheArt){
        case cLieferant:
            break;
        case cRaum:
            break;
        case cBenutzer:
            break;
        case cKompArt:
            break;
        case cKompArtAttr:
            break;
        default:
            return 1;
    }

}

/**
 * entfernt einen Datenbankeintrag
 * @param $welcheArt int definierte Konstante sind:
 *        cLieferant, cRaum, cBenutzer, cKompArt, cKompArtAttr.
 * @param $datenTyp DatenbankEntity welches Datenbankentity not null
 * @return int status des Ablaufs:
 *          0 --> Erfolgreich
 *          1 --> Typ Konstante existiert nicht
 *          2 --> der $datenTyp darf nicht null sein
 *          3 --> User ist nicht autorisiert für diesen Vorgang
 *          4 --> Unbekannter Fehler TODO
 */
function db_delete($welcheArt, $datenTyp){
    if(is_null($datenTyp)) return 2;
    switch ($welcheArt){
        case cLieferant:
            break;
        case cRaum:
            break;
        case cBenutzer:
            break;
        case cKompArt:
            break;
        case cKompArtAttr:
            break;
        default:
            return 1;
    }
}

?>