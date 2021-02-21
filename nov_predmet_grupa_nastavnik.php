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
                <h2 style='text-align: center'><b>Dodeli predmet nastavniku</b></h2>
                <form id="novpredmetgrupanastavnik" method="POST" onSubmit="return validateNovPredmetGrupaNastavnik();">
                    <p>Nastavnik <select name='nastavnik'>
                        <?php
                            require("mysql_functions.php");
                            $handle = dbConnect();
                            $result = mysqli_query($handle, "select * from zaposleni");
                            
                            if ($result !== false && mysqli_num_rows($result) > 0)
                            {
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    $nastavnik_info = mysqli_fetch_assoc(mysqli_query($handle, "select * from korisnik where email='".$row['email']."'"));
                                    echo "<option value='".$row['email']."'>".$nastavnik_info['ime']." ".$nastavnik_info['prezime']."</option>";
                                }
                            }

                            dbDisconnect($handle, false);
                        ?>
                    </select></p>
                    <p>Predmet <select name='predmet'>
                        <?php
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
                    </select></p>
                    <p>Nastavna grupa <input type="text" name="grupa"></p>
                    <input type="submit" value="Dodaj" name="dodelipredmet">
                </form>
            </div>
            <?php
            }
            require("footer.php");
        ?>
        <?php
            if (isset($_POST['dodelipredmet']))
            {
                if (strcmp($_POST['grupa'], "") == 0)
                {
                    echo "Unesite nastavnu grupu!";
                    exit();
                }

                $handle = dbConnect();
                $result = mysqli_query($handle, "select * from drzi_predmet where id_nastavnika='".$_POST['nastavnik']."' and sifra_predmet='".$_POST['predmet']."' and grupa='".$_POST['grupa']."'");

                if ($result !== false && mysqli_num_rows($result) > 0)
                {
                    echo "Nastavniku je vec uneta trazena grupa!";
                    exit();
                }

                $result = mysqli_query($handle," insert into drzi_predmet (id_nastavnika, sifra_predmet, grupa) values ('".$_POST['nastavnik']."', '".$_POST['predmet']."', '".$_POST['grupa']."')");
                echo ("Uspesno dodeljena grupa");
            }
        ?>
    </body>
</html>