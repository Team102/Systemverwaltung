<!-- Include Header -->
<?php
require_once '../header.php';
require_once "../database_entities/Benutzer.php";
require_once "../database_entities/komponentenDbAdapter.php";
require_once "../module/Komponentenmodul/komponentenDbAdapter.php";
session_start();
?>
<?php session_start();?>
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
                  <label for="template">Welche Komponente soll angelegt werden?:</label>
                  <select class="form-control" name="template" id="template">
                    <!-- Repeat für alle Komponentenarten -->
                    <option value="">ID - Komponente</option>
                  </select>
                </fieldset>
                <button type="submit" class="btn btn-primary">Abschicken</button>
              </form>
              <div class="spacer"></div>
              <!-- Form um Produkte Anzulegen -->
              <!-- Felder müssen dynamisch angelegt werden, je nach Komponetenart -->


              <?php
              //hinzufuegen komponente
              if(isset($_POST["btnHinzu"])){

                  $komp = new komponente();
                  $komp->setB_ID($result["b_id"]);
                  $komp->setL_ID($result["l_id"]);
                  $komp->setR_ID($result["r_id"]);
                  $komp->setK_Notitz($result["k_notitz"]);
                  $komp->setK_Geweahrleistungen($result["k_gewaehrleistungen"]);
                  $komp->setK_Hersteller($result["k_hersteller"]);
                  $komp->setKAR_ID($result["kar_id"]);

                  $kompnenetenList[] = $komp;
                  echo "NICE1!";

                  //TODO check for errors
                  $komp = new komponente();
                  $komp->setB_ID($result["b_id"]);
                  $komp->setL_ID($result["l_id"]);
                  $komp->setR_ID($result["r_id"]);
                  $komp->setK_Notitz($result["k_notitz"]);
                  $komp->setK_Geweahrleistungen($result["k_gewaehrleistungen"]);
                  $komp->setK_Hersteller($result["k_hersteller"]);
                  $komp->setKAR_ID($result["kar_id"]);

                  echo "NICE1.2";
                  $dbAdapter = new komponentenDbAdapter (null);
                  echo "NICE2!";

                  $id = $dbAdapter->insertKomponente($komponente);
                  echo "NICE3";

                  $infoString = "Neue Komponente mit der Id: " . $id . " wurde in die Datenbank eingefügt";

              }
              ?>



              <form method="post" action="../Produktpflege/Neubeschaffung.php">
                <fieldset class="form-group">
                  <label for="id">ID</label>
                  <input type="number" name="id" class="form-control" id="id" disabled>
                </fieldset>
                  <fieldset class="form-group">
                    <label for="name">Attribut</label>
                    <input type="text" name="" class="form-control" id="name" required>
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="password">Attribut</label>
                    <input type="text" name="" class="form-control" id="password" required>
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="gruppe">Attribut</label>
                    <select class="form-control" name="gruppe" id="gruppe">
                      <option value="">Attribut</option>
                    </select>
                  </fieldset>
                  <button type="submit" class="btn btn-primary">Hinzufügen</button>
              </form>
          </div>
        </div>
      </div>
</main>
<?php
require_once "../footer.php";
?>
