<?php
// Start the session
session_start();

// Check if the user is logged in and is an admin
if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    // User is logged in as an admin, show the admin page
    echo "Tervetuloa admin sivulle!";
} else {
    // User is not logged in as an admin, redirect them to another page
    header("Location:./kirjautumis.php"); // Redirect to the login page
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
</head>
<body>
    <h2>Ohjeet uutisen lisääminen</h2>
    <p>Kirjoita url muodossa osoite.fi eli vain www. jälkeen tulevat. <br>Muista antaa alt kohtaan lyhyt teksti mitä on kuvassa</p>

    <form action="../php/lisaa_uutinen.php" method="post" enctype="multipart/form-data">
        <label for="title">Otsikko:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="url">URL:</label>
        <input type="text" id="url" name="url" required><br>

        <label for="alt">Alt:</label>
        <input type="text" id="alt" name="alt" required><br>

        <label for="image">Kuva:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

        <input type="submit" value="Lisää Uutinen">
        <!--Lisää tähän vielä joku preview tietokannassa olevista uutisista ja poisto mahdollisuus niille
        esim otsikon perusteella poisto mahdollisuus-->
        <ol>
            <?php
            //Yhdistetään tietokantaan
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            include("../php/connect.php");


            $tulos=mysqli_query($yhteys, "select * from uutiset");# haetaan uutiset taulusta kaikki rivit
            
            while ($rivi=mysqli_fetch_object($tulos)){ # loopataan rivien läpi 
                print "<li>$rivi->title\n 
                <a href='../php/poista_uutinen.php?poistettava=$rivi->id'>Poista</a>\n
                <a href='./muokkaahenkilo.php?muokattava=$rivi->id'>Muokkaa</a>"; #tulostetaan rivit html lista elementteihin
            }
            
            
            ?>
    </form>
    <?php
    // Tulostetaan viestit
            $tulos=mysqli_query($yhteys, "select * from contact");# haetaan contact taulusta kaikki rivit
            
            while ($rivi=mysqli_fetch_object($tulos)){ # loopataan rivien läpi 
                echo "<li>$rivi->user_id $rivi->message";
            }

            $ok=mysqli_close($yhteys); # suljetaan tietokantayhteys
        ?>
</body>
</html>
