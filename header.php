<?php
require_once "database_entities/Benutzer.php";
session_start();
$istAngemeldet = false;
if($_SESSION["Benutzer"] instanceof Benutzer) $istAngemeldet = true;
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <title>IC - FB3</title>

    <!--Favicon-->
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />

    <!--Metaviewport für Responsiveansicht-->
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!-- CSS -->
    <link rel="stylesheet" href="/fonts/font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="/scss/main.css">
</head>
<body>
<header>
    <div class="container">
        <div class="top-bar"></div>
        <!--Logo mit Link zu Root-->
        <a href="/">
            <img class="logo" src="/images/Logo.png">
        </a>
    </div>
    <nav class="navbar navbar-default">

        <!-- Toggle Button -->
        <button class="navbar-toggler hidden-sm-up collapse" type="button" data-toggle="collapse" data-target="#nav-content">
            ☰
        </button>

        <!-- Nav Content Mobil-->
        <div class="collapse in navbar-toggleable-xs hidden-sm-up" id="nav-content">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/Stammdaten/Stammdaten.php">Stammdaten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Produktpflege/Produktpflege.php">Produktpflege</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Reporting/Reporting.php">Reporting</a>
                    </li>
                    <?php if(!$istAngemeldet): ?>
                    <li class="nav-item pull-right">
                        <a class="nav-link" href="/login.php"><i class="fa fa-sign-in"></i> Login</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item pull-right">
                        <a class="nav-link" href="/logout.php"><i class="fa fa-sign-out"> Abmelden</i></a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Nav Content Desktop u Tablet-->
        <div class="hidden-xs-down">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Stammdaten</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/Stammdaten/Lieferanten.php">Lieferanten</a>
                            <a class="dropdown-item" href="/Stammdaten/Raeume.php">Räume</a>
                            <a class="dropdown-item" href="/Stammdaten/Benutzer.php">Benutzer</a>
                            <a class="dropdown-item" href="/Stammdaten/Komponentenart.php">Komponentenart</a>
                            <a class="dropdown-item" href="/Stammdaten/Komponentenattribut.php">Komponentenattribut</a>
                            <a class="dropdown-item" href="/Stammdaten/Zuweisung.php">Zuweisung</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Produktpflege</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/Produktpflege/Neubeschaffung.php">Neubeschaffung</a>
                            <a class="dropdown-item" href="/Produktpflege/Ausmusterung.php">Ausmusterung</a>
                            <a class="dropdown-item" href="/Produktpflege/Wartung.php">Wartung</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Reporting</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/Reporting/Geraeteausstattung.php">Geräteausstattung</a>
                            <a class="dropdown-item" href="/Reporting/Hardware-Ausstattung.php">Hardware-Ausstattung</a>
                            <a class="dropdown-item" href="/Reporting/Software-Ausstattung.php">Software-Ausstattung</a>
                            <a class="dropdown-item" href="/Reporting/Suchen.php">Geräte suchen</a>
                        </div>
                    </li>
                    <?php if(!$istAngemeldet): ?>
                        <li class="nav-item pull-right">
                            <a class="nav-link" href="/login.php"><i class="fa fa-sign-in"></i> Login</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item pull-right">
                            <a class="nav-link" href="/logout.php"><i class="fa fa-sign-out"></i> Abmelden</a>
                        </li>
                        <li class="nav-item pull-right">
                            <span  class="nav-link" style="font-weight:bold;">Hallo <?php echo $_SESSION["Benutzer"]->be_login?></span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!--Barba Wrapper und Container für Caching-->
<div id="barba-wrapper">
<div class="barba-container">