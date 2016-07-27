<?php
require_once "../header.php";
?>
<main>
    <div class="container">
        <div class="spacer"></div>
        <div class="headline">
            <h2>Gerät suchen</h2>
        </div>
        <hr class="trenner">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <!-- Form um zu suchen. Felder müssen Dynamisch nach Komponentenart und Attributen kommen -->
                <form method="post" action="../Reporting/Suchen.php">
                    <fieldset class="form-group">
                        <label for="id">ID</label>
                        <input type="number" name="id" class="form-control" id="id" placeholder="">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="hersteller">Hersteller</label>
                        <input type="text" name="hersteller" class="form-control" id="hersteller" placeholder="">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="cpu">CPU</label>
                        <input type="text" name="cpu" class="form-control" id="cpu" placeholder="">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="ram">RAM</label>
                        <input type="text" name="ram" class="form-control" id="ram" placeholder="">
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Abschicken</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
require_once "../footer.php";
?>
