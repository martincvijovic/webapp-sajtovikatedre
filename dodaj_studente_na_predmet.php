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
                    <h2 style='text-align: center'><b>Dodaj studente na predmet</b></h2>
                    <form method="GET">
                        <p>Unesi email adresu studenta <input type="text" name="email"></p>
                        <p>
                            Izaberi predmet
                            <select name="predmet">
                            <?php
                                require("mysql_functions.php");
                                $handle = dbConnect();
                                $result = mysqli_query($handle, "select * from predmet");

                                if ($result !== false && mysqli_num_rows($result) > 0)
                                {
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<option value='".$row['sifra_predmet']."'>".$row['naziv']."</option>";
                                    }
                                }

                                dbDisconnect($handle, false);
                            ?>
                            </select>
                        </p>
                        <input type="submit" value="Dodaj" name="dodaj">
                    </form>
                </div>
            <?php
            }
            require("footer.php");
        ?>
    </body>
    <?php
        if (isset($_GET['dodaj']))
        {
            $email = $_GET['email'];
            $sifra_predmet = $_GET['predmet'];

            $handle = dbConnect();
            $result_stud = mysqli_query($handle, "select * from student where email='".$email."'");

            if ($result_stud !== false && mysqli_num_rows($result_stud) == 1)
            {
                $result_prati_pred = mysqli_query($handle, "insert into prati_predmet values('".$email."', '".$sifra_predmet."')");
            }
            else
            {
                echo "<p>Ne postoji student sa unetim emailom</p>";
                exit();
            }

            dbDisconnect($handle, false);
        }
    ?>
</html>