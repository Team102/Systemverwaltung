<?php
require_once (__DIR__ . '/../header.php');
require_once (__DIR__ . '/../database_entities/Benutzer.php');
require_once (__DIR__ . '/../database_entities/KomponentenAttribute.php');
require_once (__DIR__ . '/../module/komponentenattribute/KomponentenattributeDBAdapter.php');
session_start();

 ?>
        <main>
            <div class="container">
                <div class="spacer"></div>
                <div class="headline">
                    <h2>Komponentenattribut</h2>
                    <!-- Sprungmarken -->
                    <p><a class="nav-link" href="#hinzu">Hinzufügen</a> // <a class="nav-link" href="#aend">Ändern</a> // <a class="nav-link" href="#del">Löschen</a></p>
                </div>
                
                <?php
                        $status = "";
                        $statusError = "";
                        $ausgewaehlteKomponentenArt = new KomponentenAttribute();
                        $dbAdapter = new KomponentenAttributeDBAdapter(null);
                        $Komponentenarten = $dbAdapter->selectKomponentenAttribute();
                        //KomponentenartHinzufuegen
                       
                        if(isset($_POST["btnHinzu"]))
                        {
                            if($_POST["name"] == "")
                            {
                                return;
                            }
                            $Component = New KomponentenAttribute();
                            $Component->kat_bezeichnung = $_POST["name"];
                            
                            
                            $id = $dbAdapter->insertKomponentenAttribute($Component);
                            
                            $returnString = "Eine Kompnentenart mit der ID " . $id . " wurde angelegt";
                        }                     
                        if(isset($_POST["BtnAend"]))
                                {
                                $KompArt = new KomponentenAttribute();
                                $KompArt->kat_id = $_POST["id"];
                                $KompArt->kat_bezeichnung = $_POST["name"];
                                $dbAdapter->updateKomponentenAttribute($KompArt);
                                $ausgewaehlteKomponentenArt = $KompArt;
                                $status = "Komponenten Attribut erfolgreich geändert!";

                                }
                                
                        if(isset($_POST["BtnDelete"]))
                        {
                            $KompArt = new KomponentenAttribute();
                            $KompArt->kat_id = $_POST["deleteField"];
                            $dbAdapter->deleteKomponentenAttribute($KompArt);
                            $statusError = "Das Komponenten Attribut wurde erfolgreich gelöscht";
                            
                        }
                        if(isset($_POST["searchSubmit"]))
                        {
                            $dbAdapter = new KomponentenAttributeDBAdapter(null);
                            $KompArten = $dbAdapter->selectKomponentenAttribute();
                            $zuSuchendeId = $_POST["searchfield"];
                            foreach($KompArten as $KomponentenAttribute)
                            {
                                if($KomponentenAttribute->kat_id == $zuSuchendeId)
                                {
                                    echo "gefunden!";
                                    $ausgewaehlteKomponentenArt = $KomponentenAttribute;
                                    break;
                                }
                            }
                        }            
                ?>
                <hr class="trenner">
                <?php if($_SESSION["Benutzer"] instanceof BenutzerExtra): ?>
                    <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <label><?php echo @$returnString?></label>
                        <h3 id="hinzu">Komponentenattribut hinzufügen</h3>
                        <!-- Form um ein Attribut hinzuzufügen -->
                        <form method="post" action="../Stammdaten/Komponentenattribut.php#hinzu">
                          <fieldset class="form-group">
                            <label for="id">ID</label>
                            <input type="number" name="id" class="form-control" id="id" readonly>
                          </fieldset>
                            <fieldset class="form-group">
                              <label for="bez">Bezeichnung</label>
                              <input type="text" name="name" class="form-control" id="bez" required>
                            </fieldset>
                            <button type="submit" name="btnHinzu" class="btn btn-primary">Abschicken</button>
                        </form>
                    </div>
                  </div>
                  <hr class="trenner">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Komponentenattribut Ändern</h3>          
                          <!-- Formm um Komponentenattribut zu suchen -->
                          <form method="post" action="../Stammdaten/Komponentenattribut.php#aend">
                              <label><?php echo @$status?></label>
                            <fieldset class="form-group">
                              <label for="search">Komponentart suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für alle Komponentenarten -->
                                <?php
                                $dbAdapter = new KomponentenAttributeDBAdapter(null);
                                $KomponentenArten = $dbAdapter->selectKomponentenAttribute();
                                foreach($KomponentenArten as $KomponentenAttribute)
                                {
                                    $selected;
                                    if($ausgewaehlteKomponentenArt != null && $ausgewaehlteKomponentenArt->kat_id == $KomponentenAttribute->kat_id)
                                    {
                                        $selected = "selected";
                                    }
                                    else
                                    {
                                        $selected = "";
                                    }
                                    echo "<option $selected value='$KomponentenAttribute->kat_id'>$KomponentenAttribute->kat_id - $KomponentenAttribute->kat_bezeichnung</option>";
                                }
                                ?>
                              </select>
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="searchSubmit">Suchen</button>
                          </form>
                          <div class="spacer"></div>
                          <!-- Form für Komponentenattribut ändern -->
                          <form method="post" action="../Stammdaten/Komponentenattribut.php">
                            <fieldset class="form-group">
                              <label for="id">ID</label>
                              //was number now text
                              <input type="text" name="id" class="form-control" id="id" readonly
                                     value="<?php echo $ausgewaehlteKomponentenArt->kat_id?>">
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="bez">Komponentenbezeichnung</label>
                                <input type="text" name="name" class="form-control" id="bez" required 
                                       value="<?php echo $ausgewaehlteKomponentenArt->kat_bezeichnung?>">
                              </fieldset>
                              <button type="submit" name="BtnAend" class="btn btn-primary">Abschicken</button>
                          </form>
                      </div>
                    </div>
                    <hr class="trenner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 id="del">Komponentenattribut löschen</h3>
                            <!-- Form um Komponenenattribut zu löschen -->
                            <form method="post" action="../Stammdaten/Komponentenattribut.php#del">
                                <label><?php echo @$statusError?></label>
                              <fieldset class="form-group">
                                <label for="raum">Komponentenattribut: </label>
                                <select class="form-control" name="deleteField" id="raum">
                                   <?php
                                        $dbAdapter = new KomponentenAttributeDBAdapter(null);
                                        $KomponentenArten = $dbAdapter->selectKomponentenAttribute();
                                        foreach($KomponentenArten as $KomponentenAttribute)
                                        {
                                             echo "<option $selected value='$KomponentenAttribute->kat_id'>$KomponentenAttribute->kat_id - $KomponentenAttribute->kat_bezeichnung</option>";
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
  require_once '../footer.php';
   ?>
