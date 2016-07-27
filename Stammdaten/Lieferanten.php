<!-- Include Header -->
<?php
require_once '../header.php';
?>
<!-- Hauptseite -->
  <main>
    <!-- Container Wrapper -->
      <div class="container">
        <!-- Abstand (50px nach oben) -->
          <div class="spacer"></div>
          <!-- Überschrift der Seite -->
          <div class="headline">
              <h3>Lieferantenverwaltung</h3>
              <!-- Sprungmarkennavigation -->
              <p><a class="nav-link" href="#hinzu">Hinzufügen</a> // <a class="nav-link" href="#aend">Ändern</a> // <a class="nav-link" href="#del">Löschen</a></p>
          </div>
          <!-- Trennlinie -->
          <!-- Hier eventuell Rechtemäßig abfragen und Ein, oder Ausbleden lassen -->


          <?php
          //hinzufuegen PHP
          if(isset($_POST["btnHinzu"])){

          }
          ?>
          <hr class="trenner">
                <div class="row">
                  <!-- Mittig Zentriert -->
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Lieferant hinzufügen</h3>
                        <!-- Formular um Lieferanten hinzuzufügen -->
                        <!-- Bitte bei allen Formularfeldern den Namen für euch anpassen. -->
                        <form method="post" action="../Stammdaten/Lieferanten.php">
                          <!-- ID Feld auf Disabled gestellt um keinen Input zuzulassen -->
                          <fieldset class="form-group">
                            <label for="id">ID</label>
                            <input type="number" name="id" class="form-control" id="id" placeholder="" disabled>
                          </fieldset>
                          <!-- Input für Firmenname -->
                            <fieldset class="form-group">
                              <label for="firmenname">Firmenname</label>
                              <input type="text" name="" class="form-control" id="firmenname" required>
                            </fieldset>
                            <!-- Input für Straße -->
                            <fieldset class="form-group">
                              <label for="strasse">Straße</label>
                              <input type="text" name="" class="form-control" id="strasse" required>
                            </fieldset>
                            <!-- Input für Postleitzahl -->
                            <fieldset class="form-group">
                              <label for="plz">Postleitzahl</label>
                              <input type="number" name="" class="form-control" id="plz" required>
                            </fieldset>
                            <!-- Input für Ort -->
                            <fieldset class="form-group">
                              <label for="ort">Ort</label>
                              <input type="text" name="" class="form-control" id="ort" required>
                            </fieldset>
                            <!-- Input für Telefonnummer -->
                            <fieldset class="form-group">
                              <label for="tel">Telefonnummer</label>
                              <input type="text" name="" class="form-control" id="tel" required>
                            </fieldset>
                            <!-- Input für Mobilnummer -->
                            <fieldset class="form-group">
                              <label for="mobil">Mobilnummer</label>
                              <input type="text" name="" class="form-control" id="mobil" required>
                            </fieldset>
                            <!-- Input für Faxnummer -->
                            <fieldset class="form-group">
                              <label for="fax">Faxnummer</label>
                              <input type="text" name="" class="form-control" id="fax" required>
                            </fieldset>
                            <!-- Input für EMail Adresse -->
                            <fieldset class="form-group">
                              <label for="mail">E-Mail Adresse</label>
                              <input type="mail" name="" class="form-control" id="mail" required>
                            </fieldset>
                            <!-- Senden Button -->
                            <button type="submit" class="btn btn-primary" name="btnHinzu">Abschicken</button>
                        </form>
                    </div>
                  </div>

                  <!-- Trennlinie -->
                  <!-- Hier eventuell Rechtemäßig abfragen und Ein, oder Ausbleden lassen -->
                  <hr class="trenner">

                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Lieferant ändern</h3>
                          <!-- Formular um einen Lieferanten zu suchen -->
                          <form method="post" action="../Stammdaten/Lieferanten.php">
                            <fieldset class="form-group">
                              <label for="search">Lieferant suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für alle Lieferanten -->
                                <option value="" >ID - Lieferant</option>
                              </select>
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="searchSubmit">Suchen</button>
                          </form>
                          <!-- Abstand (50px nach oben) -->
                          <div class="spacer"></div>
                          <!-- Formular um ein Lieferant zu ändern -->
                          <!-- Values und Placeholder Dynamisch Befüllen lassen anhand der obigen Suche-->
                          <form method="post" action="../Stammdaten/Lieferanten.php">
                            <fieldset class="form-group">
                              <label for="id">ID</label>
                              <input type="number" name="id" class="form-control" id="id" placeholder="" disabled value="1" placeholder="1">
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="firmenname">Firmenname</label>
                                <input type="text" name="" class="form-control" id="firmenname" required value="Musterfirma" placeholder="Musterfirma">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="strasse">Straße</label>
                                <input type="text" name="" class="form-control" id="strasse" required value="Musterstraße 15" placeholder="Musterstraße 15">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="plz">Postleitzahl</label>
                                <input type="number" name="" class="form-control" id="plz" required value="00000" placeholder="00000">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="ort">Ort</label>
                                <input type="text" name="" class="form-control" id="ort" required value="Musterort" placeholder="Musterort">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="tel">Telefonnummer</label>
                                <input type="text" name="" class="form-control" id="tel" required value="0870 66 66 66 60" placeholder="0870 66 66 66 60">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="mobil">Mobilnummer</label>
                                <input type="text" name="" class="form-control" id="mobil" required value="0870 66 66 66 60" placeholder="0870 66 66 66 60">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="fax">Faxnummer</label>
                                <input type="text" name="" class="form-control" id="fax" required value="0870 66 66 66 60" placeholder="0870 66 66 66 60">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="mail">E-Mail Adresse</label>
                                <input type="mail" name="" class="form-control" id="mail" required value="mustermann@musterfirma.com" placeholder="mustermann@musterfirma.com">
                              </fieldset>
                              <button type="submit" class="btn btn-primary" name="btnAend">Abschicken</button>
                          </form>
                      </div>
                    </div>
                    <!-- Trennlinie -->
                    <!-- Hier eventuell Rechtemäßig abfragen und Ein, oder Ausbleden lassen -->
                    <hr class="trenner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 id="del">Lieferant löschen</h3>
                            <!-- Form um ein Lieferant zu löschen -->
                            <form method="post" action="../Stammdaten/Lieferanten.php">
                              <fieldset class="form-group">
                                <label for="lieferant">Lieferant: </label>
                                <select class="form-control" name="deleteField" id="lieferant">
                                  <!-- Dynamisch mit Lieferanten füllen Values entsprechend auch -->
                                  <option value="" >ID - Lieferantname</option>
                                </select>
                              </fieldset>
                              <button type="submit" class="btn btn-danger" value="delete" id="delete">Löschen</button>
                            </form>
                        </div>
                      </div>
            </div>
        </main>
        <!-- Include Footer -->
        <?php
        require_once '../footer.php';
         ?>
