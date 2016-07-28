<?php
require_once '../header.php';
require_once '../database_entities/Benutzer.php';
require_once '../database_entities/Rollen.php';
require_once '../module/rollenmodul/RollenDBAdapter.php';
require_once '../module/benutzermodul/BenutzerDBAdapter.php';
@@session_start();

$statusInsert = null;
$statusUpdate = null;
$statusDelete = null;
$benutzerDBAdapter = new BenutzerDBAdapter(null);
$rollenDBAdapter = new RollenDBAdapter(null);
$zuAendernderBenutzer = null;



$alleRollen = $rollenDBAdapter->selectRollen();
if(isset($_POST["insert"])){
    $benutzer = new Benutzer();
    $benutzer->be_id = 0;
    $benutzer->be_login = $_POST["login"];
    $benutzer->be_pwd = $_POST["pwd"];
    $benutzer->be_vorname = "May be implemented";
    $benutzer->be_nachname = "May be implemented";
    $benutzer->be_rechte = $_POST["rechteField"];
    $id = $benutzerDBAdapter->insertBenutzer($benutzer);

    $statusInsert = "Der Benutzer mit dem login $benutzer->be_login wurde erfolgreich angelegt. Die Id ist: $id";
} else if(isset($_POST["search"])){
    $alleBenutzer = $benutzerDBAdapter->selectBenutzer();
    foreach($alleBenutzer as $benutzer){
        if($benutzer->be_id == $_POST["searchfield"]){
            $zuAendernderBenutzer = $benutzer;
            break;
        }
    }
} else if(isset($_POST["update"])){
    $benutzer = new Benutzer();
    $benutzer->be_id = $_POST["id"];
    $benutzer->be_login = $_POST["login"];
    $benutzer->be_pwd = $_POST["pwd"];
    $benutzer->be_vorname = "May be implemented";
    $benutzer->be_nachname = "May be implemented";
    $benutzer->be_rechte = $_POST["alleGruppen"];
    $benutzerDBAdapter->updateBenutzer($benutzer);
    $statusUpdate = "Der Benutzer wurde erfolgreich angepasst!";
    $zuAendernderBenutzer = $benutzer;
} else if(isset($_POST["delete"])){
    $benutzer = new Benutzer();
    $benutzer->be_id = $_POST["deleteField"];
    $benutzerDBAdapter->deleteBenutzer($benutzer);
    $statusDelete = "Der Benutzer wurde erfolgreich gelöscht";
}

$alleBenutzer = $benutzerDBAdapter->selectBenutzer();
//$currUser = $_SESSION["Benutzer"];
//foreach ($alleBenutzer as $benutzer){
//    if($benutzer->be_id == $currUser->be_id){
//
//    }
//} TODO den derzeitigen Benutzer entfernen
?>
        <main>
            <div class="container">
                <div class="spacer"></div>
                <div class="headline">
                    <h2>Benutzerverwaltung</h2>
                    <!-- Sprungmarken -->
                    <p><a class="nav-link" href="#hinzu">Hinzufügen</a> // <a class="nav-link" href="#aend">Ändern</a> // <a class="nav-link" href="#del">Löschen</a></p>
                </div>
                <hr class="trenner">
                <?php if(@$_SESSION["Benutzer"] instanceof BenutzerExtra && $_SESSION["Benutzer"]->darfAlles): ?>
                    <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Benutzer hinzufügen</h3>
                        <!-- Form um Benutzer hinzuzufügen -->
                        <!-- Namen entsprechend setzen -->
                        <form method="post" action="../Stammdaten/Benutzer.php#hinzu">
                            <label><?php echo @$statusInsert ?></label>
                          <fieldset class="form-group">
                            <label for="id">ID</label>
                            <input type="number" name="id" class="form-control" id="id" readonly>
                          </fieldset>
                            <fieldset class="form-group">
                              <label for="name">Benutzername</label>
                              <input type="text" name="login" class="form-control" id="name" required>
                            </fieldset>
                            <fieldset class="form-group">
                              <label for="password">Passwort</label>
                              <input type="password" name="pwd" class="form-control" id="password" required>
                            </fieldset>
                            <fieldset class="form-group">
                              <label for="gruppe">Gruppe</label>
                              <select class="form-control" name="rechteField" id="gruppe">
                                  <?php
                                    foreach ($alleRollen as $rolle){
                                      echo "<option value='$rolle->ro_id'>$rolle->ro_bezeichnung</option>";
                                    }
                                  ?>
                              </select>
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="insert">Abschicken</button>
                        </form>
                    </div>
                  </div>
                  <hr class="trenner">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Benutzer Ändern</h3>
                          <!-- Form um einen Beutzer zu suchen -->
                          <form method="post" action="../Stammdaten/Benutzer.php#aend">
                            <fieldset class="form-group">
                              <label for="search">Benutzer suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für alle Benutzer -->
                                  <?php
                                  foreach ($alleBenutzer as $benutzer){
                                      $selected = "";
                                      if($zuAendernderBenutzer != null && $zuAendernderBenutzer->be_id == $benutzer->be_id){
                                          $selected = "selected";
                                      } else {
                                          $selected = "";
                                      }
                                      echo "<option $selected value='$benutzer->be_id'>$benutzer->be_login</option>";
                                  }
                                  ?>
                              </select>
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="search">Suchen</button>
                          </form>
                          <div class="spacer"></div>
                          <!-- Form um einen Benutzer zu ändern -->
                          <form method="post" action="../Stammdaten/Benutzer.php#aend">
                              <label><?php echo @$statusUpdate?></label>
                            <fieldset class="form-group">
                              <label for="id">ID</label>
                              <input type="number" name="id" class="form-control" id="id" value="<?php echo $zuAendernderBenutzer->be_id?>" readonly>
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="name">Benutzername</label>
                                <input type="text" name="login" class="form-control" id="name" required value="<?php echo $zuAendernderBenutzer->be_login?>" placeholder="MaxMustermann">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="password">Passwort</label>
                                <input type="password" name="pwd" class="form-control" id="password" required value="<?php echo $zuAendernderBenutzer->be_pwd?>" placeholder="1234">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="gruppe">Gruppe</label>
                                <select class="form-control" name="alleGruppen" id="gruppe">
                                    <?php
                                    foreach ($alleRollen as $rolle){
                                        $selected = "";
                                        if($zuAendernderBenutzer != null && $rolle->ro_id == $zuAendernderBenutzer->be_rechte){
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "<option $selected value='$rolle->ro_id'>$rolle->ro_bezeichnung</option>";
                                    }
                                    ?>
                                </select>
                              </fieldset>
                              <button type="submit" class="btn btn-primary" name="update">Abschicken</button>
                          </form>
                      </div>
                    </div>
                    <hr class="trenner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 id="del">Benutzer löschen</h3>
                            <!-- Form um einen Benutzer zu löschen -->
                            <form method="post" action="../Stammdaten/Benutzer.php#del">
                                <label><?php echo @$statusDelete ?></label>
                              <fieldset class="form-group">
                                <label for="raum">Benutzer: </label>
                                <select class="form-control" name="deleteField" id="raum">
                                    <?php
                                    foreach ($alleBenutzer as $benutzer){
                                        echo "<option value='$benutzer->be_id'>$benutzer->be_login</option>";
                                    }
                                    ?>
                                </select>
                              </fieldset>
                              <button type="submit" class="btn btn-danger" id="delete" name="delete">Löschen</button>
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
