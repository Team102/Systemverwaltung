<?php
require_once '../header.php';
require_once "../database_entities/Benutzer.php";
require_once '../database_entities/KomponentenArten.php';
require_once '../module/Komponentenarten/KomponentenartenDBAdapter.php';
session_start();
?>
        <main>
            <div class="container">
                <div class="spacer"></div>
                <div class="headline">
                    <h2>Komponentenart</h2>
                    <!-- Sprungmarken -->
                    <p><a class="nav-link" href="#hinzu">Hinzufügen</a> // <a class="nav-link" href="#aend">Ändern</a> // <a class="nav-link" href="#del">Löschen</a></p>
                </div>
                <hr class="trenner">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Komponentenart hinzufügen</h3>
                        <label><?php echo @$returnString?></label>
                        <!-- Form um Komponentenarten hinzuzufügen -->
                        
                        <?php
                        //KomponentenartHinzufuegen
                        if(isset($_POST["btnHinzu"]))
                        {
                            echo testerer;
                            if($_POST["name"] == "")
                            {
                                return;
                            }
                            $Component = New KomponentenArten();
                            $Component->kar_bezeichnung = $_POST["name"];
                            $dbAdapter = new KomponentenartenDBAdapter(null);
                            $id = $dbAdapter->insertkomponentenarten($Component);
                            
                            $returnString = "Eine Kompnentenart mit der ID " . $id . " wurde angelegt";
                        }
                        ?>
                        <form method="post" action="../Stammdaten/Komponentenart.php">
                          <fieldset class="form-group">
                            <label for="id">ID</label>
                            <input type="number" name="id" class="form-control" id="id" disabled>
                          </fieldset>
                            <fieldset class="form-group">
                              <label for="name">Komponentenart</label>
                              <input type="text" name="name" class="form-control" id="name" required>
                            </fieldset>
                            <button type="submit" class="btn btn-primary">Abschicken</button>
                        </form>
                    </div>
                  </div>
                  <hr class="trenner">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Komponentenart Ändern</h3>
                          <!-- Form um eine Komponente zu suchen -->
                          <form method="post" action="../Stammdaten/Komponentenart.php">
                            <fieldset class="form-group">
                              <label for="search">Komponentart suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für alle Komponentennamen -->
                                <option value="" >ID - Komponentenartname</option>
                              </select>
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="searchSubmit">Suchen</button>
                          </form>
                          <div class="spacer"></div>
                          <!-- Form um eine Komponentenart zu ändern -->
                          <form method="post" action="../Stammdaten/Komponentenart.php">
                            <fieldset class="form-group">
                              <label for="id">ID</label>
                              <input type="number" name="id" class="form-control" id="id" disabled>
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="name">Komponentenart</label>
                                <input type="text" name="" class="form-control" id="name" required value="Musterkomponente" placeholder="Musterkomponente">
                              </fieldset>
                              <button type="submit" class="btn btn-primary">Abschicken</button>
                          </form>
                      </div>
                    </div>
                    <hr class="trenner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 id="del">Komponentenart löschen</h3>
                            <!-- Form um eine Komponentenart zu löschen -->
                            <form method="post" action="../Stammdaten/Komponentenart.php">
                              <fieldset class="form-group">
                                <label for="raum">Komponentenart: </label>
                                <select class="form-control" name="deleteField" id="raum">
                                  <option value="" >ID - Komponentenart</option>
                                </select>
                              </fieldset>
                              <button type="submit" class="btn btn-danger" value="delete" id="delete">Löschen</button>
                            </form>
                        </div>
                      </div>
            </div>
        </main>
  <?php
  require_once '../footer.php';
   ?>
