<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Yhteysvirhe</title>

<style>
        footer{
        width: auto;
        display: flex;
        justify-content: center;
         }

         body, html{
            height: 100%;
         }
         
         main{
            background-image: url('../images/patrik.jpg');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            width: 150%;
            margin: 0;
            max-width: 100%;
            padding: 0; 
         }

         .section-text {
            color: #000000;;
            font-size:xx-large;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            margin-left: -500px;
            margin-top: -200px;

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

<section>
    <div class=section-text>
    <h2>Hups!</h2>
    <p>Tapahtui odottamaton virhe.</p>
    </div>
</section>

</main>
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

</body>
</html>