<?php
/**
 * Test.
 * User: Kevin
 * Date: 26.07.2016
 * Time: 10:46
 */
require_once("module/benutzermodul/BenutzerDBAdapter.php");
require_once("database_entities/Benutzer.php");
require_once("database_entities/User.php");
require_once("module/loginmodul/Login.php");
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Testseite</title>
    </head>
    <body>
    <h1>Testseite</h1>

    <?php

        $user = new User("root", "");
        $benutzerDBAdapter = new BenutzerDBAdapter($user);
//        $benutzer = new Benutzer();
//        $benutzer->be_id = 2;
//        $benutzer->be_vorname = "Kevin";
//        $benutzer->be_nachname = "Kekule";
//        $benutzer->be_login = "Keeyzar2";
//        $benutzer->be_pwd = password_hash("King", PASSWORD_DEFAULT);
//        $benutzerDBAdapter->insertBenutzer($benutzer);

        $login = new Login();
        echo $login->tryToLogIn("Keeyzar2", "King3");
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
