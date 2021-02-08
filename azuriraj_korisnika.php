<html>
    <head>
        <title>Azuriraj korisnika</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
        <script src="validate.js"></script>
    </head>
    <body>
        <?php
            ob_start(); /* Bez ovoga baca neku jako cudnu gresku sa headerima, trazio sam 2h ali nisam nasao zasto */
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
                            // TODO : Forma za azuriranje zaposlenog
                            
                        }
                        else // student 
                        {
                            ?>
                            <form id="studentupdate" method="POST" onSubmit="return validateStudentUpdate();">
                                <p>Email <input id="email" type="text" name="email" value="<?php echo $email ?>"></p>
                                <p>Lozinka <input id="lozinka" type="password" name="password" value="<?php echo $lozinka ?>"></p>
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
                                <input type="submit" name="azurirajstudenta" value="Azuriraj korisnika">
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
            if (isset($_POST['azurirajstudenta'])) 
            {
                $update_email = $_POST['email'];
                $update_lozinka = $_POST['password'];
                $update_ime = $_POST['ime'];
                $update_prezime = $_POST['prezime'];
                $update_status = (strcmp($_POST['status'], "aktivan") == 0) ? 1 : 0;
                $update_prvipristup = (isset($_POST['prvipristup'])) ? 1 : 0;
                $update_brojindeksa = $_POST['indeks'];
                $update_tipstudija = $_POST['tipstudija'];


                $handle = dbConnect();

               
                if (strcmp($update_email, $email) !== 0)
                {
                    // Ako menjamo mejl, pre apdejtovanja korisnika proveriti da li novi mejl vec postoji u bazi
                    $result = mysqli_query($handle, "select ime from user where email='".$update_email."'");
                    if ($result != false && mysqli_num_rows($result) > 0)
                    {
                        echo "<p>Novi mejl je vec dodeljen drugom korisniku</p>";
                        exit();
                    }
                }
                

                $result = mysqli_query($handle, "update korisnik set email='".$update_email."', lozinka='".$update_lozinka."', ime='".$update_ime."', prezime='".$update_prezime."', status=".$update_status.", prvipristup=".$update_prvipristup." where email='".$email."'");
                $result = mysqli_query($handle, "update student set indeks='".$update_brojindeksa."', tipstudija='".$update_tipstudija."' where email='".$update_email."'");
                
                dbDisconnect($handle, false);

                header("Location:/projekat/upravljaj_korisnicima.php");
            }
        ?>
    </body>
</html>