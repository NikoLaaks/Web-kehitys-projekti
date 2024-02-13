<?php
include('./connect.php');

$tulos = mysqli_query($yhteys, "SELECT * FROM uutiset ORDER BY id DESC");
$uutiset = array();

while ($rivi = mysqli_fetch_object($tulos)) {
    $uutiset[] = $rivi;
}

print json_encode($uutiset);
