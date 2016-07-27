<!-- Include Header -->
<?php
require_once '../header.php';
require_once "../database_entities/Benutzer.php";
require_once "../database_entities/Lieferant.php";
require_once "../module/Lieferantenmodul/LieferantenDBAdapter.php";
session_start();
?>
    <main>
        <div class="container">
            <div class="spacer"></div>
            <div class="headline">
                <h2>Ausmusterung</h2>
            </div>
            <hr class="trenner">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h3 id="hinzu">Gerät ausmustern</h3>
                    <!-- Form um nach Räumen zu suchen -->
                    <form method="post" action="../Produktpflege/Ausmusterung.php">
                      <fieldset class="form-group">
                        <label for="raum">Raum auswählen</label>
                        <select class="form-control" name="raum" id="raum">
                          <!-- Repeat für alle Räume -->
                          <option value="">ID - Raum</option>
                        </select>
                      </fieldset>
                      <!-- Kann mit beliebigen Formfeldern erweitert werden -->
                      <button type="submit" class="btn btn-primary" name="raumsenden">Geräte Anzeigen</button>
                    </form>
                    <div class="spacer"></div>
                    <!-- Form um Produkte auszumustern --> 
                    <form method="post" action="../Produktpflege/Ausmusterung.php">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox"> ID - Gerätname - Attribut
                      </label>
                      <br />
                      <label>
                        <input type="checkbox"> ID - Gerätname - Attribut
                      </label>
                      <br />
                      <label>
                        <input type="checkbox"> ID - Gerätname - Attribut
                      </label>
                      <br />
                      <label>
                        <input type="checkbox"> ID - Gerätname - Attribut
                      </label>
                      <br />
                      <label>
                        <input type="checkbox"> ID - Gerätname - Attribut
                      </label>
                      <br />
                    </div>
                    <button type="submit" class="btn btn-primary" name="ausmustern">Geräte Ausmustern</button>
                    </form>
                  </div>
                </div>
            </div>
    </main>
<?php
require_once "../footer.php";
?>
