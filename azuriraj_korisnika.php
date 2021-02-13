<html>
    <head>
        <title>Azuriraj korisnika</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
        <script src="validate.js"></script>
    </head>
    <body>
        <?php
            ob_start(); /* Bez ovoga baca neku jako cudnu gresku sa headerima gde ne dozvoljava poziv funkcije header ukoliko je 
                           trenutni fajl imao bilo kakav output (echo, print...)
                        */
            require("header.php");
            require("sidemenu.php");

            /**
             * Administratoru je dozvoljeno da menja sve korisnike. Takodje, dozvoljeno je profesoru da menja svoje podatke.
             */
            
            if (!((isset($_SESSION['tip']) && strcmp($_SESSION['tip'], "administrator") == 0) || strcmp($_GET['email'], $_SESSION['email']) == 0))
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
                            ?>
                            <form id="zaposleniupdate" enctype="multipart/form-data" method="POST" onSubmit="return validateZaposleniUpdate();">
                                <p>Email <input id="email" type="text" name="email" value="<?php echo $email ?>"></p>
                                <p>Lozinka <input id="lozinka" type="password" name="password" value="<?php echo $lozinka ?>"></p>
                                <p>Ime <input id="ime" type="text" name="ime" value="<?php echo $ime ?>">
                                Prezime <input id="prezime" type="text" name="prezime" value="<?php echo $prezime ?>"></p>
                                <p>
                                    Status
                                    <select name="status">
                                        <option <?php echo ($status == 1) ? "selected" : "" ?> value="aktivan">Aktivan</option>
                                        <option <?php echo ($status == 0) ? "selected" : "" ?> value="neaktivan">Neaktivan</option>
                                    </select>
                                
                                    Prvi pristup <input type="checkbox" name="prvipristup" <?php echo ($prvipristup == 1) ? "checked" : "" ?>>
                                </p>
                                <p>Adresa <input id="adresa" type="text" name="adresa" value="<?php echo $adresa ?>"></p>
                                <p>Mobilni telefon <input id="mobilni" type="text" name="mobilni" value="<?php echo $mobilni ?>"></p>
                                <p>Licna web adresa <input id="licniweb" type="text" name="licniweb" value="<?php echo $licniweb ?>"></p>
                                <p>Biografija <textarea style="resize: none;" id="biografija" type="text" name="biografija" rows="4" cols="100" value="<?php echo $biografija ?>"><?php echo $biografija ?></textarea></p>
                                <p>
                                    Zvanje
                                    <select name="zvanje">
                                        <option <?php echo (strcmp($zvanje, "redovniprofesor") == 0) ? "selected" : "" ?> value="redovniprofesor">Redovni profesor</option>
                                        <option <?php echo (strcmp($zvanje, "vanredniprofesor") == 0) ? "selected" : "" ?> value="vanredniprofesor">Vanredni profesor</option>
                                        <option <?php echo (strcmp($zvanje, "docent") == 0) ? "selected" : "" ?> value="docent">Docent</option>
                                        <option <?php echo (strcmp($zvanje, "asistent") == 0) ? "selected" : "" ?> value="asistent">Asistent</option>
                                        <option <?php echo (strcmp($zvanje, "saradnikunastavi") == 0) ? "selected" : "" ?> value="saradnikunastavi">Saradnik u nastavi</option>
                                        <option <?php echo (strcmp($zvanje, "istrazivac") == 0) ? "selected" : "" ?> value="istrazivac">Istrazivac</option>
                                        <option <?php echo (strcmp($zvanje, "laboratorijskiinzenjer") == 0) ? "selected" : "" ?> value="laboratorijskiinzenjer">Laboratorijski inzenjer</option>
                                        <option <?php echo (strcmp($zvanje, "laboratorijskitehnicar") == 0) ? "selected" : "" ?> value="laboratorijskitehnicar">Laboratorijski tehnicar</option>
                                    </select>
                                </p>
                                <p>Kabinet <input id="kabinet" type="text" name="kabinet" value="<?php echo $kabinet ?>"></p>
                        
                                <?php echo "<img src='".$profilnaslika."' >" ?> 
                                <p>Dodaj novu profilnu sliku dimenzija do 300x300px <input type="file" name="profilnaslika" id="profilnaslika"></p>
                                
                                <input type="submit" name="azurirajzaposlenog" value="Azuriraj zaposlenog">
                            </form>
                            <?php                           
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
                    // Ako menjamo mejl, pre apdejtovanja korisnika proveravamo da li novi mejl vec postoji u bazi
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

                header("Location:upravljaj_korisnicima.php");
            }
    
            if (isset($_POST['azurirajzaposlenog']))
            {
                $update_email = $_POST['email'];
                $update_lozinka = $_POST['password'];
                $update_ime = $_POST['ime'];
                $update_prezime = $_POST['prezime'];
                $update_status = (strcmp($_POST['status'], "aktivan") == 0) ? 1 : 0;
                $update_prvipristup = (isset($_POST['prvipristup'])) ? 1 : 0;
                $update_adresa = $_POST['adresa'];
                $update_mobilni = $_POST['mobilni'];
                $update_licniweb = $_POST['licniweb'];
                $update_biografija = $_POST['biografija'];
                $update_zvanje = $_POST['zvanje'];
                $update_kabinet = $_POST['kabinet'];

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
                $result = mysqli_query($handle, "update zaposleni set adresa='".$update_adresa."', mobilni='".$update_mobilni."', licniweb='".$update_licniweb."', biografija='".$update_biografija."', zvanje='".$update_zvanje."', kabinet='".$update_kabinet."' where email='".$email."'");

                if (strcmp($_FILES['profilnaslika']['name'], "") !== 0)
                {
                    $target_file = "img/".basename($_FILES["profilnaslika"]["name"]);
                    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    $uploadOK = 1;

                    if (!file_exists($target_file))
                    {
                        if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg") 
                        {
                            echo "<p>Dozvoljene su samo .jpg, .png i .jpeg slike.</p>";
                            exit();           
                        }

                        list($width, $height, $type, $attr) = getimagesize($_FILES['profilnaslika']['tmp_name']);
                        if ($width > 300 || $height > 300)
                        {
                            echo "<p>Horizontalna/vertikalna dimenzija slike ne sme preci 300px.</p>";
                            exit();
                        }
                        if (!move_uploaded_file($_FILES["profilnaslika"]["tmp_name"], $target_file)) 
                        {
                            $uploadOK = 0;
                        }
                    }

                    if ($uploadOK)
                    {
                        mysqli_query($handle, "update zaposleni set profilnaslika='".$target_file."' where email='".$update_email."'");
                    }
                }
                        
                dbDisconnect($handle, false);
                header("Location:upravljaj_korisnicima.php");
            }
        ?>
    </body>
</html>