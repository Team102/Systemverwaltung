<?php
/**
 * Test.
 * User: Kevin
 * Date: 26.07.2016
 * Time: 10:46
 */
//require_once("module/benutzermodul/BenutzerDBAdapter.php");
require_once("database_entities/Rollen.php");
require_once("database_entities/User.php");
require_once("module/rollenmodul/RollenDBAdapter.php");
//require_once("module/loginmodul/Loginmodul.php");
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Testseite</title>
    </head>
    <body>
    <h1>Testseite</h1>

    <?php

//        $user = new User("root", "");
//        $lieferantDbAdapter = new LieferantenDBAdapter($user);
//        $lieferant = new Lieferant();
//        $lieferant->l_firmenname = "firmaname";
//        $lieferant->l_email = "email";
//        $lieferant->l_fax = "fax";
//        $lieferant->l_plz = "24552";
//        $lieferant->l_strasse = "tolle Strasse";
//        $lieferant->l_tel= "tel";
//        $lieferant->l_ort= "ort";
//        $lieferant->l_mobil= "mobil";
//        $i = $lieferantDbAdapter->insertLieferant($lieferant);
//        echo $i;
//        $alleLiefer = $lieferantDbAdapter->selectLieferanten();
//        echo count($alleLiefer);
//        var_dump($alleLiefer);
//
//
//        foreach($alleLiefer as $lieferant){
//            echo $lieferant->l_firmenname;
//        }
//
        //TODO functions hinzufügen
        $rollenCRUD = new RollenDBAdapter(null);
        $alle = $rollenCRUD->selectRollen();
        foreach ($alle as $rolle){
            echo $rolle->ro_bezeichnung;
        }
//        var_dump($alle);
//            foreach ($alle as $func){
//                echo "$func->f_bezeichnung <br/>";
//            }

    //        $benutzer = new Benutzer();
//        $benutzer->be_id = 2;
//        $benutzer->be_vorname = "Kevin";
//        $benutzer->be_nachname = "Kekule";
//        $benutzer->be_login = "Keeyzar";
//        $benutzer->be_pwd = password_hash("King", PASSWORD_DEFAULT);
//        $benutzerDBAdapter->insertBenutzer($benutzer);
//
//        $login = new Login();
//        echo $login->tryToLogIn("Keeyzar2", "King3");
//        $user = new User("root", "");
//        $lieferantenDBAdapter = new LieferantenDBAdapter($user);
//        $array = $lieferantenDBAdapter->selectLieferanten();
//        foreach($array as $lieferant) {
//            echo $lieferant->l_id . "<br/>";
//            $lieferant->l_id = 0;
//            $lieferantenDBAdapter->insertLieferant($lieferant);
//        }

    ?>
    </body>

</html>
