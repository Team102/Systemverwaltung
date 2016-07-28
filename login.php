<?php
require_once "header.php";
require_once "database_entities/Benutzer.php";
@@session_start();
if(@$_SESSION["Benutzer"] instanceof Benutzer) {
    $istAngemeldet = true;
}
?>
    <main>
        <div class="container">
            <div class="spacer"></div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login">
                        <div class="headline">
                            <h2>Login</h2>
                        </div>
                        <?php if(!$istAngemeldet):?>
                        <label style="color:red;"><?php echo @$_SESSION["loginErrorMessage"]; unset($_SESSION["loginErrorMessage"]);?></label>
                            <!--                            TODO style in css auslagern-->
                        <form action="/module/loginmodul/Loginmodul.php/" method="post" name="loginform">
                            <fieldset class="form-group">
                                <input type="text" class="form-control" name="benutzer" placeholder="Benutzername eingeben">
                            </fieldset>
                            <fieldset class="form-group">
                                <input type="password" class="form-control" name="passwort" placeholder="Passwort">
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="login-submit">Submit</button>
                        </form>
                        <?php else: ?>
                            <label style="color:white;">Sie sind bereits angemeldet.</label>
<!--                            TODO style in css auslagern-->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
require_once "footer.php";
?>