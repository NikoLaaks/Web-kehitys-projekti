<?php
include('./connect.php');

// Haetaan kaikki uutiset tietokannasta
$tulos = mysqli_query($yhteys, "SELECT * FROM uutiset ORDER BY id DESC");
// Luodaan uutiset array
$uutiset = array();

// Uutisista muodostetaan oliot jotka sijoitetaan uutiset arrayihin
while ($rivi = mysqli_fetch_object($tulos)) {
    $uutiset[] = $rivi;
}
// Muutetaan array json muotoon
print json_encode($uutiset);
