<?php
$init=parse_ini_file("../.ht.asetukset.ini");
try{
    $yhteys=mysqli_connect($init["databaseserver"], $init["username"], $init["password"], $init["database"]); #(db, user, password, dbname) otetaan yhteys tietokantaan kyseisillä tiedoilla
}
catch(Exception $e){
    header("../pages/yhteysvirhe.html");# jos yhteys ei onnistu niin siirry halutulle virhesivulle
    exit;
}
?>