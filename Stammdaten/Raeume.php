<?php
require_once '../header.php';
 ?>
        <main>
            <div class="container">
                <div class="spacer"></div>
                <div class="headline">
                    <h2>Raumverwaltung</h2>
                    <!-- Sprungmarken -->
                    <p><a class="nav-link" href="#hinzu">Hinzufügen</a> // <a class="nav-link" href="#aend">Ändern</a> // <a class="nav-link" href="#del">Löschen</a></p>
                </div>
                <hr class="trenner">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Raum hinzufügen</h3>
                        <!-- Form um Räume hinzuzufügen -->
                        <!-- Namen entsprechend setzen für Auswertung in PHP -->
                        <form method="post" action="../Stammdaten/Raeume.php">
                          <fieldset class="form-group">
                            <label for="id">ID</label>
                            <input type="number" name="id" class="form-control" id="id" disabled>
                          </fieldset>
                            <fieldset class="form-group">
                              <label for="nummer">Raumnummer</label>
                              <input type="number" name="" class="form-control" id="nummer" required>
                            </fieldset>
                            <fieldset class="form-group">
                              <label for="bez">Bezeichnung</label>
                              <input type="text" name="" class="form-control" id="bez" required>
                            </fieldset>
                            <fieldset class="form-group">
                              <label for="notiz">Notiz</label>
                              <textarea  type="text" name="" class="form-control" id="notiz" maxlength="1024"></textarea>
                            </fieldset>
                            <button type="submit" class="btn btn-primary">Abschicken</button>
                        </form>
                    </div>
                  </div>
                  <hr class="trenner">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Raum Ändern</h3>
                          <!-- Form um ein Raum zu Suchen -->
                          <form method="post" action="../Stammdaten/Raeume.php">
                            <fieldset class="form-group">
                              <label for="search">Raum suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für Alle Räume -->
                                <option value="" >ID - Raumnummer</option>
                              </select>
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="searchSubmit">Suchen</button>
                          </form>
                          <div class="spacer"></div>
                          <!-- Form um Raum zu ändern -->
                          <!-- Values und Placeholder dynamisch befüllen -->
                          <form method="post" action="../Stammdaten/Raeume.php">
                            <fieldset class="form-group">
                              <label for="id">ID</label>
                              <input type="number" name="id" class="form-control" id="id" placeholder="" disabled value="1" placeholder="1">
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="nummer">Raumnummer</label>
                                <input type="number" name="" class="form-control" id="nummer" required value="102" placeholder="102">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="bez">Bezeichnung</label>
                                <input type="text" name="" class="form-control" id="bez" required value="Lorem Ipsum" placeholder="Lorem Ipsum" maxlength="1024">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="notiz">Notiz</label>
                                <textarea type="text" name="" class="form-control" id="notiz"  value="Mustertext" placeholder="Mustertext"></textarea>
                              </fieldset>
                              <button type="submit" class="btn btn-primary">Abschicken</button>
                          </form>
                      </div>
                    </div>
                    <hr class="trenner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 id="del">Raum löschen</h3>
                            <!-- Form um Raum zu löschen -->
                            <form method="post" action="../Stammdaten/Raeume.php">
                              <fieldset class="form-group">
                                <label for="raum">Raum: </label>
                                <select class="form-control" name="deleteField" id="raum">
                                  <!-- Repeat für alle Räume -->
                                  <option value="" >ID - Raum</option>
                                </select>
                              </fieldset>
                              <button type="submit" class="btn btn-danger" value="delete" id="delete">Löschen</button>
                            </form>
                        </div>
                      </div>
            </div>
        </main>
        <?php
        require_once '../footer.php';
         ?>
