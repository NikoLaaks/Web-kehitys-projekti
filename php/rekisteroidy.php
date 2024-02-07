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
    $uusikayttaja=isset($_POST["uusikayttaja"]) ? $_POST["uusikayttaja"] : "";
    $uusisalasana=isset($_POST["uusisalasana"]) ? $_POST["uusisalasana"] : "";
    $hashsalasana=password_hash($uusisalasana, PASSWORD_DEFAULT);

    //Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
    //ohjataan pyyntö takaisin lomakkeelle
    if (empty($uusikayttaja) || empty($uusisalasana)){
    exit;
}
    $sql="insert into kayttajat (kayttajatunnus, salasana) values(?, ?)";

    //Valmistellaan sql-lause
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttujat oikeisiin paikkoihin
    mysqli_stmt_bind_param($stmt, 'ss', $uusikayttaja, $hashsalasana);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);
    //Suljetaan tietokantayhteys
    mysqli_close($yhteys);
    header("Location:../pages/kirjautumis.php");
exit;
?>