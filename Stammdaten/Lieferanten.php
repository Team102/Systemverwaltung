<!-- Include Header -->
<?php
require_once '../header.php';
require_once "../database_entities/Benutzer.php";
require_once "../database_entities/Lieferant.php";
require_once "../module/Lieferantenmodul/LieferantenDBAdapter.php";
session_start();
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
          //hinzufuegen Lieferant
          if(isset($_POST["btnHinzu"])){

            $firmenname = $_POST["firmenname"];
            $strasse = $_POST["strasse"];
            $plz = $_POST["plz"];
            $ort = $_POST["ort"];
            $tel = $_POST["tel"];
            $mobil = $_POST["mobil"];
            $fax = $_POST["fax"];
            $mail = $_POST["mail"];

              //TODO check for errors
            $lieferant = new Lieferant();
            $lieferant->l_firmenname = $firmenname;
            $lieferant->l_strasse = $strasse;
            $lieferant->l_plz = $plz;
            $lieferant->l_ort = $ort;
            $lieferant->l_tel = $tel;
            $lieferant->l_mobil = $mobil;
            $lieferant->l_fax = $fax;
            $lieferant->l_email = $mail;

            $dbAdapter = new LieferantenDBAdapter(null);
            $id = $dbAdapter->insertLieferant($lieferant);

            $infoString = "Neuer Lieferant mit der Id: " . $id . " wurde in die Datenbank eingefügt";

          }
          ?>
          <hr class="trenner">
                <div class="row">
                  <!-- Mittig Zentriert -->
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Lieferant hinzufügen</h3>
                      <label name="info_label"><?php echo @$infoString?></label>

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
                              <input type="text" name="firmenname" class="form-control" id="firmenname" required>
                            </fieldset>
                            <!-- Input für Straße -->
                            <fieldset class="form-group">
                              <label for="strasse">Straße</label>
                              <input type="text" name="strasse" class="form-control" id="strasse" required>
                            </fieldset>
                            <!-- Input für Postleitzahl -->
                            <fieldset class="form-group">
                              <label for="plz">Postleitzahl</label>
                              <input type="number" name="plz" class="form-control" id="plz" required>
                            </fieldset>
                            <!-- Input für Ort -->
                            <fieldset class="form-group">
                              <label for="ort">Ort</label>
                              <input type="text" name="prt" class="form-control" id="ort" required>
                            </fieldset>
                            <!-- Input für Telefonnummer -->
                            <fieldset class="form-group">
                              <label for="tel">Telefonnummer</label>
                              <input type="text" name="tel" class="form-control" id="tel" required>
                            </fieldset>
                            <!-- Input für Mobilnummer -->
                            <fieldset class="form-group">
                              <label for="mobil">Mobilnummer</label>
                              <input type="text" name="mobil" class="form-control" id="mobil" required>
                            </fieldset>
                            <!-- Input für Faxnummer -->
                            <fieldset class="form-group">
                              <label for="fax">Faxnummer</label>
                              <input type="text" name="" class="form-control" id="fax" required>
                            </fieldset>
                            <!-- Input für EMail Adresse -->
                            <fieldset class="form-group">
                              <label for="mail">E-Mail Adresse</label>
                              <input type="mail" name="mail" class="form-control" id="mail" required>
                            </fieldset>
                            <!-- Senden Button -->
                            <button type="submit" class="btn btn-primary" name="btnHinzu">Abschicken</button>
                        </form>
                    </div>
                  </div>

                  <!-- Trennlinie -->
                  <!-- Hier eventuell Rechtemäßig abfragen und Ein, oder Ausbleden lassen -->
                  <hr class="trenner">



              <?php
              //Lieferant ändern part
                //hole Liste von allen Lieferanten
              if($dbAdapter == null){
                  $dbAdapter = new LieferantenDBAdapter(null);
              }
              $lieferantenArray = $dbAdapter->selectLieferanten();

              $ausgewaehlterLieferant = null;
                if(isset($_POST["searchSubmit"])){
                    $zuSuchendeId = $_POST["searchSubmit"];
                    foreach($lieferantenArray as $lieferant){
                        if($lieferant->l_id == $zuSuchendeId){
                            $ausgewaehlterLieferant = $zuSuchendeId;
                        break;
                        }
                    }
                }
              ?>
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Lieferant ändern</h3>
                          <!-- Formular um einen Lieferanten zu suchen -->
                          <form method="post" action="../Stammdaten/Lieferanten.php">
                            <fieldset class="form-group">
                              <label for="search">Lieferant suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für alle Lieferanten -->
                                  <?php
                                  if(count($lieferantenArray) > 0){
                                      foreach($lieferantenArray as $lieferant){
                                          echo "<option value='$lieferant->l_id'>$lieferant->l_id - $lieferant->l_firmenname</option>";
                                      }
                                  }
                                  ?>
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
                              <input type="number" name="id" class="form-control" id="id" placeholder="" disabled placeholder="1"
                                        value="<?php echo $ausgewaehlterLieferant->l_id?>">
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="firmenname">Firmenname</label>
                                <input type="text" name="" class="form-control" id="firmenname" required placeholder="Musterfirma"
                                       value="<?php echo $ausgewaehlterLieferant->l_id?>">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="strasse">Straße</label>
                                <input type="text" name="" class="form-control" id="strasse" required placeholder="Musterstraße 15"
                                       value="<?php echo $ausgewaehlterLieferant->l_id?>">>
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
