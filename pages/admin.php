<?php
// Start the session
session_start();

// Check if the user is logged in and is an admin
if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    // User is logged in as an admin, show the admin page
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
    </style>
</head>
<body>
    <main>
    
    <div id="message_container">
    <h2>Viestit contact lomakkeelta</h2>
        <div class="table">
        <table>
            <tr>
                <th>Poista?</th>
                <th>email</th>
                <th>Viesti</th>
            </tr>
        <?php
        // Tulostetaan viestit
            $tulos=mysqli_query($yhteys, "select * from contact");# haetaan contact taulusta kaikki rivit
                
            while ($rivi=mysqli_fetch_object($tulos)){ # loopataan rivien läpi
                echo "<tr>";
                echo "<td><a href='../php/poista_viesti.php?poistettava=$rivi->id'>Poista</a></td>\n
                <td>$rivi->email</td> 
                <td>$rivi->message</td>";
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
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    haeUutiset();
                }
            };
            xmlhttp.open("GET", "../php/poista_uutinen.php?id=" + id, true);
            xmlhttp.send();
        }


        function haeUutiset() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var json = this.responseText;
                    var uutiset = JSON.parse(json);
                    tulostaTaulukko(uutiset);
                }
            };
            xmlhttp.open("GET", "../php/hae_uutiset.php", true);
            xmlhttp.send();
        }

        function tulostaTaulukko(uutiset){
            var tableHtml = "<table border='1'><tr><th>ID</th><th>Title</th><th>Url</th><th>Poista?</th></tr>";
            for (var i = 0; i < uutiset.length; i++) {
                tableHtml += "<tr><td>" + uutiset[i].id + "</td><td>" + uutiset[i].title + "</td><td>" + uutiset[i].url +
                     "</td><td><button onclick='poistaUutinen(" + uutiset[i].id + ");'>Poista</button></td></tr>";
                
            }
            tableHtml += "</table>";
            document.getElementById("uutis-taulukko").innerHTML = tableHtml;
            
        }
    </script>
    <script>
    window.onload = function() {
        haeUutiset();
        //setInterval(haeUutiset, 10000);
    };
    </script>
</body>
</html>
