<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viestit</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1><a href="../index.html">Liiga - Suomen parasta kiekkoa</a></h1>
        <div id="header-links">
            <h2><a href="uutiset.html">Uutiset</a></h2>
            <h2><a href="tilastot.html">Tilastot</a></h2>
            <h2><a href="joukkueet.html">Joukkueet</a></h2>
        </div>
    </header>

    <main>
        <section>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['kommentti'])) {
                    $kommentti = $_POST['kommentti'];
                    $kayttajatunnus = $_SESSION['kayttajanimi'];

                    include('./connect.php');

                    $sql = "INSERT INTO contact (message, user_id) VALUES (?, ?)";
                    $stmt = $yhteys->prepare($sql);

                    $stmt->bind_param("si", $kommentti, $_SESSION['id']);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        print "Viesti lähetetty.";
                    } else {
                        print "Viestin lähetys epäonnistui.";
                    }

                    $stmt->close();
                    $yhteys->close();
                } else {
                    print "Kaikkia tarvittavia tietoja ei ole annettu.";
                }
            } else {
                print "Lomaketta ei ole lähetetty.";
            }
            ?>
            <meta http-equiv="refresh" content="2; url=../pages/contact.php" />
        </section>
    </main>

</body>
</html>