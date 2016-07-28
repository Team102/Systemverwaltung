<!-- Include Header -->
<?php
require_once '../header.php';
require_once "../database_entities/Benutzer.php";
require_once "../database_entities/Lieferant.php";
require_once "../module/Lieferantenmodul/LieferantenDBAdapter.php";
@session_start();
//hinzufuegen Lieferant
function getLieferant(){
    $lieferant = new Lieferant();
    $firmenname = $_POST["firmenname"];
    $strasse = $_POST["strasse"];
    $plz = $_POST["plz"];
    $ort = $_POST["ort"];
    $tel = $_POST["tel"];
    $mobil = $_POST["mobil"];
    $fax = $_POST["fax"];
    $mail = $_POST["mail"];

    $lieferant->l_firmenname = $firmenname;
    $lieferant->l_strasse = $strasse;
    $lieferant->l_plz = $plz;
    $lieferant->l_ort = $ort;
    $lieferant->l_tel = $tel;
    $lieferant->l_mobil = $mobil;
    $lieferant->l_fax = $fax;
    $lieferant->l_email = $mail;
    return $lieferant;
}

//Lieferant ändern part
//hole Liste von allen Lieferanten
if(@$dbAdapter == null){
    @$dbAdapter = new LieferantenDBAdapter(null);
}

$status = "";
$ausgewaehlterLieferant = null;
$statusError = "";
$bereitsGeladen = false;

if(isset($_POST["btnHinzu"])){
    //TODO check for errors
    $lieferant = getLieferant();
    $lieferant->l_id = 0;
    $dbAdapter = new LieferantenDBAdapter(null);
    $id = $dbAdapter->insertLieferant($lieferant);

    $infoString = "Neuer Lieferant mit der Id: " . @$id . " wurde in die Datenbank eingefügt";
} else if(isset($_POST["delete"])){
    if($dbAdapter != null){
        $dbAdapter = new LieferantenDBAdapter(null);
    }
    $lieferant = new Lieferant();
    $lieferant->l_id = $_POST["deleteField"];
    $dbAdapter->deleteLieferant($lieferant);
    $statusError = "Der Nutzer wurde erfolgreich gelöscht";
} else if(isset($_POST["btnAend"])){
    $lieferant = getLieferant();
    $lieferant->l_id = $_POST["id"];
    $dbAdapter->updateLieferant($lieferant);
    $ausgewaehlterLieferant = $lieferant;
    $status = "Lieferant erfolgreich geändert!";
} else if(isset($_POST["searchSubmit"])){
    //ändere Lieferant
    $bereitsGeladen = true;
    $lieferantenArray = $dbAdapter->selectLieferanten();
    $zuSuchendeId = $_POST["searchfield"];
    foreach($lieferantenArray as $lieferant){
        if($lieferant->l_id == $zuSuchendeId){
            echo "gefunden!";
            $ausgewaehlterLieferant = $lieferant;
            break;
        }
    }
}
if(!$bereitsGeladen){
    $lieferantenArray = $dbAdapter->selectLieferanten();
}
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
          <hr class="trenner">
          <?php if(@$_SESSION["Benutzer"] instanceof BenutzerExtra && $_SESSION["Benutzer"]->darfAlles): ?>
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
                              <input type="text" name="ort" class="form-control" id="ort" required>
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
                              <input type="text" name="fax" class="form-control" id="fax" required>
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
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Lieferant ändern</h3>
                          <!-- Formular um einen Lieferanten zu suchen -->
                          <form method="post" action="../Stammdaten/Lieferanten.php#aend">
                            <fieldset class="form-group">
                              <label for="search">Lieferant suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für alle Lieferanten -->
                                  <?php
                                  if(count($lieferantenArray) > 0){
                                      var_dump($ausgewaehlterLieferant);
                                      foreach($lieferantenArray as $lieferant){
                                          if($ausgewaehlterLieferant != null && $ausgewaehlterLieferant->l_id == $lieferant->l_id){
                                              $selected = "selected";
                                          } else {
                                              $selected = "";
                                          }
                                          echo "<option $selected value='$lieferant->l_id'>$lieferant->l_id - $lieferant->l_firmenname</option>";
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
                          <form method="post" action="../Stammdaten/Lieferanten.php#aend">
                                <label><?php echo @$status?></label>
                              <fieldset class="form-group">
                                  <label for="id">ID</label>
                                  <input type="text" name="id" class="form-control" id="id" readonly placeholder="1"
                                         value="<?php echo @$ausgewaehlterLieferant->l_id?>">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="firmenname">Firmenname</label>
                                <input type="text" name="firmenname" class="form-control" id="firmenname" required placeholder="Musterfirma"
                                       value="<?php echo @$ausgewaehlterLieferant->l_firmenname?>">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="strasse">Straße</label>
                                <input type="text" name="strasse" class="form-control" id="strasse" required placeholder="Musterstraße 15"
                                       value="<?php echo @$ausgewaehlterLieferant->l_strasse?>">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="plz">Postleitzahl</label>
                                <input type="number" name="plz" class="form-control" id="plz" required placeholder="00000"
                                       value="<?php echo @$ausgewaehlterLieferant->l_plz?>">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="ort">Ort</label>
                                <input type="text" name="ort" class="form-control" id="ort" required placeholder="Musterort"
                                       value="<?php echo @$ausgewaehlterLieferant->l_ort?>">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="tel">Telefonnummer</label>
                                <input type="text" name="tel" class="form-control" id="tel" required placeholder="0870 66 66 66 60"
                                       value="<?php echo @$ausgewaehlterLieferant->l_tel?>">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="mobil">Mobilnummer</label>
                                <input type="text" name="mobil" class="form-control" id="mobil" required placeholder="0870 66 66 66 60"
                                       value="<?php echo $ausgewaehlterLieferant->l_mobil?>">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="fax">Faxnummer</label>
                                <input type="text" name="fax" class="form-control" id="fax" required placeholder="0870 66 66 66 60"
                                       value="<?php echo @$ausgewaehlterLieferant->l_fax?>">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="mail">E-Mail Adresse</label>
                                <input type="mail" name="mail" class="form-control" id="mail" required placeholder="mustermann@musterfirma.com"
                                       value="<?php echo @$ausgewaehlterLieferant->l_email?>">
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
                            <form method="post" action="../Stammdaten/Lieferanten.php#del">
                                <label><?php echo @$statusError?></label>
                              <fieldset class="form-group">
                                <label for="lieferant">Lieferant: </label>
                                <select class="form-control" name="deleteField" id="lieferant">
                                  <!-- Dynamisch mit Lieferanten füllen Values entsprechend auch -->
                                    <?php
                                    foreach($lieferantenArray as $lieferant){
                                        echo "<option value='$lieferant->l_id'>$lieferant->l_id - $lieferant->l_firmenname</option>";
                                    }
                                    ?>
                                </select>
                              </fieldset>
                              <button type="submit" class="btn btn-danger" name="delete" value="delete" id="delete">Löschen</button>
                            </form>
                        </div>
                      </div>

            <?php else: ?>
                <label style="color:red; font-weight: bold;">Sie sind nicht Berechtigt diese Webseite zu benutzen.</label>
            <?php endif; ?>
            </div>
        </main>
        <!-- Include Footer -->
        <?php
        require_once '../footer.php';
        ?>
