<html>
    <head>
        <title>Azuriraj korisnika</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
        <script src="validate.js"></script>
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
                            ?>
                            <form method="GET">
                                <p>Email <input id="email" type="text" name="email" value="<?php echo $email ?>"></p>
                                <p>Lozinka <input id="password" type="password" name="password" value="<?php echo $lozinka ?>"></p>
                                <p>Ime <input id="ime" type="text" name="ime" value="<?php echo $ime ?>"></p>
                                <p>Prezime <input id="prezime" type="text" name="prezime" value="<?php echo $prezime ?>"></p>
                                <p>
                                    Status
                                    <select name="status">
                                        <option <?php echo ($status == 1) ? "selected" : "" ?> value="aktivan">Aktivan</option>
                                        <option <?php echo ($status == 0) ? "selected" : "" ?> value="neaktivan">Neaktivan</option>
                                    </select>
                                </p>
                                <p>
                                    Prvi pristup <input type="checkbox" name="prvipristup" <?php echo ($prvipristup == 1) ? "checked" : "" ?>>
                                </p>
                                <p>Broj indeksa <input id="indeks" type="text" name="indeks" value="<?php echo $indeks ?>"></p>
                                <p>
                                    Tip studija 
                                    <select name="tipstudija">
                                        <option <?php echo (strcmp($tipstudija, "d") == 0) ? "selected" : "" ?> value="d">Osnovne</option>
                                        <option <?php echo (strcmp($tipstudija, "m") == 0) ? "selected" : "" ?> value="m">Master</option>
                                        <option <?php echo (strcmp($tipstudija, "p") == 0) ? "selected" : "" ?> value="p">Doktorske</option>                             
                                    </select>
                                </p>
                                <input type="submit" onclick="validateUserUpdate()" name="azurirajkorisnika" value="Azuriraj korisnika">
                            </form>
                            <?php
                        }
                    ?>
                </div>
            <?php
            }
            require("footer.php");
        ?>
        <?php
            if (isset($_GET['azurirajkorisnika']))
            {
                // TODO : ...
                echo "aaaaaaa";
            }
        ?>
    </body>
</html>