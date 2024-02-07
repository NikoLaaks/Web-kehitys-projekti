<?php
    //initials=parse_ini_file("./.ht.asetukset.ini");
    try{
        //$yhteys=mysqli_connect($initials["palvelin"], $initials["tunnus"], $initials["pass"], $initials["tk"]);
        $yhteys=mysqli_connect("db", "root", "password", "testiuutiset");
    
    }
        catch(Exception $e){
        header("Location:./yhteysvirhe.html");
    exit;
}

    //Luetaan lomakkeelta tulleet tiedot funktiolla $_POST
    //jos syötteet ovat olemassa
    $kayttajanimi=isset($_POST["kayttajanimi"]) ? $_POST["kayttajanimi"] : "";
    $salasana=isset($_POST["salasana"]) ? $_POST["salasana"] : "";

    //Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
    //ohjataan pyyntö takaisin lomakkeelle
    if (empty($kayttajanimi) || empty($salasana)){
        header("Location:../pages/kirjautuminen.php");
    exit;
}
    $result=mysqli_query($yhteys, "SELECT salasana from kayttajat where kayttajatunnus= '$kayttajanimi'");

    if ($row = mysqli_fetch_assoc($result)) {
        // Tarkista salasana hash
        if (password_verify($salasana, $row['salasana'])) {
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['kayttajanimi'] = $kayttajanimi;
            
            echo("Kirjautuminen onnistui!");
        } else {
            echo("Kirjautuminen epäonnistui!");
        }
    } else {
        echo("Käyttäjätunnus ei löytynyt.");
    }

    $ok=mysqli_close($yhteys);

    ?>

    <meta http-equiv="refresh" content="2; url=../pages/contact.php" />

    