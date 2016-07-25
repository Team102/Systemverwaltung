<?php

/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 25.07.2016
 * Time: 13:25
 */
class User
{
    static private $username = "developer";
    static private $password = "1234";


    /**
     * Erstellt einen User mit dem username und password
     * @param $username string der Username
     * @param $password string dass passwort
     * @return mixed
     */
    static public function User($username, $password){
//        $this->username = $username;
//        $this->password = $password;
    }

    /**
     * Verbindet sich mit der Datenbank und wählt die Datenbank itv aus
     * @return mixed int 0 bei Erfolg String bei Misserfolg
     */
    static function dbConnect(){
        User::$dbConnection = mysqli_connect(User::$serverUrl, User::$username, User::$password);
        if(is_null(User::$dbConnection)){
            return "Es konnte keine Verbindung hergestellt werden Grund: " . mysqli_connect_error();
        }
        if(!mysqli_select_db(User::$dbConnection, "itv")){
            return "Die Datenbank 'itv' konnte nicht ausgewählt werden!";
        }
        return 0;
    }

    /**
     * Schließt die Datenbank, falls eine geöffnete Verbindung vorhanden ist.
     */
    static function dbClose(){
        if(!is_null(User::$dbConnection)){
            mysqli_close(User::$dbConnection);
        }
    }

    /**
     * @return bool if connected  or not
     */
    static function isConnected(){
        return !is_null(User::$dbConnection);
    }



}