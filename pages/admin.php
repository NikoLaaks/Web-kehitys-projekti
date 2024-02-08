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

//Yhdistetään tietokantaan
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include("../php/connect.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        main{
            display: block;
        }
        .container{
            display: flex;
            flex-direction: column;
            max-width: 1000px;
        }a:visited{
            color: #FF0000;
        }a:link{
            color: #FF0000;
        }
    </style>
</head>
<body>
    <main>
    <h2>Viestit contact lomakkeelta</h2>
    <div class="container">
        <?php
        // Tulostetaan viestit
            $tulos=mysqli_query($yhteys, "select * from contact");# haetaan contact taulusta kaikki rivit
                
            while ($rivi=mysqli_fetch_object($tulos)){ # loopataan rivien läpi 
                echo "<a href='../php/poista_viesti.php?poistettava=$rivi->id'>Poista</a>\n
                <li>$rivi->user_id $rivi->message";
            }
                
        ?>
    </div>

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
            


            $tulos=mysqli_query($yhteys, "SELECT * FROM uutiset ORDER BY id DESC");# haetaan uutiset taulusta kaikki rivit
            
            while ($rivi=mysqli_fetch_object($tulos)){ # loopataan rivien läpi 
                echo "<li>$rivi->title\n 
                <a href='../php/poista_uutinen.php?poistettava=$rivi->id'>Poista</a>";
            }
            
            ?>
        </ol>
    </form>

    </main>
</body>
</html>
