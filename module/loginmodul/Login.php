<?php

/**
 * Kümmert sich um den Login.
 * User: Kevin
 * Date: 26.07.2016
 * Time: 14:08
 */
require_once("module/benutzermodul/BenutzerDBAdapter.php");
class Login
{
    /**
     * Versucht den Nutzer anzumelden, es wird das passwort gehasht und gegen den Hash
     * aus der Datenbank abgeglichen, wenn Sie gleich sind.
     * @param $username String welcher Nutzername
     * @param $password String welches Passwort
     * @return mixed wenn erfolgreich Benutzer ansonsten:
     * -1 = benutzername nicht gefunden
     * -2 = passwort falsch
     */
    function tryToLogIn($username, $password){
        //loginuser ist ein select ONly user auf der Datenbank um die benutzer anzuzeigen
//        $user = new User("loginuser", "");
        $user = new User("root", ""); //TODO entfernen;
        $dbAdapter = new BenutzerDBAdapter($user);
        $benutzer = $dbAdapter->selectBenutzerByName($username);
        if(is_null($benutzer)) return -1;
        //überprüft das übergebene Passwort gegen den in der Datenbank enthaltenen Hashwert
        echo $benutzer->be_pwd . "<br/>";
//        $hash = password_hash("King", PASSWORD_DEFAULT);
//        if(password_verify("King", $hash)){
//            echo "NICE";
//        } else {
//            echo "NOT NICE";
//        }

        if(password_verify($password, substr($benutzer->be_pwd, 0, 60))){
            return $benutzer;
        } else {
            return -2;
        }
    }
}