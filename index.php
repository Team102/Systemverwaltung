<?php
 require_once "header.php";
?>
<main>
    <div class="container">

        <div class="spacer"></div>

        <div class="headline">
            <h2>Herzlich Willkommen</h2>
            <p>Verwaltungssysstem der Martin-Segitz-Schule</p>
        </div>

        <hr class="trenner">

        <div class="row wrapNavigation text-center">
            <div class="col-md-4 col-sm-4">
                <div class="nav">
                    <img src="images/daten.jpg" alt="">
                    <h2>Stammdaten</h2>
                    <a href="Stammdaten/Stammdaten.php" class="btn btn-main">Click</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="nav top">
                    <img src="images/pflege.jpg" alt="">
                    <h2>Produktpflege</h2>
                    <a href="Produktpflege/Produktpflege.php" class="btn btn-main">Click</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="nav">
                    <img src="images/reporting.jpg" alt="">
                    <h2>Reporting</h2>
                    <a href="Reporting/Reporting.php" class="btn btn-main">Click</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    require_once "footer.php";
?>
