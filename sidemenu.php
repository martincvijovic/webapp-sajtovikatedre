<html>
    <head>
        <link rel="stylesheet" type="text/css" href="sidemenu_style.css">
    </head>
    <body>
        <div id="sidemenu">
            <ul>
                <li><a href="index.php">Pocetna</a></li>
                <li><a href="zaposleni.php">Zaposleni</a></li>
                <li><a href="obavestenja.php">Obavestenja</a></li>
                <li><a href="osnovnestudije.php">Osnovne studije</a></li>
                <li><a href="masterstudije.php">Master studije</a></li>
                <li><a href="projekti.php">Projekti</a></li>
                <li>Servisi
                    <ul>
                        <li><a href="http://www.etf.rs/">Fakultet</a></li>
                        <li><a href="http://student.etf.rs/">Studentski servisi</a></li>
                        <li><a href="http://lists.etf.rs/">Mejling liste</a></li>
                        <li><a href="http://rti.etf.rs/sale/">Paviljon - Laboratorije</a></li>
                    </ul>
                </li>
                <li><a href="kontakt.php">Kontakt</a></li>
            </ul>
            <?php
                if (isset($_SESSION['email']))
                {
                    if (strcmp($_SESSION['tip'], "administrator") == 0)
                    {
                        ?>
                        <ul>
                            <li><a href="upravljaj_korisnicima.php">Upravljaj korisnicima</a></li>
                            <li><a href="novo_opste_obavestenje.php">Dodaj novo opste obavestenje</a></li>
                            <li><a href="upravljaj_kategorijama_obavestenja.php">Upravljaj kategorijama obavestenja</a></li>
                            <li><a href="nov_predmet_grupa_nastavnik.php">Dodeli predmet i grupu nastavniku</a></li>
                        </ul>
                        <?php
                    }
                    if (strcmp($_SESSION['tip'], "zaposleni") == 0)
                    {
                        ?>
                        <ul>
                            <li><a href="profil.php">Profil</a></li>
                            <li><a href="predmeti.php">Predmeti</a></li>
                            <li><a href="obavestenja_o_predmetima.php">Obavestenja o predmetima</a></li>
                        </ul>
                        <?php
                    }
                    if (strcmp($_SESSION['tip'], "student") == 0)
                    {
                        // TODO : Omoguci prikaz detalja o predmetu i mogucnost zapracivanja/otpracivajna (vrv ne na ovojs tranici)
                    }
                    ?>

                    <ul>
                        <li><a href="change_password.php">Promena lozinke</a></li>
                    </ul>
                    <?php
                }
            ?>
        </div>
    </body>
</html>