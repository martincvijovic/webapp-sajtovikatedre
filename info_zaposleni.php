<html>
    <head>
        <title>Pocetna strana</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
    </head>
    <body>
        <?php
            require("header.php");
            require("sidemenu.php");
        ?>
        <div id="content">
            <?php
                if (!isset($_GET['email']))
                {
                    echo "404 not found :(";
                }
                else
                {
                    $email = $_GET['email'];
                    
                    require("mysql_functions.php");
                    $handle = dbConnect();
                    
                    // Podrazumevamo ispravno konfigurisanu bazu jer je admin deo za upravljanje korisnicima ispravno konfigurisan
                    // Baza nece sadrzati nepredvidjene vrednosti ukoliko se njoj pristupa iskljucivo iz aplikacije.
                    $result = mysqli_fetch_assoc(mysqli_query($handle, "select * from korisnik where email='".$email."'"));
                    $result_info = mysqli_fetch_assoc(mysqli_query($handle, "select * from zaposleni where email='".$email."'"));

                    $ime = $result['ime'];
                    $prezime = $result['prezime'];
                    $adresa = $result_info['adresa'];
                    $mobilni = $result_info['mobilni'];
                    $licniweb = $result_info['licniweb'];
                    $biografija = $result_info['biografija'];
                    $zvanje = $result_info['zvanje'];
                    $kabinet = $result_info['kabinet'];
                    $profilnaslika_path = $result_info['profilnaslika'];

                    require("db_to_string_zvanje.php");

                    ?>
                    <h2 style='text-align: center'><b><?php echo $ime." ".$prezime ?></b></h2>
                    <div class="row">
                        <div class="col">
                            <img src="<?php echo $profilnaslika_path ?>">
                        </div>
                        <div class="col">
                            <p><b>Adresa:</b> <?php echo $adresa ?></p>
                            <p><b>Mobilni:</b> <?php echo $mobilni ?></p>
                            <p><b>Licni web sajt:</b> <?php echo $licniweb ?></p>
                            <p><b>Biografija:</b> <?php echo $biografija ?></p>
                            <p><b>Zvanje:</b> <?php echo dbToStringZvanje($zvanje) ?></p>
                            <p><b>Kabinet:</b> <?php echo $kabinet ?></p>  
                            <?php    
                            if (isset($_SESSION['email']))
                            {
                                if (strcmp($_SESSION['email'], $_GET['email']) == 0 || strcmp($_SESSION['tip'], "administrator") == 0)
                                {
                                    ?>
                                    <a href="<?php echo "azuriraj_korisnika.php?email=".$email ?>">Izmeni profil</a>
                                    <?php
                                }                                
                            }      
                            ?>                
                        </div>
                    </div>
                    <?php
                    
                }
            ?>
        </div>
        <?php
            require("footer.php");
        ?>
    </body>
</html>