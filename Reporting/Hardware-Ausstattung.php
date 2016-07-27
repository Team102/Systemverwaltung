<?php
    require_once "../header.php";
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
                        <select class="form-control" id="select1">
                          <!-- Repeat für alle Komponentenarten -->
                            <option value="Laptop">Laptop</option>
                        </select>
                    </fieldset>
                    <button style="width:100%;" type="submit" class="btn btn-primary">Suchen</button>
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
                <td>Acer Aspire 15G</td>
                <td>Laptop</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Irgend ein Laptop</td>
                <td>Laptop</td>
            </tr>
            </tbody>
        </table>
      </div>
</main>
<?php
require_once "../footer.php";
?>
