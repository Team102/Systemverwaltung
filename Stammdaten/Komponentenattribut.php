<?php
require_once '../header.php';
 ?>
        <main>
            <div class="container">
                <div class="spacer"></div>
                <div class="headline">
                    <h2>Komponentenattribut</h2>
                    <!-- Sprungmarken -->
                    <p><a class="nav-link" href="#hinzu">Hinzufügen</a> // <a class="nav-link" href="#aend">Ändern</a> // <a class="nav-link" href="#del">Löschen</a></p>
                </div>
                <hr class="trenner">
                <?php if($_SESSION["Benutzer"] instanceof BenutzerExtra): ?>
                    <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Komponentenattribut hinzufügen</h3>
                        <!-- Form um ein Attribut hinzuzufügen -->
                        <form method="post" action="../Stammdaten/Komponentenattribut.php">
                          <fieldset class="form-group">
                            <label for="id">ID</label>
                            <input type="number" name="id" class="form-control" id="id" disabled>
                          </fieldset>
                            <fieldset class="form-group">
                              <label for="bez">Bezeichnung</label>
                              <input type="text" name="" class="form-control" id="bez" required>
                            </fieldset>
                            <button type="submit" class="btn btn-primary">Abschicken</button>
                        </form>
                    </div>
                  </div>
                  <hr class="trenner">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Komponentenattribut Ändern</h3>
                          <!-- Formm um Komponentenattribut zu suchen -->
                          <form method="post" action="../Stammdaten/Komponentenattribut.php">
                            <fieldset class="form-group">
                              <label for="search">Komponentart suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für alle Komponentenarten -->
                                <option value="" >ID - Komponentenartname</option>
                              </select>
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="searchSubmit">Suchen</button>
                          </form>
                          <div class="spacer"></div>
                          <!-- Form für Komponentenattribut ändern -->
                          <form method="post" action="../Stammdaten/Komponentenattribut.php">
                            <fieldset class="form-group">
                              <label for="id">ID</label>
                              <input type="number" name="id" class="form-control" id="id" disabled>
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="bez">Komponentenbezeichnung</label>
                                <input type="text" name="" class="form-control" id="bez" required value="Musterbezeichnung" placeholder="Musterbezeichnung">
                              </fieldset>
                              <button type="submit" class="btn btn-primary">Abschicken</button>
                          </form>
                      </div>
                    </div>
                    <hr class="trenner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 id="del">Komponentenattribut löschen</h3>
                            <!-- Form um Komponenenattribut zu löschen -->
                            <form method="post" action="../Stammdaten/Komponentenattribut.php">
                              <fieldset class="form-group">
                                <label for="raum">Komponentenattribut: </label>
                                <select class="form-control" name="deleteField" id="raum">
                                  <option value="" >ID - Komponentenattributbezeichnung</option>
                                </select>
                              </fieldset>
                              <button type="submit" class="btn btn-danger" value="delete" id="delete">Löschen</button>
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
