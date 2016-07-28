<?php
require_once "../header.php";
require_once "../database_entities/Raum.php";
require_once "../database_entities/komponente.php";
require_once "../module/Raummodul/RaumDBAdapter.php";
require_once "../module/Komponentenmodul/komponentenDbAdapter.php";


$raumDBAdapter = new RaumDBAdapter(null);
$kompoDBAdapter = new kompnenentenDbAdapter(null);

$alleRaeume = $raumDBAdapter->selectRaeumeOhneFiktivenRaum();

$alleKomponenten = null;

$ausgewaehlterRaum = null;

$statusDelete = null;
if(isset($_POST["ausmustern"])){
    var_dump($_POST);
    $alleZuLoeschendenIds = $_POST["checkList"];
    $raumId = $_POST["hiddenRaum"];
    foreach($alleZuLoeschendenIds as $id){
        $komponente = new komponente();
        $komponente->setKId($id);
        $kompoDBAdapter->deleteKomponenteById($komponente);
    }
    $statusDelete = "Erfolgreich ausgemustert";
} else if(isset($_POST["raumsenden"])){
    $raumId = $_POST["raum"];
    foreach ($alleRaeume as $raum){
        if($raumId == $raum->r_id){
            $ausgewaehlterRaum = $raum;
            break;
        }
    }
    $alleKomponenten = $kompoDBAdapter->getKomponentenByRaum($raumId);
    $alleKomponenten = $kompoDBAdapter->insertKompoKarBezeichnung($alleKomponenten);

}

?>
    <main>
        <div class="container">
            <div class="spacer"></div>
            <div class="headline">
                <h2>Ausmusterung</h2>
            </div>
            <hr class="trenner">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h3 id="hinzu">Gerät ausmustern</h3>
                    <!-- Form um nach Räumen zu suchen -->
                    <form method="post" action="../Produktpflege/Ausmusterung.php">
                      <fieldset class="form-group">
                        <label for="raum">Raum auswählen</label>
                          <select class="form-control" name="raum" id="raum">
                          <!-- Repeat für alle Räume -->
                        <?php
                            foreach($alleRaeume as $raum){

                                if($raumId != null && $raumId == $raum->r_id){
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                            echo "<option $selected value='$raum->r_id'>ID: $raum->r_id -- Raumnr.:$raum->r_nr</option>";
                            }
                        ?>
                        </select>
                      </fieldset>
                      <!-- Kann mit beliebigen Formfeldern erweitert werden -->
                      <button type="submit" class="btn btn-primary" name="raumsenden">Geräte Anzeigen</button>
                    </form>
                    <div class="spacer"></div>
                    <!-- Form um Produkte auszumustern --> 
                    <form method="post" action="../Produktpflege/Ausmusterung.php">
                        <input type="hidden" hidden="hidden" name="hiddenRaum" value="<?php echo $ausgewaehlterRaum->r_id;?>">
                        <label><?php echo @$statusDelete; ?></label>
                      <div class="checkbox">
                          <?php
                          if($ausgewaehlterRaum != null){
                            foreach ($alleKomponenten as $komponente){
                                echo "<label>";
                                echo "<input type='checkbox' name='checkList[]' value='".$komponente->getKId()."'> Id: " .$komponente->getKId()  ." -- " .$komponente->getKarBezeichnung() . " --&gt; ". $komponente->getKBezeichnung();
                                echo "</label><br/>";
                            }
                          } else {
                              echo "Bitte wählen Sie einen Raum aus!";
                          }
                          ?>
                      <br />
                    </div>
                    <button type="submit" class="btn btn-primary" name="ausmustern">Geräte Ausmustern</button>
                    </form>
                  </div>
                </div>
            </div>
    </main>
<?php
require_once "../footer.php";
?>
