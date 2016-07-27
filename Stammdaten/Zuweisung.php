<?php
require_once '../header.php';
 ?>
        <main>
            <div class="container">
                <div class="spacer"></div>
                <div class="headline">
                    <h2>Komponentenzuweisung</h2>
                </div>
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
                              <option value="">ID - Komponentenart</option>
                            </select>
                          </fieldset>
                          <fieldset class="form-group">
                            <label>
                              <!-- Repeat für alle Attribute -->
                              <input type="checkbox" name="" value="">Attribut 1
                              <br />
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
