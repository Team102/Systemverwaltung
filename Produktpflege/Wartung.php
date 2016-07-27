<?php
require_once "../header.php";
?>
<main>
    <div class="container">
        <div class="spacer"></div>
        <div class="headline">
            <h2>Wartung</h2>
        </div>
        <hr class="trenner">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3 id="hinzu">Gerät Warten</h3>
                <!-- Form um Räume zu suchen -->
                <form method="post" action="../Produktpflege/Wartung.php">
                  <fieldset class="form-group">
                    <label for="raum">Raum auswählen</label>
                    <select class="form-control" name="raum" id="raum">
                      <!-- Repeat für alle Räume -->
                      <option value="">ID - Raum</option>
                    </select>
                  </fieldset>
                  <button type="submit" class="btn btn-primary" name="raumsenden">Geräte Anzeigen</button>
                </form>
                <div class="spacer"></div>
                <!-- Form für Wartung von Geräten -->
                <!-- Felder können verändert werden -->
                <form method="post" action="../Produktpflege/Wartung.php">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox"> ID - Gerätname - Attribut
                  </label>
                  <label for="date">Datum der Wartung</label>
                  <input type="date" name="" id="date">
                  <br />
                  <label>
                    <input type="checkbox"> ID - Gerätname - Attribut
                  </label>
                  <label for="date">Datum der Wartung</label>
                  <input type="date" name="" id="date">
                  <br />
                  <label>
                    <input type="checkbox"> ID - Gerätname - Attribut
                  </label>
                  <label for="date">Datum der Wartung</label>
                  <input type="date" name="" id="date">
                  <br />
                  <label>
                    <input type="checkbox"> ID - Gerätname - Attribut
                  </label>
                  <label for="date">Datum der Wartung</label>
                  <input type="date" name="" id="date">
                  <br />
                  <label>
                    <input type="checkbox"> ID - Gerätname - Attribut
                  </label>
                  <label for="date">Datum der Wartung</label>
                  <input type="date" name="" id="date">
                  <br />
                </div>
                <button type="submit" class="btn btn-primary" name="warten">Geräte Warten</button>
                </form>
              </div>
            </div>
    </div>
</main>
<?php
require_once "../footer.php";
?>
