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
                
                
                
                if(isset($_POST["btnSelect"]))
                {
                    $IDS = $_POST["searchfield"];
                    $GenutzteAttribute = $WBDAdapter->wirdBeschriebenDurchByKar($IDS);
                    
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
                            <select class="form-control" name="" id="komponenten">
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
                                          echo ja;
                                          echo "<input type='checkbox' checked='checked' name='$KomponentenAttribute->kat_id' value='$KomponentenAttribute->kat_id'>$KomponentenAttribute->kat_bezeichnung";
                                      }
                                      else
                                      {
                                          echo nein;
                                          echo "<input type='checkbox' name='$KomponentenAttribute->kat_id' value='$KomponentenAttribute->kat_id'>$KomponentenAttribute->kat_bezeichnung";
                                      }
                                  }
                                  
                                  echo "<input type='checkbox' name='$KomponentenAttribute->kat_id' value='$KomponentenAttribute->kat_id - $KomponentenAttribute->kat_bezeichnung'>Attribut 1";
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
  require_once '../footer.php';
   ?>
