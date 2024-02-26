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

// Tarkistetaan onko saatu uutisen id
$poistettava=isset($_GET["id"]) ? $_GET["id"] : "";

//Jos id ei ole tyhjä niin suoritetaan poisto
if (!empty($poistettava)){
    // Hae kuvan tiedostonimi
    $sql_select = "SELECT imagename FROM uutiset WHERE id=?";
    $stmt_select = mysqli_prepare($yhteys, $sql_select);
    mysqli_stmt_bind_param($stmt_select, 'i', $poistettava);
    mysqli_stmt_execute($stmt_select);

    $tulos = mysqli_stmt_get_result($stmt_select);

    if ($row = mysqli_fetch_assoc($tulos)) {
        $image_name = $row['imagename'];

        // Rakennetaan polku oikeaan kansioon
        $image_path = "../images/" . $image_name;

        // Poista tiedosto kansiosta
        if (file_exists($image_path)) {
            unlink($image_path);
            
        } else {
            echo "Kuvaa ei löytynyt";
        }
    }
    
    $sql="delete from uutiset where id=?";
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttuja sql-lauseeseen
    mysqli_stmt_bind_param($stmt, 'i', $poistettava);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}else{
    echo 'Poistettavan uutisen id puuttuu';
}
