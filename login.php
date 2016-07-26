<?php
//require_once "header.php";
?>
<main>
    <div class="container">

        <?php
        //TODO erfragen wie die sich das vorgestellt haben:
        //folgendes ist relevant. Wohin verlinkt der submit button, auf welche Page?
        //außerdem, wo rein muss das anmelde zeug gepackt werden, hier direkt rein?
        //doof nur, wenn die halbe Page, also der Header schon geladen hat, und dann erst überprüft
        //wird ob da eine Anmeldung stattgefunden hat, und wenn z.B. ein Fehler passiert
        //der User einfach weiter geleitet wird zu einer anderen Page, dann wird der Header gleich nochmal
        //geladen. Mann könnte jedoch auch bei dem login diff anzeigen, ob z.B. der User nicht existiert
        //oder das Passwort falsch geladen ist. DAnn müssen wir aber nochmal mit Frontend sprechen
        //und denen sagen, die sollen da 'nen schönes hidden error label einpflastern.


//            require_once("database_entities/Benutzer.php");
//            session_start();
//            $benutzer = new Benutzer();
//            $_SESSION["BENUTZER"] = $benutzer; test, not deleten
            $benutzer = $_SESSION["BENUTZER"];
        //alternative synstax für if(){} -- Ist lesbarer meiner Ansicht nach
        if(is_null($benutzer)):
        ?>
        <div class="spacer"></div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login">
                    <div class="headline">
                        <h2>Login</h2>
                    </div>
                    <form action="login.php" method="POST">
                        <fieldset class="form-group">
                            <input type="text" class="form-control" id="benutzer" placeholder="Benutzername eingeben">
                        </fieldset>
                        <fieldset class="form-group">
                            <input type="password" class="form-control" id="passwort" placeholder="Passwort">
                        </fieldset>
                        <button type="submit" class="btn btn-primary" name="login-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
            <div>
                <h1>ANGEMELDET!</h1>
            </div>
    <?php endif ?>
</main>
<?php
require_once "footer.php";
?>