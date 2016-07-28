<?php
require_once "../header.php";
?>
    <main>
        <div class="container">
            <div class="spacer"></div>
            <div class="headline">
                <h2>Software-Ausstattung</h2>
            </div>
            <hr class="trenner">
            <?php if($_SESSION["Benutzer"] instanceof BenutzerExtra): ?>
                <div class="row">
                <div class="col-md-2">
                  <!-- Form um Raum zu suchen -->
                    <form method="post" action="../Reporting/Software-Ausstattung.php">
                        <fieldset class="form-group">
                            <label for="select1">Raum suchen:</label>
                            <select class="form-control" id="select1">
                              <!-- Repeat für alle Räume -->
                                <option>1</option>
                            </select>
                        </fieldset>
                        <button style="width:100%;" type="submit" class="btn btn-primary">Suchen</button>
                    </form>
                </div>
            </div>
            <div class="spacer"></div>
            <!-- Table für Anzeige. Felder können selbst gewählt werden -->
            <table class="table">
                <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Art</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Apple MacBook Pro 15</td>
                    <td>Laptop</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Logitech Maus</td>
                    <td>Maus</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Benq Beamer</td>
                    <td>Beamer</td>
                </tr>
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
