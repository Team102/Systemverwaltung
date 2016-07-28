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

$alleKomponentenArten = $kompArtAdapter->selectKomponentenarten();

$alleKomponenten = null;
$ausgewaehlteKompArt = null;

if(isset($_POST["search"])){
    $kompId = $_POST["select"];
    foreach ($alleKomponentenArten as $komponentenArt){
        if($kompId == $komponentenArt){
            $ausgewaehlteKompArt = $komponentenArt;
            break;
        }
    }

    //TODO2: Wartung-> machen, dass ist noch nicht fertig
    $alleKomponenten = $kompDBAdapter->getKomponentenByArt($kompId);
    $alleKomponenten = $kompDBAdapter->insertKompoRaumBezeichnung($alleKomponenten);
}
?>
<main>
    <div class="container">
        <div class="spacer"></div>
        <div class="headline">
            <h2>Hardware-Ausstattung</h2>
        </div>
        <hr class="trenner">
        <div class="row">
            <div class="col-md-2">
              <!-- Form um Komponentenart zu suchen -->
                <form method="post" action="../Reporting/Hardware-Ausstattung.php">
                    <fieldset class="form-group">
                        <label for="select1">Komponente suchen:</label>
                        <select class="form-control" id="select1" name="select">
                          <!-- Repeat für alle Komponentenarten -->
                            <?php
                                foreach ($alleKomponentenArten as $kompArt){
                                    if($kompId != null && $kompId == $kompArt->kar_id){
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='$kompArt->kar_id'>$kompArt->kar_bezeichnung</option>";
                                }
                            ?>
                        </select>
                    </fieldset>
                    <button style="width:100%;" type="submit" class="btn btn-primary" name="search">Suchen</button>
                </form>
            </div>
        </div>
        <div class="spacer"></div>
        <!-- Table für Anzeige. Attribute können selbst gewählt werden -->
        <table class="table">
            <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Raum</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(count($alleKomponenten) > 0) {
                foreach ($alleKomponenten as $komponente) {
                    echo "<tr>";
                    echo "<td>" . $komponente->getKId() . "</td>";
                    echo "<td>" . $komponente->getKBezeichnung() . "</td>";
                    echo "<td>" . $komponente->getRId() . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td>----</td>";
                echo "<td>Keine Geräte dieser Art vorhanden</td>";
                echo "<td>----</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
      </div>
</main>
<?php
require_once "../footer.php";
?>
