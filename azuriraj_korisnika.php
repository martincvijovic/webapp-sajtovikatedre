<html>
    <head>
        <title>Azuriraj korisnika</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
    </head>
    <body>
        <?php
            require("header.php");
            require("sidemenu.php");
            
            if (!(isset($_SESSION['tip']) && strcmp($_SESSION['tip'], "administrator") == 0))
            {
                echo "Niste ovlasceni da vidite ovaj sadrzaj";
            }
            else
            {  
                // Prikupljanje informacija o korisniku kog zelimo da azuriramo
                $email = $_GET['email'];

                require("mysql_functions.php");
                
                $handle = dbConnect();
                $result = mysqli_query($handle, "select * from korisnik where email='".$email."'");

                $row = mysqli_fetch_assoc($result);

                $lozinka = $row['lozinka'];
                $ime = $row['ime'];
                $prezime = $row['prezime'];
                $status = $row['status'];
                $prvipristup = $row['prvipristup'];


                $tipovi = ["administrator", "zaposleni", "student"];
                foreach ($tipovi as $tip)
                {
                    $result = mysqli_query($handle, "select * from ".$tip." where email='".$email."'");

                    if ($result != false && mysqli_num_rows($result) > 0)
                    {
                        $tip_korisnika = $tip;

                        $row = mysqli_fetch_assoc($result);

                        if (strcmp($tip, "zaposleni") == 0)
                        {
                            $adresa = $row['adresa'];
                            $mobilni = $row['mobilni'];
                            $licniweb = $row['licniweb'];
                            $biografija = $row['biografija'];
                            $zvanje = $row['zvanje'];
                            $kabinet = $row['kabinet'];
                            $profilnaslika = $row['profilnaslika'];
                        }
                        else if (strcmp($tip, "student") == 0)
                        {
                            $indeks = $row['indeks'];
                            $tipstudija = $row['tipstudija'];
                        }
                        break;
                    }
                }

                dbDisconnect($handle, false);
            ?>
                <div id="content">
                    <h2 style='text-align: center'><b><?php echo $email ?> </b></h2>
                    <hr>
                    
                    <?php
                        if (strcmp($tip_korisnika, "administrator") == 0)
                        {
                            echo "<p style='text-align: center'>Navedeni korisnik je administrator sistema.</p>";
                        }
                        else if (strcmp($tip_korisnika, "zaposleni") == 0)
                        {
                            // TODO : slika kod zaposlenog?
                            
                        }
                        else // student 
                        {
                            // TODO : js validate???
                            ?>
                            <form method="GET">
                                <p>Email <input type="text" name="email" value="<?php echo $email ?>"></p>
                                <p>Lozinka <input type="password" name="password" value="<?php echo $lozinka ?>"></p>
                                <p>Ime <input type="text" name="ime" value="<?php echo $ime ?>"></p>
                                <p>Prezime <input type="text" name="prezime" value="<?php echo $prezime ?>"></p>
                                <p>Status</p>
                                <p>Prvi pristup</p>
                                <p>Broj indeksa <input type="text" name="indeks" value="<?php echo $indeks ?>"></p>
                                <p>Tip studija </p>
                                <input type="submit" name="azurirajkorisnika" value="Azuriraj korisnika">
                            </form>
                            <?php
                        }
                    ?>

                </div>
            <?php
            }
            require("footer.php");
        ?>
    </body>
</html>