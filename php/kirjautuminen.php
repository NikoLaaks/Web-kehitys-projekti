<?php
    include('./connect.php');

    //Luetaan lomakkeelta tulleet tiedot funktiolla $_POST
    //jos syötteet ovat olemassa
    $kayttajanimi=isset($_POST["kayttajanimi"]) ? $_POST["kayttajanimi"] : "";
    $salasana=isset($_POST["salasana"]) ? $_POST["salasana"] : "";

    //Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
    //ohjataan pyyntö takaisin lomakkeelle
    if (empty($kayttajanimi) || empty($salasana)){
        header("Location:../pages/kirjautumis.php");
    exit;
}
    //Ohjelma etsii tietokannasta onko käyttäjää, salasanaa rekisteröity tietokantaan
    //Tarkistaa samalla onko admin oikeuksia, jos löytää tietokannasta tiedot -> ilmoitus käyttäjälle
    $result=mysqli_query($yhteys, "SELECT id, salasana, is_admin from kayttajat where kayttajatunnus= '$kayttajanimi'");

    //Puretaan result tiedot row muuttujaan / Tarkistaa onko tietoa
    if ($row = mysqli_fetch_assoc($result)) {
        //Tarkistaa salasanan hash, jos toimii, käyttäjä on kirjautunut sisään
        if (password_verify($salasana, $row['salasana'])) {
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['kayttajanimi'] = $kayttajanimi;
            $_SESSION['id'] = $row['id'];
            $_SESSION['is_admin'] = $row['is_admin'];
            
            echo("Kirjautuminen onnistui!");
        } else {
            echo("Kirjautuminen epäonnistui!");
        }
    } else {
        echo("Käyttäjätunnus ei löytynyt.");
    }

    $ok=mysqli_close($yhteys);

    ?>
    <!-- 2 sekunnin kuluttua siirtyy takaisin contact sivulle-->
    <meta http-equiv="refresh" content="2; url=../pages/contact.php" />

    