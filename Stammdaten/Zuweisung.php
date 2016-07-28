<?php
require_once (__DIR__ . '/../header.php');
require_once (__DIR__ . '/../database_entities/Benutzer.php');
require_once (__DIR__ . '/../database_entities/KomponentenArten.php');
require_once (__DIR__ . '/../database_entities/Wird_Beschrieben_Durch.php');
require_once (__DIR__ . '/../database_entities/KomponentenAttribute.php');
require_once (__DIR__ . '/../module/komponentenattribute/KomponentenattributeDBAdapter.php');
require_once (__DIR__ . '/../module/Komponentenarten/KomponentenartenDBAdapter.php');
 ?>
        <main>
            <div class="container">
                <div class="spacer"></div>
                <div class="headline">
                    <h2>Komponentenzuweisung</h2>
                </div>
                
                <?php
                $ausgewaehlteKomponentenArt;
                $GenutzteAttribute;
                $AttributeAdapter = new KomponentenAttributeDBAdapter();
                $WBDAdapter = new WirdbeschriebendurchDBAdapter();
                $VorhandeneAttribute = $AttributeAdapter->selectKomponentenAttribute();
                $IDS;
                
                
                
                if(isset($_POST["btnSelect"]))
                {
                    $IDS = "";
                    $IDS = $_POST["searchfield"];
                    $GenutzteAttribute = $WBDAdapter->wirdBeschriebenDurchByKar($IDS);
                    
                } 
                
                if(isset($_POST["btnConfirm"]))
                {
                    
                    $WBDAdapter->delete("wird_beschrieben_durch", "WHERE kar_id = " . $IDS);
                    $SelectedAttribute = [$_POST["checkList"]];
                    foreach($SelectedAttribute as $Attribut)
                    {
                        $WBD = new Wird_Beschrieben_Durch();
                        $WBD->kar_id = $IDS;
                        $WBD->kat_id = $Attribut;
                        $WBDAdapter->insertwirdBeschriebenDurch($WBD);
                    }
                }
                ?>
                <hr class="trenner">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Zuweisung</h3>
                        <!-- Form um Komponentenattribute und Komponentenart -->
                        <form method="post" action="../Stammdaten/Zuweisung.php">
                          <fieldset class="form-group">
                            <label for="komponenten">Komponentenart:</label>
                            <select class="form-control" name="searchfield" id="komponenten">
                              <!-- Repeat für alle Komponentenart -->
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
                            <button type="submit" name="btnSelect" class="btn btn-primary">Auswahlen</button>
                        </form>
                        <form method="post" action="../Stammdaten/Zuweisung.php">
                          <fieldset class="form-group">
                            <label>
                              <!-- Repeat für alle Attribute -->
                              
                              <?php
                              foreach($VorhandeneAttribute as $KomponentenAttribute)
                              {
                                  foreach ($GenutzteAttribute as $KomponentenAttributes)
                                  {
                                      if($KomponentenAttribute->kat_id == $KomponentenAttributes->kat_id)
                                      {
                                          echo "<input type='checkbox' checked='checked' name='checkList[]' value='$KomponentenAttribute->kat_id'>$KomponentenAttribute->kat_bezeichnung";
                                      }
                                      else
                                      {
                                          echo "<input type='checkbox' name='checkList[]' value='$KomponentenAttribute->kat_id'>$KomponentenAttribute->kat_bezeichnung";
                                      }
                                  }
                                  echo"<br />";
                              }
                              ?>
                              
                              
                              <!-- /Repeat -->
                            </label>
                          </fieldset>
                            <button type="submit" name="btnConfirm" class="btn btn-primary">Zuweisen</button>
                        </form>
                    </div>
                  </div>
            </div>
        </main>
        <div class="upArrow">
            <div class="fa fa-arrow-up"></div>
        </div>
  <?php
  require_once __DIR__ . '/../footer.php';
   ?>
