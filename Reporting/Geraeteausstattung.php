<?php
require_once "../header.php";
require_once "../database_entities/Raum.php";
require_once "../database_entities/komponente.php";
require_once "../database_entities/komponenteMitKarUndRaum.php";
require_once "../module/Raummodul/RaumDBAdapter.php";
require_once "../module/Komponentenmodul/komponentenDbAdapter.php";

$kompDBAdapter = new kompnenentenDbAdapter(null);
$kompArtAdapter = new KomponentenartenDBAdapter(null);
$raumAdapter = new RaumDBAdapter(null);

$alleRaeume = $raumAdapter->selectRaeume();
$alleKomponenten = null;
$ausgewaehlterRaum = null;

if(isset($_POST["search"])){
    $raumId = $_POST["select"];
    foreach ($alleRaeume as $raum){
        if($raumId == $raum->r_id){
            $ausgewaehlterRaum = $raum;
            break;
        }
    }

    $alleKomponenten = $kompDBAdapter->getKomponentenByRaum($raumId);
    $alleKomponenten = $kompDBAdapter->insertKompoKarBezeichnung($alleKomponenten);
}
?>
    <main>
        <div class="container">
            <div class="spacer"></div>
            <div class="headline">
                <h2>Geräteausstattung</h2>
            </div>
            <hr class="trenner">
            <?php if(@$_SESSION["Benutzer"] instanceof BenutzerExtra): ?>
            <div class="row">
                <div class="col-md-2">
                  <!-- Form um Raum zu suchen -->
                  <!-- Values und Namen bitte anpassen -->
                    <form method="post" action="../Reporting/Geraeteausstattung.php">
                        <fieldset class="form-group">
                            <label for="select1">Raum suchen:</label>
                            <select class="form-control" id="select1" name="select">
                                <?php
                                foreach($alleRaeume as $raum){

                                    if($raumId != null && $raumId == $raum->r_id){
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option $selected value='$raum->r_id'>$raum->r_id -- Raumnr.:$raum->r_nr</option>";
                                }
                                ?>
                            </select>
                        </fieldset>
                        <button style="width:100%;" type="submit" class="btn btn-primary" name="search">Suchen</button>
                    </form>
                </div>
            </div>
            <div class="spacer"></div>
            <!-- Table mit Werten Füllen. Daten können angepasst werden -->
            <table class="table">
                <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Art</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if(count($alleKomponenten) > 0) {
                        foreach ($alleKomponenten as $komponente) {
                            echo "<tr>";
                            echo "<td>" . $komponente->getKId() . "</td>";
                            echo "<td>" . $komponente->getKBezeichnung() . "</td>";
                            echo "<td>" . $komponente->getKarBezeichnung() . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td>----</td>";
                        echo "<td>Keine Geräte im Raum</td>";
                        echo "<td>----</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
            <?php else: ?>
                <label style="color:red; font-weight: bold;">Sie sind nicht Berechtigt diese Webseite zu benutzen.</label>
            <?php endif; ?>
        </div>
    </main>
<?php
require_once "../footer.php";
?>
