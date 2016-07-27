<?php
require_once '../header.php';
 ?>
        <main>
            <div class="container">
                <div class="spacer"></div>
                <div class="headline">
                    <h2>Benutzerverwaltung</h2>
                    <!-- Sprungmarken -->
                    <p><a class="nav-link" href="#hinzu">Hinzufügen</a> // <a class="nav-link" href="#aend">Ändern</a> // <a class="nav-link" href="#del">Löschen</a></p>
                </div>
                <hr class="trenner">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3 id="hinzu">Benutzer hinzufügen</h3>
                        <!-- Form um Benutzer hinzuzufügen -->
                        <!-- Namen entsprechend setzen -->
                        <form method="post" action="../Stammdaten/Benutzer.php">
                          <fieldset class="form-group">
                            <label for="id">ID</label>
                            <input type="number" name="id" class="form-control" id="id" disabled>
                          </fieldset>
                            <fieldset class="form-group">
                              <label for="name">Benutzername</label>
                              <input type="text" name="" class="form-control" id="name" required>
                            </fieldset>
                            <fieldset class="form-group">
                              <label for="password">Passwort</label>
                              <input type="password" name="" class="form-control" id="password" required>
                            </fieldset>
                            <fieldset class="form-group">
                              <label for="gruppe">Gruppe</label>
                              <select class="form-control" name="gruppe" id="gruppe">
                                <option value="">Gruppenname</option>
                              </select>
                            </fieldset>
                            <button type="submit" class="btn btn-primary">Abschicken</button>
                        </form>
                    </div>
                  </div>
                  <hr class="trenner">
                  <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                          <h3 id="aend">Benutzer Ändern</h3>
                          <!-- Form um einen Beutzer zu suchen -->
                          <form method="post" action="../Stammdaten/Benutzer.php">
                            <fieldset class="form-group">
                              <label for="search">Benutzer suchen: </label>
                              <select class="form-control" name="searchfield" id="search">
                                <!-- Repeat für alle Benutzer -->
                                <option value="" >ID - Benutzername</option>
                              </select>
                            </fieldset>
                            <button type="submit" class="btn btn-primary" name="searchSubmit">Suchen</button>
                          </form>
                          <div class="spacer"></div>
                          <!-- Form um einen Benutzer zu ändern -->
                          <form method="post" action="../Stammdaten/Benutzer.php">
                            <fieldset class="form-group">
                              <label for="id">ID</label>
                              <input type="number" name="id" class="form-control" id="id" disabled>
                            </fieldset>
                              <fieldset class="form-group">
                                <label for="name">Benutzername</label>
                                <input type="text" name="" class="form-control" id="name" required value="MaxMustermann" placeholder="MaxMustermann">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="password">Passwort</label>
                                <input type="password" name="" class="form-control" id="password" required value="1234" placeholder="1234">
                              </fieldset>
                              <fieldset class="form-group">
                                <label for="gruppe">Gruppe</label>
                                <select class="form-control" name="gruppe" id="gruppe">
                                  <option value="" selected>Gruppenname</option>
                                </select>
                              </fieldset>
                              <button type="submit" class="btn btn-primary">Abschicken</button>
                          </form>
                      </div>
                    </div>
                    <hr class="trenner">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 id="del">Benutzer löschen</h3>
                            <!-- Form um einen Benutzer zu löschen -->
                            <form method="post" action="../Stammdaten/Benutzer.php">
                              <fieldset class="form-group">
                                <label for="raum">Benutzer: </label>
                                <select class="form-control" name="deleteField" id="raum">
                                  <option value="" >ID - Benutzername</option>
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
