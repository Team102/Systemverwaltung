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
                $AttributeAdapter = new KomponentenAttributeDBAdapter();
                $VorhandeneAttribute = $AttributeAdapter->selectKomponentenAttribute();
                
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
                          <fieldset class="form-group">
                            <label>
                              <!-- Repeat für alle Attribute -->
                              
                              <?php
                              foreach($VorhandeneAttribute as $KomponentenAttribute)
                              {
                                  
                                  echo "<input type='checkbox' name='$KomponentenAttribute->kat_id' value='$KomponentenAttribute->kat_id - $KomponentenAttribute->kat_bezeichnung'>Attribut 1";
                                  echo"<br />";
                              }
                              ?>
                              
                              
                              <!-- /Repeat -->
                            </label>
                          </fieldset>
                          <button type="submit" class="btn btn-primary">Zuweisen</button>
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
