<html>
    <head>
        <title>Pocetna strana</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
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
                                        <input type="text" name="email" value=<?php echo $email ?> hidden> <!-- mozda malo lepse? -->
                                        <input type="submit" name="submit" value="Izmeni">
                                    </form>
                                    <?php
                                    echo "</td>";
                                    echo "<td>";
                                    ?>
                                    <form method="GET">
                                        <input type="text" name="email" value=<?php echo $email ?> hidden> <!-- mozda malo lepse? -->
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
                </div>
            <?php
            }
            require("footer.php");
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

                header("Location:/projekat/upravljaj_korisnicima.php");
            }
        ?>
    </body>
</html>