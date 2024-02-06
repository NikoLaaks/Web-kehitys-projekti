<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirjaudu sivustolle</title>
</head>
<body>
 
    
    <h3>Uusi käyttäjä, rekisteröidy alla!</h3>
    <form name="rekisteroidy" action="../php/rekisteroidy.php" method="post">
        Käyttäjänimi: <input type="text" name="uusikayttaja" size="40" maxlength="20"/>
        Salasana: <input type="text" name="uusisalasana" />
        <input type="submit" name="rekisteröityminen" value="Rekisteröidy" />
    </form>

    <h3>Kirjaudu alla!</h3>
    <form name="kirjautuminen"  action="../php/kirjautuminen.php" method="post">
        Käyttäjänimi: <input type="text" name="kayttajanimi" size="40" maxlength="20"/>
        Salasana: <input type="password" name="salasana" />
        <input type="submit" name="kirjaudu" value="Kirjaudu" />
    </form>
    

    
</body>
</html>