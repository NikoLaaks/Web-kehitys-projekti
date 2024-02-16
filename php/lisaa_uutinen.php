<?php
    // Tarkista, onko lomakkeen tiedot lähetetty
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Yhdistetään tietokantaan
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    include('./connect.php');


    // Kerää lomakkeen tiedot muuttujiin
    $title = $_POST['title'];
    $url = $_POST['url'];
    $alt = $_POST['alt'];
    
    // Käsittely kuvalle
    $target_dir = "../images/uutiset/";
    // Muodostetaan täydellinen polku kuvalle
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    // Siirretään kuva väliaikaisesta sijainnista luotuun polkuun
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    // Luodaan sql kysely
    $sql = "INSERT INTO uutiset (title, url, imagename, alt) VALUES (?, ?, ?, ?)";
    //Valmistellaan sql kysely
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'ssss', $title, $url, $target_file, $alt);
    //Suoritetaan sql kysely
    $success = mysqli_stmt_execute($stmt);

    
    if ($success) {
        echo "Uutinen lisätty onnistuneesti!";
    } else {
        echo "Virhe: " . $yhteys->error;
    }
    // Sulje tietokantayhteys
    mysqli_stmt_close($stmt);
    mysqli_close($yhteys);
    
}
?>

<a href="../pages/admin.php">Palaa takaisin</a>
