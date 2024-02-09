<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirjaudu sivustolle</title>

    <style>        

    .formi {    
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
        flex-direction: column;
        
    }
    #lomake{
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: flex-start;
    }

    #lomake p {
        text-align: left;
    }

    main {
        justify-content: flex-start;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }
    input {
        border: 1px solid #333;
        width: 200px;
        height: 25px;
        margin: 2px;
        box-sizing: border-box;
        display: flex;
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
    <div id="lomake">
    <div class="formi">
    <h3>Uusi käyttäjä, rekisteröidy alla!</h3> <!-- Lomake lähettää käyttäjänimen, salasanan
     rekisteroidy.php joka tallettaa tietokantaan antamat tiedot-->
    <form name="rekisteroidy" action="../php/rekisteroidy.php" method="post">
    <label for='uusikayttaja'>Käyttäjänimi:</label><input type="text" name="uusikayttaja" size="20" maxlength="20" required /><br>
    <label for='password'>Salasana:</label><input type="password" name="uusisalasana" required /><br>
        <input type="submit" name="rekisteröityminen" value="Rekisteröidy" />
    </form>
    </div>

    <?php // Jos saadaan rekisterointi.php ohjelmalta get loginille tallennettu arvo onnistuneesti
     //Käyttäjälle tulee tieto, että onnistui
    if (isset($_GET["login"])) {
        echo ("Rekisteröinti onnistui!");
    }
    ?>
    
    <div class="formi">
    <h3>Kirjaudu alla!</h3> <!-- Lomake lähettää käyttäjänimen, salasanan kirjautuminen.php ohjelmalle -->
    <form name="kirjautuminen"  action="../php/kirjautuminen.php" method="post">
    <label for='kayttajanimi'>Käyttäjänimi:</label><input type="text" name="kayttajanimi" size="20" maxlength="20" required/><br>
    <label for='password'>Salasana:</label><input type="password" name="salasana" required /><br>
        <input type="submit" name="kirjaudu" value="Kirjaudu" />
    </form>
    </div>
    </div>

    </main>

    
</body>
</html>