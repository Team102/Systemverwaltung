<?php
require_once '../header.php';
require_once "../database_entities/Benutzer.php";
require_once "../database_entities/Raum.php";
require_once "../module/Raummodul/RaumDBAdapter.php";

    $statusInsert = null;
    $statusUpdate = null;
    $statusDelete = null;
    $dbAdapter = new RaumDBAdapter(null);
    $zuAendernderRaum = null;


    if(isset($_POST["insert"])){
        $newRaum = new Raum();
        $newRaum->r_nr = $_POST["nummer"];
        $newRaum->r_notiz = $_POST["notiz"];
        $newRaum->r_bezeichnung = $_POST["bezeichnung"];

        $id = $dbAdapter->insertRaum($newRaum);
        $newRaum->r_id = $id;
        $statusInsert = "Der Raum mit der Id: $id wurde hinzugefügt";

    } else if(isset($_POST["search"])){
        $zuSuchendeId = $_POST["searchfield"];
        $alleRaeume = $dbAdapter->selectRaeume();
        foreach($alleRaeume as $raum){
            if($raum->r_id == $zuSuchendeId){
                $zuAendernderRaum = $raum;
                echo "<br/>$zuAendernderRaum->r_notiz<br/>";
                break;
            }
        }
    } else if(isset($_POST["update"])){
        $raum = new Raum();
        $raum->r_id = $_POST["id"];
        $raum->r_nr = $_POST["nummer"];
        $raum->r_notiz = $_POST["notiz"];
        $raum->r_bezeichnung = $_POST["bezeichnung"];
        $dbAdapter->updateRaum($raum);
        $statusUpdate = "Der Raum wurde erfolgreich verändert";
        $zuAendernderRaum = $raum;
    } else if(isset($_POST["delete"])){
        $raum = new Raum();
        $raum->r_id = $_POST["deleteField"];
        $dbAdapter->deleteRaum($raum);
        $statusDelete = "Der Raum wurde erfolgreich gelöscht";
    }

    $alleRaeume = $dbAdapter->selectRaeume();


?>
        <main>
            <div class="container">
                <div class="spacer"></div>
                <div class="headline">
                    <h2>Raumverwaltung</h2>
                    <!-- Sprungmarken -->
                    <p><a class="nav-link" href="#hinzu">Hinzufügen</a> // <a class="nav-link" href="#aend">Ändern</a> // <a class="nav-link" href="#del">Löschen</a></p>
                </div>
                <hr class="trenner">
                <?php if($_SESSION["Benutzer"] instanceof BenutzerExtra && $_SESSION["Benutzer"]->darfAlles): ?>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Raum hinzufügen</h3>
                        <!-- Form um Räume hinzuzufügen -->
                        <!-- Namen entsprechend setzen für Auswertung in PHP -->
                        <form method="post" action="../Stammdaten/Raeume.php#hinzu">
                            <label><?php echo @$statusInsert?></label>
                          <fieldset class="form-group">
                            <label for="id">ID</label>
                            <input type="number" name="id" class="form-control" id="id" readonly>
                          </fieldset>
                            <fieldset class="form-group">
                              <label for="nummer">Raumnummer</label>
                              <input type="number" name="nummer" class="form-control" id="nummer" required>
                            </fieldset>
                            <fieldset class="form-group">
                              <label for="bez">Bezeichnung</label>
                              <input type="text" name="bezeichnung" class="form-control" id="bez" required>
                            </fieldset>
                            <fieldset class="form-group">
                              <label for="notiz">Notiz</label>
                              <textarea  type="text" name="notiz" class="form-control" id="notiz" maxlength="1024"></textarea>
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="insert">Abschicken</button>
                        </form>
                    </div>
                  </div>
                  <hr class="trenner">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Raum Ändern</h3>
                          <!-- Form um ein Raum zu Suchen -->
                          <form method="post" action="../Stammdaten/Raeume.php#aend">
                            <fieldset class="form-group">
                              <label for="search">Raum suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für Alle Räume -->
                                  <?php
                                    foreach ($alleRaeume as $raum){
                                      $select = "";
                                      if($zuAendernderRaum != null && $zuAendernderRaum->r_id == $raum->r_id){
                                          $select = "selected";
                                      } else {
                                          $select = "";
                                      }
                                      echo "<option $select value='$raum->r_id'>$raum->r_id - $raum->r_nr</option>";
                                    }
                                  ?>
                              </select>
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="search">Suchen</button>
                          </form>
                          <div class="spacer"></div>
                          <!-- Form um Raum zu ändern -->
                          <!-- Values und Placeholder dynamisch befüllen -->
                          <form method="post" action="../Stammdaten/Raeume.php#aend">
                              <label><?php echo @$statusUpdate ?></label>
                            <fieldset class="form-group">
                              <label for="id">ID</label>
                              <input type="number" name="id" class="form-control" id="id" readonly value="<?php echo @$zuAendernderRaum->r_id?>" placeholder="1">
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="nummer">Raumnummer</label>
                                <input type="number" name="nummer" class="form-control" id="nummer" required value="<?php echo @$zuAendernderRaum->r_nr?>" placeholder="">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="bez">Bezeichnung</label>
                                <input type="text" name="bezeichnung" class="form-control" id="bez" required value="<?php echo @$zuAendernderRaum->r_bezeichnung?>" placeholder="" maxlength="1024">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="notiz">Notiz</label>
                                <textarea name="notiz" class="form-control" id="notiz" placeholder=""><?php echo @$zuAendernderRaum->r_notiz?></textarea>
                              </fieldset>
                              <button type="submit" class="btn btn-primary" name="update">Abschicken</button>
                          </form>
                      </div>
                    </div>
                    <hr class="trenner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 id="del">Raum löschen</h3>
                            <!-- Form um Raum zu löschen -->
                            <form method="post" action="../Stammdaten/Raeume.php#del">
                                <label><?php echo @$statusDelete ?></label>
                              <fieldset class="form-group">
                                <label for="raum">Raum: </label>
                                <select class="form-control" name="deleteField" id="raum">
                                  <!-- Repeat für alle Räume -->
                                    <?php
                                        foreach ($alleRaeume as $raum){
                                            echo "<option value='$raum->r_id'>$raum->r_id - $raum->r_nr</option>";
                                        }
                                    ?>
                                  <option value="" >ID - Raum</option>
                                </select>
                              </fieldset>
                              <button type="submit" class="btn btn-danger" value="delete" id="delete" name="delete">Löschen</button>
                            </form>
                        </div>
                      </div>
                <?php else: ?>
                    <label style="color:red; font-weight: bold;">Sie sind nicht Berechtigt diese Webseite zu benutzen.</label>
                <?php endif; ?>
            </div>
        </main>
        <?php
        require_once '../footer.php';
         ?>
