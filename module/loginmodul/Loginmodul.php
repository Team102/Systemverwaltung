<?php
require_once(__DIR__ . "/../benutzermodul/BenutzerDBAdapter.php");
require_once(__DIR__ . "/../../database_entities/User.php");
session_start();
$benutzer = tryToLogIn($_POST["benutzer"], $_POST["passwort"]);

//wenn Benutzer zurückkommt, dann ist er angemeldet, ansonsten gab es einen Fehler
if(@$benutzer instanceof Benutzer){
    $_SESSION["Benutzer"] = $benutzer;
    header('Location: /index.php');
    die();
} else {
    if($benutzer == -1){
        $_SESSION["loginErrorMessage"] = "Der Benutzername existiert nicht.";
    } else {
        $_SESSION["loginErrorMessage"] = "Das Passwort ist falsch";
    }
    header("Location: /login.php");
    die();
}

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
    $dbAdapter = new BenutzerDBAdapter(null);
    $benutzer = $dbAdapter->selectBenutzerByName($username);
    if(is_null($benutzer)) return -1;
    //überprüft das übergebene Passwort gegen den in der Datenbank enthaltenen Hashwert
    if(password_verify($password, substr($benutzer->be_pwd, 0, 60))){
        return $benutzer;
    } else {
        return -2;
    }
}