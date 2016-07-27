<?php
require_once "../header.php";
?>
    <main>
        <div class="container">
            <div class="spacer"></div>
            <div class="headline">
                <h2>Geräteausstattung</h2>
            </div>
            <hr class="trenner">
            <div class="row">
                <div class="col-md-2">
                  <!-- Form um Raum zu suchen -->
                  <!-- Values und Namen bitte anpassen -->
                    <form method="post" action="../Reporting/Geraeteausstattung.php">
                        <fieldset class="form-group">
                            <label for="select1">Raum suchen:</label>
                            <select class="form-control" id="select1">
                              <!-- Repeat für alle Räume -->
                                <option value="101">R101</option>
                            </select>
                        </fieldset>
                        <button style="width:100%;" type="submit" class="btn btn-primary">Suchen</button>
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
                <tr>
                    <th scope="row">1</th>
                    <td>Apple MacBook Pro 15</td>
                    <td>Laptop</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>BENQ</td>
                    <td>Beamer</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Logitech</td>
                    <td>Maus</td>
                </tr>
                </tbody>
            </table>
        </div>
    </main>
<?php
require_once "../footer.php";
?>
