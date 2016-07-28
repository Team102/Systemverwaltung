<?php
require_once (__DIR__ . '/../header.php');
require_once (__DIR__ . '/../database_entities/Benutzer.php');
require_once (__DIR__ . '/../database_entities/KomponentenArten.php');
require_once (__DIR__ . '/../module/Komponentenarten/KomponentenartenDBAdapter.php');
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
                <?php
                        $status = "";
                        $statusError = "";
                        $ausgewaehlteKomponentenArt = new KomponentenArten();
                        $dbAdapter = new KomponentenartenDBAdapter(null);
                        $Komponentenarten = $dbAdapter->selectKomponentenarten();
                        //KomponentenartHinzufuegen
                       
                        if(isset($_POST["btnHinzu"]))
                        {
                            if($_POST["name"] == "")
                            {
                                return;
                            }
                            $Component = New KomponentenArten();
                            $Component->kar_bezeichnung = $_POST["name"];
                            
                            
                            $id = $dbAdapter->insertkomponentenarten($Component);
                            
                            $returnString = "Eine Kompnentenart mit der ID " . $id . " wurde angelegt";
                        }                     
                        if(isset($_POST["BtnAend"]))
                                {
                                $KompArt = new KomponentenArten();
                                $KompArt->kar_id = $_POST["id"];
                                $KompArt->kar_bezeichnung = $_POST["name"];
                                $dbAdapter->updatekomponentenarten($KompArt);
                                $ausgewaehlteKomponentenArt = $KompArt;
                                $status = "Komponenten Attribut erfolgreich geändert!";

                                }
                                
                        if(isset($_POST["BtnDelete"]))
                        {
                            $KompArt = new KomponentenArten();
                            $KompArt->kar_id = $_POST["deleteField"];
                            $dbAdapter->deletekomponentenarten($KompArt);
                            $statusError = "Das Komponenten Attribut wurde erfolgreich gelöscht";
                            
                        }
                        if(isset($_POST["searchSubmit"]))
                        {
                            $dbAdapter = new KomponentenartenDBAdapter(null);
                            $KompArten = $dbAdapter->selectKomponentenarten();
                            $zuSuchendeId = $_POST["searchfield"];
                            foreach($KompArten as $KompnentenArt)
                            {
                                if($KompnentenArt->kar_id == $zuSuchendeId)
                                {
                                    echo "gefunden!";
                                    $ausgewaehlteKomponentenArt = $KompnentenArt;
                                    break;
                                }
                            }
                        }                 
                        ?>
                <hr class="trenner">
                <?php if($_SESSION["Benutzer"] instanceof BenutzerExtra): ?>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Komponentenart hinzufügen</h3>
                        <label><?php echo @$returnString?></label>
                        <!-- Form um Komponentenarten hinzuzufügen -->
                        
                        
                        <form method="post" action="../Stammdaten/Komponentenart.php#hinzu">
                          <fieldset class="form-group">
                            <label for="id">ID</label>
                            <input type="number" name="id" class="form-control" id="id" readonly>
                          </fieldset>
                            <fieldset class="form-group">
                              <label for="name">Komponentenart</label>
                              <input type="text" name="name" class="form-control" id="name" required>
                            </fieldset>
                            <button type="submit" name="btnHinzu" class="btn btn-primary">Abschicken</button>
                        </form>
                    </div>
                  </div>
                  <hr class="trenner">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Komponentenart Ändern</h3>
                          <!-- Form um eine Komponente zu suchen -->
                          <form method="post" action="../Stammdaten/Komponentenart.php#aend">
                              <label><?php echo @$status?></label>
                            <fieldset class="form-group">
                              <label for="search">Komponentart suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für alle Komponentennamen -->
                                <?php
                                $dbAdapter = new KomponentenartenDBAdapter(null);
                                $KomponentenArten = $dbAdapter->selectKomponentenarten();
                                foreach($KomponentenArten as $KompnentenArt)
                                {
                                    $selected;
                                    if($ausgewaehlteKomponentenArt != null && $ausgewaehlteKomponentenArt->kar_id == $KompnentenArt->kar_id)
                                    {
                                        $selected = "selected";
                                    }
                                    else
                                    {
                                        $selected = "";
                                    }
                                    echo "<option $selected value='$KompnentenArt->kar_id'>$KompnentenArt->kar_id - $KompnentenArt->kar_bezeichnung</option>";
                                }
                                ?>
                              </select>
                            </fieldset>
                           <button type="submit" class="btn btn-primary" name="searchSubmit">Suchen</button>
                          </form>
                          <div class="spacer"></div>
                          <!-- Form um eine Komponentenart zu ändern -->
                          <form method="post" action="../Stammdaten/Komponentenart.php">
                            <fieldset class="form-group">
                              <label for="id">ID</label>
                              <input type="text" name="id" class="form-control" id="id" readonly 
                                         value="<?php echo $ausgewaehlteKomponentenArt->kar_id?>">
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="name">Komponentenart</label>
                                <input type="text" name="name" class="form-control" id="name" required 
                                       value="<?php echo $ausgewaehlteKomponentenArt->kar_bezeichnung?>">
                              </fieldset>
                              <button type="submit" name="BtnAend" class="btn btn-primary">Abschicken</button>
                          </form>
                      </div>
                    </div>
                    <hr class="trenner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 id="del">Komponentenart löschen</h3>
                            <!-- Form um eine Komponentenart zu löschen -->
                            <form method="post" action="../Stammdaten/Komponentenart.php#del">
                                <label><?php echo @$statusError?></label>
                              <fieldset class="form-group">
                                <label for="raum">Komponentenart: </label>
                                <select class="form-control" name="deleteField" id="raum">
                                     <?php
                                        $dbAdapter = new KomponentenartenDBAdapter(null);
                                        $KomponentenArten = $dbAdapter->selectKomponentenarten();
                                        foreach($KomponentenArten as $KompnentenArt)
                                        {
                                             echo "<option $selected value='$KompnentenArt->kar_id'>$KompnentenArt->kar_id - $KompnentenArt->kar_bezeichnung</option>";
                                        }
                                        ?>
                                </select>
                              </fieldset>
                                <button type="submit" class="btn btn-danger" name="BtnDelete" value="delete" id="delete">Löschen</button>
                            </form>
                        </div>
                      </div>

                <?php else: ?>
                    <label style="color:red; font-weight: bold;">Sie sind nicht Berechtigt diese Webseite zu benutzen.</label>
                <?php endif; ?>
            </div>
        </main>
  <?php
  require_once __DIR__ . '/../footer.php';
   ?>
