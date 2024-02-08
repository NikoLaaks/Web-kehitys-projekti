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
    $sql = "INSERT INTO uutiset (title, url, imagename, alt) VALUES (?, ?, ?, ?)";
    //Valmistellaan sql-lause
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'ssss', $title, $url, $target_file, $alt);
    //Suoritetaan sql-lause
    $success = mysqli_stmt_execute($stmt);
    //Suljetaan tietokantayhteys
    
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
