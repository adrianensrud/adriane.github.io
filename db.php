<?php
$servernavn = "localhost"; // Servernavn
$brukernavn = "root"; // Brukernavn for databasen
$passord = ""; // Passord for databasen
$dbnavn = "eksamen"; // Navnet på databasen

// Oppretter tilkobling til databasen
$con = mysqli_connect($servernavn, $brukernavn, $passord, $dbnavn);

// Sjekker tilkoblingen
if (!$con) {
    die("Tilkobling mislyktes: " . mysqli_connect_error());
}
?>