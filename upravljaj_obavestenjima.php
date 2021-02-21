<html>
    <head>
        <title>Upravljaj obavestenjima</title>
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

            require("mysql_functions.php");
            $handle = dbConnect();
            
            if (!(isset($_SESSION['tip']) && strcmp($_SESSION['tip'], "zaposleni") == 0))
            {
                echo "Niste ovlasceni da vidite ovaj sadrzaj";
            }
            else
            {  
            ?>
            <div id="content">
                <h2 style='text-align: center'><b>Lista obavestenja koje ste postavili</b></h2>

                <?php
                $result = mysqli_query($handle, "select * from obavestenje_predmet where id_nastavnik='".$_SESSION['email']."'");
                if ($result !== false && mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $result_fajl = mysqli_query($handle, "select * from fajl_uz_obavestenje where id_obavestenja=".$row['id_obavestenja']);
                        
                        ?>
                        <p><b>
                            <span style='color: red'><?php echo $row['datum_objave']; ?></span>

                            | <?php echo $row['id_predmet'] ?> | <?php echo $row['naslov']; ?> 
                            <p>
                                <form method="GET">
                                    <p>
                                        <input type="text" value="<?php echo $row['id_obavestenja']?>" name="id" hidden>
                                        <input type="submit" value="Izmeni tekst obavestenja" name="izmeni">
                                        <input type="submit" value="Obrisi obavestenje" name="obrisi">
                                    </p>
                                </form>
                            </p>
                        </b></p>
                        
                        <ul>
                            <li>
                                <?php echo $row['sadrzaj']; ?>
                            </li>
                        </ul>
                        <?php
                        if ($result_fajl !== false && mysqli_num_rows($result_fajl) > 0)
                        {
                            echo "<a target='_blank' href='".mysqli_fetch_assoc($result_fajl)['putanja']."'>PRILOZENI FAJL</a>";
                            ?>
                            <form method="POST" enctype="multipart/form-data">
                                Azuriraj fajl <input type="file" name="fajl">
                                <input type="text" name="id_obavestenja" hidden value="<?php echo $row['id_obavestenja'] ?>">
                                <input type="submit" value="Azuriraj fajl" name="azurirajfajl">
                                <input type="submit" value="Obrisi fajl" name="obrisifajl">
                            </form>
                            <?php
                        }
                        else
                        {
                            ?>
                            <form method="POST" enctype="multipart/form-data">
                                Dodajte novi fajl <input type="file" name="fajl">
                                <input type="text" name="id_obavestenja" hidden value="<?php echo $row['id_obavestenja'] ?>">
                                <input type="submit" value="Dodaj" name="novfajl">
                            </form>
                            <?php
                        }
                        ?>
                        <hr>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
            }
            require("footer.php");
        ?>
        <?php
            if (isset($_GET['izmeni']))
            {
                header("Location:izmeni_obavestenje.php?id_obavestenja=".$_GET['id']);
            }
            if (isset($_GET['obrisi']))
            {
                $handle = dbConnect();
                mysqli_query($handle, "delete from obavestenje_predmet where id_obavestenja=".$_GET['id']);
                dbDisconnect($handle, false);
                
                header("Location:upravljaj_obavestenjima.php");
            }
            if (isset($_POST['obrisifajl']))
            {
                $handle = dbConnect();
                $handle = dbConnect();
                $oldfilepath = mysqli_fetch_assoc(mysqli_query($handle, "select * from fajl_uz_obavestenje where id_obavestenja=".$_POST['id_obavestenja']))['putanja'];
                $result = mysqli_query($handle, "delete from fajl_uz_obavestenje where id_obavestenja=".$_POST['id_obavestenja']);
                
                dbDisconnect($handle, false);

                header("Location:upravljaj_obavestenjima.php");
            }
            if (isset($_POST['azurirajfajl']))
            {
                // Razlikuje se od novog fajla po tome sto se mora obrisati stari
                if (strcmp($_FILES['fajl']['name'], "") !== 0)
                {
                    // Brisanje starog fajla
                    $handle = dbConnect();
                    $oldfilepath = mysqli_fetch_assoc(mysqli_query($handle, "select * from fajl_uz_obavestenje where id_obavestenja=".$_POST['id_obavestenja']))['putanja'];

                    dbDisconnect($handle, false);

                    $target_file = "files/".basename($_FILES["fajl"]["name"]);
                    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    $uploadOK = 1;

                    if (!file_exists($target_file))
                    {
                        if (!move_uploaded_file($_FILES["fajl"]["tmp_name"], $target_file)) 
                        {
                            $uploadOK = 0;
                        }
                    }

                    if ($uploadOK)
                    {
                        $handle = dbConnect();
                        mysqli_query($handle, "update fajl_uz_obavestenje set putanja='".$target_file."' where id_obavestenja='".$_POST['id_obavestenja']."'");
                        dbDisconnect($handle, false);
                        header("Location:upravljaj_obavestenjima.php");
                    }
                }
            }
            if (isset($_POST['novfajl']))
            {
                if (strcmp($_FILES['fajl']['name'], "") !== 0)
                {
                    $target_file = "files/".basename($_FILES["fajl"]["name"]);
                    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    $uploadOK = 1;

                    if (!file_exists($target_file))
                    {
                        if (!move_uploaded_file($_FILES["fajl"]["tmp_name"], $target_file)) 
                        {
                            $uploadOK = 0;
                        }
                    }

                    if ($uploadOK)
                    {
                        $handle = dbConnect();
                        mysqli_query($handle, "insert into fajl_uz_obavestenje(id_obavestenja, putanja) values (".$_POST['id_obavestenja'].", '".$target_file."')");
                        dbDisconnect($handle, false);
                        header("Location:upravljaj_obavestenjima.php");
                    }
                }
            }
        ?>
    </body>
</html>