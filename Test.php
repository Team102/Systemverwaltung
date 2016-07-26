<?php
/**
 * Test.
 * User: Kevin
 * Date: 26.07.2016
 * Time: 10:46
 */
require("module/Lieferantenmodul/LieferantenDBAdapter.php");
require("database_entities/Lieferant.php");
require("database_entities/User.php");
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
        $lieferantenDBAdapter = new LieferantenDBAdapter($user);
        $array = $lieferantenDBAdapter->selectLieferanten();
        foreach($array as $lieferant) {
            echo $lieferant->l_id . "<br/>";
            $lieferant->l_id = 0;
            $lieferantenDBAdapter->insertLieferant($lieferant);
        }

    ?>
    </body>

</html>
