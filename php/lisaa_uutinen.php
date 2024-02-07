<?php
    // Tarkista, onko lomakkeen tiedot lähetetty
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Yhdistetään tietokantaan
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include('./connect.php');


    // Kerää lomakkeen tiedot
    $title = $_POST['title'];
    $url = $_POST['url'];
    $alt = $_POST['alt'];
    
    // Käsittely kuvalle
    $target_dir = "../images/uutiset/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    // Lisää tiedot tietokantaan
    $sql = "INSERT INTO uutiset (title, url, imagename, alt) VALUES ('$title', '$url', '$target_file', '$alt')";

    if ($yhteys->query($sql) === TRUE) {
        echo "Uutinen lisätty onnistuneesti!";
    } else {
        echo "Virhe: " . $sql . "<br>" . $yhteys->error;
    }

    // Sulje tietokantayhteys
    $yhteys->close();
    
}
?>

<a href="../pages/admin.php">Palaa takaisin</a>
