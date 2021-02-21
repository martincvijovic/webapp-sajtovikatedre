<html>
    <head>
        <title>Pocetna strana</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
        <script src="validate.js"></script>
    </head>
    <body>
        <?php
            ob_start();
            require("header.php");
            require("sidemenu.php");
            
            if (!(isset($_SESSION['tip']) && strcmp($_SESSION['tip'], "administrator") == 0))
            {
                echo "Niste ovlasceni da vidite ovaj sadrzaj";
            }
            else
            {  
            ?>
                <div id="content">
                    <h2 style='text-align: center'><b>Korisnici:</b></h2>

                    <hr>

                    <table style="width: 80%">
                        <tr>
                            <td>Email</td>
                            <td>Lozinka</td>
                            <td>Ime</td>
                            <td>Prezime</td>
                            <td>Status</td>
                            <td>Potrebna promena lozinke</td>
                        </tr>
                        
                        <?php
                            require("mysql_functions.php");
                            
                            $handle = dbConnect();
                            $result = mysqli_query($handle, "select * from korisnik");

                            if ($result != false && mysqli_num_rows($result) > 0)
                            {
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    $email = $row['email'];
                                    $lozinka = $row['lozinka'];
                                    $ime = $row['ime'];
                                    $prezime = $row['prezime'];
                                    $status = ($row['status'] == 1) ? "aktivan" : "neaktivan";
                                    $trebapromena = ($row['prvipristup'] == 1) ? "da" : "ne";

                                    echo "<tr>";
                                    echo "<td>".$email."</td>";
                                    echo "<td>".$lozinka."</td>";
                                    echo "<td>".$ime."</td>";
                                    echo "<td>".$prezime."</td>";
                                    echo "<td>".$status."</td>";
                                    echo "<td>".$trebapromena."</td>";
                                    echo "<td>";
                                    ?>
                                    <form method="GET" action="azuriraj_korisnika.php">
                                        <input type="text" name="email" value=<?php echo $email ?> hidden> 
                                        <input type="submit" name="submit" value="Izmeni">
                                    </form>
                                    <?php
                                    echo "</td>";
                                    echo "<td>";
                                    ?>
                                    <form method="GET">
                                        <input type="text" name="email" value=<?php echo $email ?> hidden> 
                                        <input type="submit" name="obrisikorisnika" value="Obrisi korisnika">
                                    </form>
                                    <?php
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }

                            dbDisconnect($handle, $result);
                        ?>

                    </table>
                    <hr>
                    <h2 style='text-align: center'><b>Dodavanje novog korisnika</b></h2>
                    <form id="newuserform" method="POST" onSubmit="return validateNewUser();">
                            <p>Email <input id="emailnewuser" type="text" name="emailnewuser"></p>
                            <p>Lozinka <input id="lozinkanewuser" type="text" name="lozinkanewuser"></p>
                            <p>Ime <input id="imenewuser" type="text" name="imenewuser"></p>
                            <p>Prezime <input id="prezimenewuser" type="text" name="prezimenewuser"></p>
                            <p>Status 
                                <select id="statusnewuser" name="statusnewuser">
                                    <option value="aktivan">Aktivan</option>
                                    <option value="neaktivan">Neaktivan</option>
                                </select>                                
                            </p>
                            <p>Tip korisnika
                                <select id="tipkorisnikanewuser" name="tipkorisnikanewuser">
                                    <option value="administrator">Administrator</option>
                                    <option value="zaposleni">Zaposleni</option>
                                    <option value="student">Student</option>
                                </select>   
                            </p>
                            <input type="submit" name="dodajkorisnika" value="Dodaj korisnika">
                    </form>
                </div>
            <?php
            }
            require("footer.php");
        ?>
        <?php
            if (isset($_POST['dodajkorisnika']))
            {
                $email_new = $_POST['emailnewuser'];
                $lozinka_new = $_POST['lozinkanewuser'];
                $ime_new = $_POST['imenewuser'];
                $prezime_new = $_POST['prezimenewuser'];
                $status_new = (strcmp($_POST['statusnewuser'], "aktivan") == 0) ? 1 : 0;
                $tip_new = $_POST['tipkorisnikanewuser'];

                $handle = dbConnect();
                $result = mysqli_query($handle, "select ime from korisnik where email='".$email_new."'");

                if ($result !== false && mysqli_num_rows($result) > 0)
                {
                    echo "<p>Vec postoji korisnik sa zadatom email adresom.</p>";
                    exit();
                }

                $result = mysqli_query($handle, "insert into korisnik values('".$email_new."', '".$lozinka_new."', '".$ime_new."', '".$prezime_new."', ".$status_new.", 1)");
                
                if (strcmp($tip_new, "administrator") == 0)
                {
                    $result = mysqli_query($handle, "insert into administrator values('".$email_new."')");
                }
                else if (strcmp($tip_new, "zaposleni") == 0)
                {
                    require("config.php");
                    $result = mysqli_query($handle, "insert into zaposleni values('".$email_new."', '', '', '', '', '', '', '".$imgDefault."')");
                }
                else
                {
                    require("config.php");
                    $result =  mysqli_query($handle, "insert into student values('".$email_new."', '', '')");
                }

                dbDisconnect($handle, false);

                header("Location:upravljaj_korisnicima.php");
            }
        ?>
        <?php
            if (isset($_GET['obrisikorisnika']))
            {
                $email_za_brisanje = $_GET['email'];

                $handle = dbConnect();
                $result = mysqli_query($handle, "delete from korisnik where email='".$email_za_brisanje."'");
                $result = mysqli_query($handle, "delete from administrator where email='".$email_za_brisanje."'");
                $result = mysqli_query($handle, "delete from student where email='".$email_za_brisanje."'");
                $result = mysqli_query($handle, "delete from zaposleni where email='".$email_za_brisanje."'");

                dbDisconnect($handle, false);

                header("Location:upravljaj_korisnicima.php"); 
            }
        ?>
    </body>
</html>