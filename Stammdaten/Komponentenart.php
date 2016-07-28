<?php
require_once (__DIR__ . '/../header.php');
require_once (__DIR__ . '/../database_entities/Benutzer.php');
require_once (__DIR__ . '/../database_entities/KomponentenArten.php');
require_once (__DIR__ . '/../module/Komponentenarten/KomponentenartenDBAdapter.php');
@session_start();
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
                            $Component->kar_id = 0;
                            
                            
                            $id = $dbAdapter->insertkomponentenarten($Component);
                            
                            $returnString = "Eine Kompnentenart mit der ID " . $id . " wurde angelegt";
                        }                     
                        if(isset($_POST["BtnAend"]))
                                {
                                $KompArt = KomponentenArten();
                                $KompArt->kar_id = $_POST["id"];
                                $KompArt->kar_bezeichnung = $_POST["name"];
                                $dbAdapter->updatekomponentenarten($KompArt);
                                $ausgewaehlteKomponentenArt = $KompArt;
                                //$status = "Lieferant erfolgreich geändert!";

                                }
                                
                        if(isset($_POST["Btn_Delete"]))
                        {
                            $KompArt = new KomponentenArten();
                            $KompArt->kar_id = $_POST["id"];
                            $KompArt->kar_bezeichnung = $_POST["name"];
                            $dbAdapter->deletekomponentenarten($KompArt);
                        }
                        if(isset($_POST["searchSubmit"]))
                        {
                            $KompArten = $dbAdapter->selectKomponentenarten();
                            $zuSuchendeId = $_POST["searchfield"];
                            foreach($KompArten as $KompArt)
                            {
                                if($KompArt->kat_id == $zuSuchendeId)
                                {
                                    echo "gefunden!";
                                    $ausgewaehlteKomponentenArt = $KompArt;
                                    break;
                                }
                            }
                        }
           
                 
                        ?>
                <hr class="trenner">
                <?php if(@$_SESSION["Benutzer"] instanceof BenutzerExtra): ?>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Komponentenart hinzufügen</h3>
                        <label><?php echo @$returnString?></label>
                        <!-- Form um Komponentenarten hinzuzufügen -->
                        
                        
                        <form method="post" action="../Stammdaten/Komponentenart.php">
                          <fieldset class="form-group">
                            <label for="id">ID</label>
                            <input type="number" name="id" class="form-control" id="id" disabled>
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
                          <form method="post" action="../Stammdaten/Komponentenart.php">
                            <fieldset class="form-group">
                              <label for="search">Komponentart suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für alle Komponentennamen -->
                                <?php
                                $dbAdapter = new KomponentenartenDBAdapter(null);
                                $KomponentenArten = $dbAdapter->selectKomponentenarten();
                                foreach($KomponentenArten as $KompnentenArt)
                                {
                                    echo "<option value='$KompnentenArt->kar_id >$KompnentenArt->kar_id - $KompnentenArt->kar_bezeichnung</option>";
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
                              <input type="text" name="id" class="form-control" id="id" readonly placeholder="1"
                                         value="<?php echo $ausgewaehlteKomponentenArt->kid_id?>">
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="name">Komponentenart</label>
                                <input type="text" name="" class="form-control" id="name" required placeholder="Musterkomponente"
                                       value="<?php echo $ausgewaehlteKomponentenArt->kar_bezeichnung ?>">
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
                            <form method="post" action="../Stammdaten/Komponentenart.php">
                              <fieldset class="form-group">
                                <label for="raum">Komponentenart: </label>
                                <select class="form-control" name="deleteField" id="raum">
                                  <option value="" >ID - Komponentenart</option>
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
