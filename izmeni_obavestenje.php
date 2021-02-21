<html>
    <head>
        <title>Pocetna strana</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">

        <script src="validate.js"></script>
        <script src="ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <?php
            require("header.php");
            require("sidemenu.php");

            /**
             * Potrebno je da $_GET['id_obavestenja'] bude setovan i da se id profesora u bazi poklapa sa profesorom u sesiji
            */
            if (!isset($_GET['id_obavestenja']))
            {
                echo("404 not found GET :(");
                exit();
            }

            require("mysql_functions.php");
            $handle = dbConnect();
            $result = mysqli_query($handle, "select * from obavestenje_predmet where id_obavestenja=".$_GET['id_obavestenja']);
            
            dbDisconnect($handle, false);
                
            if ($result !== false && mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_assoc($result);
                if (strcmp($row['id_nastavnik'], $_SESSION['email']) !== 0)
                {
                    echo "Niste ovlasceni da vidite ovaj sadrzaj";
                    exit();
                }
                ?>
                    <div id="content">
                        <h2 style='text-align: center'>Obavestenje na predmetu <b><?php echo $row['id_predmet'] ?></b> </h2>
                        <form id="obavestenjepredmetupdate" method="POST" onSubmit="return validateObavestenjePredmetUpdate();">
                            <p>
                                Naslov vesti <input type="text" id="naslov" name="naslov" value="<?php echo $row['naslov'] ?>">
                            </p>
                            <p>Sadrzaj vesti:
                                <textarea class="ckeditor" id="sadrzaj" name="sadrzaj"><?php echo $row['sadrzaj'] ?></textarea>
                            </p>
                            <input type="submit" value="Azuriraj obavestenje" name="izmeniobavestenje">
                        </form>
                    </div>
                <?php
                
            }
            else
            {
                echo("404 not found query :(");
                exit();
            }
        ?>
        <?php
            require("footer.php");

            if (isset($_POST['izmeniobavestenje']))
            {
                $handle = dbConnect();
                $result = mysqli_query($handle, "update obavestenje_predmet set naslov='".$_POST['naslov']."', sadrzaj='".$_POST['sadrzaj']."', datum_objave=CURDATE() where id_obavestenja=".$row['id_obavestenja']);
                dbDisconnect($handle, false);

                header("Location:upravljaj_obavestenjima.php");
            }
        ?>
    </body>
</html>