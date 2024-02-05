<?php
//Yhdistetään tietokantaan
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include("./connect.php");

# haetaan uutiset taulusta title, url ja kuvan tiedostonimi
$tulos=mysqli_query($yhteys, "SELECT title, url, imagename FROM uutiset");



?>