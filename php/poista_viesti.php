<?php
session_start();

//Tarkistetaan onko käyttäjällä admin oikeudet
if(!isset($_SESSION['is_admin'])|| $_SESSION['is_admin'] == 0) {
    header("Location:./kirjautumis.php");
    exit();
}
//Yhdistetään tietokantaan
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include('./connect.php');

$poistettava=isset($_GET["poistettava"]) ? $_GET["poistettava"] : "";
// Tarkistetaan onko saatu poistettavan viestin id
if (!empty($poistettava)){
    
    $sql="DELETE FROM contact WHERE id=?";
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttuja sql-lauseeseen
    mysqli_stmt_bind_param($stmt, 'i', $poistettava);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);
}
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
//ja ohjataan pyyntö takaisin listaukseen
header("Location:../pages/admin.php");
exit;
?>