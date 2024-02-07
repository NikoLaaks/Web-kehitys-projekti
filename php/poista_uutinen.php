<?php
//Yhdistetään tietokantaan
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include('./connect.php');

$poistettava=isset($_GET["poistettava"]) ? $_GET["poistettava"] : "";

//Jos tieto on annettu, poistetaan uutinen tietokannasta
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
            echo "Image not found.";
        }
    }
    
    $sql="delete from uutiset where id=?";
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