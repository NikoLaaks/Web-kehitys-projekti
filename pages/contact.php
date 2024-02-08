<?php session_start();?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakti sivusto käyttäjille</title>

    <style>

   label,textarea, input {
        font-size: 0.8rem;
        letter-spacing: 1px;
    }
    main {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        min-height: 100%;
    }
    textarea, input {
        padding: 10px;
        max-width: 100%;
        line-height: 1.5;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-shadow: 1px 1px 1px #999;
    }
    label {
        display: block;
        margin-bottom: 10px;
    }
    .input-group{
        margin-bottom: 20px;
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

    </style>
</head>
<body>
    <header>
        <h1><a href="../index.php">Liiga - Suomen parasta kiekkoa</a></h1>

        <div id="header-links">
        <h2><a href="./uutiset.php">Uutiset</a></h2>
        <h2><a href="./tilastot.html">Tilastot</a></h2>
        <h2><a href="./joukkueet.html">Joukkueet</a></h2>
    </div>
</header>

    <main>
        <form action="../php/viestit.php" method="post">
        <div class="input-group">
        <label for="kommentti">Kirjoita viestisi alla olevaan tekstikenttään</label>
        <textarea name="kommentti" id="kommentti" cols="30" rows="15" maxlength="255" required></textarea>
        <p>Jäljellä oleva merkkimäärä: <span id ="merkkienMaara">255</span></p>
    </div>
    <div class="input-group">
        <label for="email">Kirjoita halutessasi sähköpostiosoitteesi alla olevaan kenttään</label>
        <input type="text" name="email" id="email" size="30">
    </div>
    <div class="input-group">
        <input type="submit" value="Lähetä">
    </div>

    <div>
        <p><h4>FAQ</h4></p>
        <p><h4>Mitä sivusto käsittelee?</h4></p>
        <p>Sivusto käsittelee jääkiekon SM-Liigaa, Suomen korkeinta tasoa jääkiekossa.</p>
        <p><h4>Onko sivusto kouluprojekti?</h4></p>
        <p>Kyllä. Sivusto on vain kouluprojekti, eikä sitä käytetä mihinkään muuhun tarkoitukseen.</p>
        <p><h4>Miten sivustoa päivitetään?</h4></p>
        <p>Sivustoa päivitetään kurssien edetessä.</p>
    </div>

    </main>

    <footer>
    <h3><a href="pages/contact.php">Contact us</a></h3>
    
    <?php
    if (isset($_SESSION['logged_in'])) {
      echo ("<h3><a href='php/logout.php'>Kirjaudu ulos</a></h3>");
      echo ("<p>Olet kirjautunut käyttäjällä: {$_SESSION['kayttajanimi']}</p>");
    } else {
      echo ("<h3><a href='pages/kirjautumis.php'>Kirjaudu sisään</a></h3>");
    }
    
    ?>
</footer>

    <script>
        //Lisätään kuuntelija, tarkistetaan kaikkien tarvittavien elementtien olevan valmiina
    document.addEventListener('DOMContentLoaded', function() {
    var tekstikentta = document.getElementById('kommentti'); //Haetaan tekstikentästä teksti
    var merkkienMaaraElementti = document.getElementById('merkkienMaara'); 

    //Lisää kuuntelijan input tapahtumalle
    tekstikentta.addEventListener('input', function() { 
        
        var syotettyTeksti = tekstikentta.value;    //
        var merkkienMaara = 255 - syotettyTeksti.length;

        merkkienMaaraElementti.textContent = merkkienMaara;
        
        if (merkkienMaara < 0) {
            tekstikentta.value = syotettyTeksti.substring(0, 255); // Rajoitetaan tekstiin 255 merkkiä
            merkkienMaaraElementti.textContent = 0;
        }
        
    });
});
    </script>
    
</body>
</html>