<?php
require_once "../header.php";
require_once "../database_entities/Raum.php";
require_once "../database_entities/komponente.php";
require_once "../database_entities/KomponentenArten.php";
require_once "../database_entities/KomponentenAttribute.php";
require_once "../database_entities/KomponenteHatAttribute.php";
require_once "../module/Raummodul/RaumDBAdapter.php";
require_once "../module/Komponentenarten/KomponentenartenDBAdapter.php";
require_once "../module/Komponentenmodul/komponentenDbAdapter.php";
require_once "../module/komponentenattribute/KomponentenattributeDBAdapter.php";
require_once "../module/KomponenteHatAttributeModul/KompneneteHatAttributeDBModul.php";


$kompDBAdapter = new kompnenentenDbAdapter(null);
$kompArtAdapter = new KomponentenartenDBAdapter(null);
$kompArtAttrAdapter = new KomponentenAttributeDBAdapter(null);
$kompArtHatAttrAdapter = new KomponenteHatAttributeDbAdapter(null);
$raumAdapter = new RaumDBAdapter(null);

$alleRaeume = $raumAdapter->selectRaeumeOhneFiktivenRaum();
$alleKomponenten = null;

$ausgewaehlterRaum = null;

if(isset($_POST["raumsenden"])){
    $raumId = $_POST["raum"];
    foreach ($alleRaeume as $raum){
        if($raumId == $raum->r_id){
            $ausgewaehlterRaum = $raum;
            break;
        }
    }
    $alleKomponenten = $kompDBAdapter->getKomponentenByRaum($raumId);
    $alleKomponenten = $kompDBAdapter->insertKompoKarBezeichnung($alleKomponenten);

} else if(isset($_POST["warten"])){

}
?>
<main>
    <div class="container">
        <div class="spacer"></div>
        <div class="headline">
            <h2>Wartung</h2>
        </div>
        <hr class="trenner">
        <?php if(@$_SESSION["Benutzer"] instanceof BenutzerExtra && $_SESSION["Benutzer"]->darfAlles): ?>
            <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3 id="hinzu">Gerät Warten</h3>
                <!-- Form um Räume zu suchen -->
                <form method="post" action="../Produktpflege/Wartung.php">
                  <fieldset class="form-group">
                    <label for="raum">Raum auswählen</label>
                    <select class="form-control" name="raum" id="raum">
                        <?php
                        foreach($alleRaeume as $raum){

                            if(@$raumId != null && $raumId == $raum->r_id){
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option $selected value='$raum->r_id'>ID: $raum->r_id -- Raumnr.:$raum->r_nr</option>";
                        }
                        ?>
                    </select>
                  </fieldset>
                  <button type="submit" class="btn btn-primary" name="raumsenden">Geräte Anzeigen</button>
                </form>
                <div class="spacer"></div>
                <!-- Form für Wartung von Geräten -->
                <!-- Felder können verändert werden -->
                <form method="post" action="../Produktpflege/Wartung.php">
                  <div class="checkbox">
                      <?php
                      if($ausgewaehlterRaum != null){
                          if(count($alleKomponenten) > 0) {
                              foreach ($alleKomponenten as $komponente) {
                                  echo "<label>";
                                  echo "<input type='checkbox' name='checkList[]' value='" . $komponente->getKId() . "'> Id: " . $komponente->getKId() . " -- " . $komponente->getKarBezeichnung() . " --&gt; " . $komponente->getKBezeichnung();
                                  echo "</label><br/>";
                              }
                          } else {
                              echo "Dieser Raum besitzt keine Geräte!";
                          }
                      } else {
                          echo "Bitte wählen Sie einen Raum aus!";
                      }
                      ?>
                  <br />
                </div>
                <button type="submit" class="btn btn-primary" name="warten">Geräte Warten</button>
                </form>
              </div>
            </div>
        <?php else: ?>
            <label style="color:red; font-weight: bold;">Sie sind nicht Berechtigt diese Webseite zu benutzen.</label>
        <?php endif; ?>
    </div>
</main>
<?php
require_once "../footer.php";
?>
