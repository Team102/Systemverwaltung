<?php
require_once '../header.php';
require_once "../database_entities/komponente.php";
require_once "../database_entities/KomponenteHatAttribute.php";
require_once "../database_entities/KomponentenArten.php";
require_once "../module/Raummodul/RaumDBAdapter.php";
require_once "../module/Lieferantenmodul/LieferantenDBAdapter.php";
require_once "../module/Komponentenmodul/komponentenDbAdapter.php";
require_once "../module/Komponentenarten/KomponentenartenDBAdapter.php";
require_once "../module/komponentenattribute/KomponentenattributeDBAdapter.php";
require_once "../module/wird_beschrieben_druch/WirdbeschriebenDurchDBAdapter.php";
require_once "../database_entities/Benutzer.php"
?>
<?php //session_start();?>
<!---->
<?php
//$statusInsert = null;
////$dbAdapter = new kompnenentenDbAdapter(null);
//$dbKomponentenartAdapter = new KomponentenartenDBAdapter(null);
//$dbRaumAdapter = new RaumDBAdapter(null);
//$dbLieferantAdapter = new LieferantenDBAdapter(null);
//$dbWirdbeschriebendurchAdapter = new WirdbeschriebendurchDBAdapter(null);
//$dbKomponentenattributeDBAdapter = new KomponentenAttributeDBAdapter(null);
//$ausgewaehltesGeraet = null;
//$ausgewaehlteKomponentenArt = null;
//$ausgewaehlterRaumArt = null;
//$ausgewaehlterLieferant = null;
//$bereitsGeladen = false;


////if(isset($_POST["insert"])){
////   $newKomponente = new komponente();
////   $raum = $_POST["raum"];
////   $lieferant = $_POST["lieferant"];
////   $gewaehrleistung = $_POST["gewaehrleistung"];
////   $notiz = $_POST["tel"];
////   $hersteller = $_POST["mobil"];
////   $fax = $_POST["fax"];
////   $mail = $_POST["mail"];
////    $newRaum->r_notiz = $_POST["notiz"];
////    $newRaum->r_bezeichnung = $_POST["bezeichnung"];
////
////    $id = $dbAdapter->insertRaum($newRaum);
////    $newRaum->r_id = $id;
////    $statusInsert = "Der Raum mit der Id: $id wurde hinzugefügt";
////} else
//    if(isset($_POST["search"])){
//    $bereitsGeladen = true;
//    $komponentenartenArray = $dbKomponentenartAdapter->selectKomponentenarten();
//    $raumArray = $dbRaumAdapter->selectRaeume();
//    $zuSuchendeId = $_POST["searchfield"];
//    foreach($komponentenartenArray as $komponentenArt){
//        if($komponentenArt->kar_id == $zuSuchendeId){
//            $gewaehltekomponentenArt = $komponentenArt->kar_id;
//            break;
//        }
//    }
//    $raumArray = $dbRaumAdapter->selectRaeume();
//    $lieferantArray = $dbLieferantAdapter->selectLieferanten();
//    $AttributArray = $dbWirdbeschriebendurchAdapter->selectKomponentenAttributeFormID($gewaehltekomponentenArt);
//
//}
//
//if(!$bereitsGeladen){
//    $komponentenartenArray = $dbKomponentenartAdapter->selectKomponentenarten();
//}
//?>
<main>
  <div class="container">
      <div class="spacer"></div>
      <div class="headline">
          <h2>Neubeschaffung</h2>
          <p></p>
      </div>
      <hr class="trenner">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <h3 id="hinzu">Neues Gerät anlegen</h3>
              <!-- Form um Komponentenarten zu suchen -->
              <form method="post" action="../Produktpflege/Neubeschaffung.php">
                <fieldset class="form-group">
                  <label for="searchfield">Welche Komponente soll angelegt werden?:</label>
                  <select class="form-control" name="searchfield" id="searchfield">
                    <!-- Repeat für alle Komponentenarten -->
                      <?php
                      if(count($komponentenartenArray) > 0){
                          foreach($komponentenartenArray as $komponentenArt){
                              $selected = "";
                              if($ausgewaehlteKomponentenArt != null && $ausgewaehlteKomponentenArt-> kar_id == $komponentenArt->kar_id){
                                  $selected = "selected";
                              } else {
                                  $selected = "";
                              }
                              echo "<option $selected value='$komponentenArt->kar_id'>$komponentenArt->kar_id - $komponentenArt->kar_bezeichnung</option>";
                          }
                      }

                      ?>
                  </select>
                </fieldset>
                <button type="submit" class="btn btn-primary" name="search">Abschicken</button>
              </form>
              <div class="spacer"></div>
              <!-- Form um Produkte Anzulegen -->
              <!-- Felder müssen dynamisch angelegt werden, je nach Komponetenart -->
              <form method="post" action="../Produktpflege/Neubeschaffung.php">
                <fieldset class="form-group">
                  <label for="id">ID</label>
                  <input type="number" name="id" class="form-control" id="id"  disabled>
                </fieldset>
                <fieldset class="form-group">
                    <label for="Raum">Raum</label>
                      <select name="Raum" class="form-control" id="Raum" required>
                          <!-- Repeat für alle Komponentenarten -->
                          <?php
                          if(count($raumArray) > 0){
                              foreach($raumArray as $raum){
                                  $selected = "";
                                  if($raum != null && $raum->r_id == $ausgewaehlterRaumArt->kar_id){
                                      $selected = "selected";
                                  } else {
                                      $selected = "";
                                  }
                                  echo "<option $selected value='$raum->r_id'>$raum->r_id - $raum->r_nr</option>";
                              }
                          }
                          ?>
                      </select>
                  </fieldset>
                  <fieldset class="form-group">
                      <label for="Lieferant">Lieferant</label>
                          <select name="Lieferant" class="form-control" id="Lieferant" required>
                              <!-- Repeat für alle Komponentenarten -->
                               <?php
                              if(count($lieferantArray) > 0){
                                  foreach($lieferantArray as $lieferant){
                                      $selected = "";
                                      if($lieferant != null && $lieferant->l_id == $ausgewaehlterLieferant->l_id){
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
                  <fieldset class="form-group">
                      <label for="gewaehrleistung">Gewährleistung</label>
                      <input type="text" name="gewaehrleistung" class="form-control" id="gewaehrleistung"  required
                             value="<?php echo $ausgewaehltesGeraet->k_gewaehrleistung?>">
                  </fieldset>
                  <fieldset class="form-group">
                      <label for="notiz">ID</label>
                      <input type="text" name="notiz" class="form-control" id="notiz"  required
                             value="<?php echo $ausgewaehltesGeraet->k_notiz?>">
                  </fieldset>
                  <fieldset class="form-group">
                      <label for="hersteller">Hersteller</label>
                      <input type="text" name="hersteller" class="form-control" id="hersteller"  required
                             value="<?php echo $ausgewaehltesGeraet->k_hersteller?>">
                  </fieldset>
                  <?php
                  if(count($AttributArray) > 0) {
                      foreach ( $AttributArray as $Attribut)
                      {
                          ?>
                            <fieldset class="form-group">
                            <label for="<?php echo $dbKomponentenattributeDBAdapter->selectKomponentenAttributeFormID($Attribut) ?>"><?php $dbKomponentenattributeDBAdapter->selectKomponentenAttributeFormID($Attribut) ?></label>
                             <input type="text" name="<?php $dbKomponentenattributeDBAdapter->selectKomponentenAttributeFormID($Attribut) ?>" class="form-control" id="<?php $dbKomponentenattributeDBAdapter->selectKomponentenAttributeFormID($Attribut) ?>"  required
                             value="<?php echo $dbKomponentenattributeDBAdapter->selectKomponentenAttributeFormID($Attribut)?>">
                            </fieldset>
                          <?php
                      }
                  }
                  ?>
                  <button type="submit" class="btn btn-primary" name="insert">Hinzufügen</button>
              </form>
          </div>
        </div>
      </div>
</main>
<?php
require_once "../footer.php";
?>
