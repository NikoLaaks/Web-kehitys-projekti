<?php
// Sessionin alku, mahdollistaa tietojen tallentamisen ja käytön eri sivuilla samalla käyttäjällä
session_start();
// Sessionin lopetus
session_unset();
// tuhoaa istunnon ja poistaa kaikki siihen liittyvät tiedot
session_destroy();
//Ohjataan etusivulle
header("Location:../index.php");
?>