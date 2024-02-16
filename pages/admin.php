<?php
session_start();

//Tarkistetaan onko käyttäjällä admin oikeudet
if(!isset($_SESSION['is_admin'])|| $_SESSION['is_admin'] == 0) {
    header("Location:./kirjautumis.php");
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
            align-items: center;
            flex-direction: column;
            
            
        }
        #message_container{
            display: flex;
            flex-direction: column;
            text-align: center;
            margin: 50px;
            
        }a:visited{
            color: #FF0000;
        }a:link{
            color: #FF0000;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        .table{
            overflow-x: auto;
        }form{
            display: flex;
            flex-direction: column;
            align-items: center;
        }.container{
            text-align: center;
            margin-bottom:25px;
            display: flex;
            margin: 15px;
            
        }input{
            max-width: 400px;
        }#submit{
            margin-bottom: 15px;
            max-width: 150px;
            height: 40px;
        }label{
            font-size: 25px;
        }h2{
            font-size: 30px;
        }p{
            color:red;
            font-size: 20px;
        }#text-container{
            padding: 15px;
        }#news-container{
            padding: 15px;
        }
        footer{
            width: auto;
            display: flex;
            justify-content: center;
         }
         #otsikko{
            display: flex;
            align-items: center;
            justify-content: space-between;
         }
         h3{
            display: block;
            margin-right: 7px;
         }
         h2 a{
            padding: 0;
         }
         h1 a{
            padding: 0;
         }
         footer a{
            padding:0;
         }#title, #url, #alt{
            width: 75%;
         }
    </style>
</head>
<body>
    <header>
        <h1><a href="../index.php">Liiga - Suomen parasta kiekkoa</a></h1>

        <div id="header-links">
        <h2><a href="./uutiset.php">Uutiset</a></h2>
        <h2><a href="./tilastot.php">Tilastot</a></h2>
        <h2><a href="./joukkueet.php">Joukkueet</a></h2>
    </div>
    </header>
    <main>
    
    <div id="message_container">
    <h2>Viestit contact lomakkeelta</h2>
        <div class="table">
        <table>
            <tr>
                <th>Poista?</th>
                <th>email</th>
                <th>Viesti</th>
                <th>Käyttäjä id</th>
            </tr>
        <?php
            $tulos=mysqli_query($yhteys, "select * from contact");# haetaan contact taulusta kaikki rivit
                
            while ($rivi=mysqli_fetch_object($tulos)){ # loopataan rivien läpi
                // Tulostetaan viestit html tauluun
                echo "<tr>";
                echo "<td><a href='../php/poista_viesti.php?poistettava=$rivi->id'>Poista</a></td>\n
                <td>$rivi->email</td> 
                <td>$rivi->message</td>
                <td>$rivi->user_id</td>";
                echo "</tr>";
            }
                
        ?>
        </table>
        </div>
    </div>
    <div class="container">
        <div id="text-container">
            <h2>Ohjeet uutisen lisääminen</h2>
            <p>Kirjoita url muodossa osoite.fi eli vain www. jälkeen tulevat. <br>Muista antaa alt kohtaan lyhyt teksti mitä on kuvassa</p>
        
            <!-- Formi uutisten lisäämiseen -->
    <form action="../php/lisaa_uutinen.php" method="post" enctype="multipart/form-data">
        <label for="title">Otsikko:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="url">URL:</label>
        <input type="text" id="url" name="url" required><br>

        <label for="alt">Alt:</label>
        <input type="text" id="alt" name="alt" required><br>

        <label for="image">Kuva:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

        <input type="submit" value="Lisää Uutinen" id="submit">
        </form>
        </div>
        <div id="news-container">
        <h2>Sivuilla näkyvät uutiset</h2>
        <div id="uutis-taulukko"></div>
            
        

    
    </div>
    </main>
    <script>
        function poistaUutinen(id) {
            // Luodaan uusi xmlhttprequest olio
            var xmlhttp = new XMLHttpRequest();
            // Määritetään tapahtumankäsittelijä joka suoritetaan kun olion tila muuttuu
            xmlhttp.onreadystatechange = function() {
                // Tarkistetaan onko pyyntö valmis (4) ja onko vastauks onnistunut (200)
                if (this.readyState == 4 && this.status == 200) {
                    // Suoritetaan haeuutiset funktio kun pyyntö ja vastaus on valmis
                    haeUutiset();
                }
            };
            // Määritellään http pyyntö seuraavilla parametreilla
            xmlhttp.open("GET", "../php/poista_uutinen.php?id=" + id, true);
            // Lähetetään varsinainen pyyntö
            xmlhttp.send();
        }


        function haeUutiset() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Tallennetaan vastauksen tekstisisältö muuttujaan
                    var json = this.responseText;
                    // Muutetaan json tekstisisältö  javascript objektiksi parse funktiolla
                    var uutiset = JSON.parse(json);
                    // Suoritetaan tulostaTaulukko funktio parametrinaan uutisobjekti
                    tulostaTaulukko(uutiset);
                }
            };
            xmlhttp.open("GET", "../php/hae_uutiset.php", true);
            xmlhttp.send();
        }

        function tulostaTaulukko(uutiset){
            // Luodaan muuttuja johon lisätään taulukon headerit
            var tableHtml = "<table border='1'><tr><th>ID</th><th>Title</th><th>Url</th><th>Poista?</th></tr>";
            // Käydään läpi kaikki uutiset jotka ovat tulleet parametrina
            for (var i = 0; i < uutiset.length; i++) {
                // Jokaiselle uutiselle lisätään uusi rivi ja sarakkeet
                tableHtml += "<tr><td>" + uutiset[i].id + "</td><td>" + uutiset[i].title + "</td><td>" + uutiset[i].url +
                     "</td><td><button onclick='poistaUutinen(" + uutiset[i].id + ");'>Poista</button></td></tr>";
                
            }
            tableHtml += "</table>";
            // Sijoitetaan luotu taulukko sivulle uutis-taulukko diviin
            document.getElementById("uutis-taulukko").innerHTML = tableHtml;
            
        }
    </script>
    <footer>
    <h3><a href="./contact.php">Contact us</a></h3>
    
    <?php
        if (isset($_SESSION['logged_in'])) {
            echo ("<h3><a href='../php/logout.php'>Kirjaudu ulos</a></h3>");
            echo ("<p>Olet kirjautunut käyttäjällä: {$_SESSION['kayttajanimi']}</p>");
        } else {
            echo ("<h3><a href='./kirjautumis.php'>Kirjaudu sisään</a></h3>");
        }
        
        ?>
    </footer>
    <script>
        // Haetaan uutiset kun koko sivu on muuten ladattu
    window.onload = function() {
        haeUutiset();
        //setInterval(haeUutiset, 10000);
    };
    </script>
</body>
</html>
