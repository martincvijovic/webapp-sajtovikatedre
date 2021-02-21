<html>
    <head>
        <title>Dodajte novo obavestenje</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">

        <script src="ckeditor/ckeditor.js"></script>
        <script src="validate.js"></script>
    </head>
    <body>
        <?php
            require("header.php");
            require("sidemenu.php");
            ob_start();
        ?>
        <div id="content">
            <h2 style='text-align: center'><b>Novo obavestenje</b></h2>
            <form id="zaposleniupdate" enctype="multipart/form-data" method="POST" onSubmit="return validateNewProfessorNotification();">
                <p>Naslov vesti <input type="text" name="naslov" id="naslov"></p>
                <p>Sadrzaj vesti:
                    <textarea class="ckeditor" id="sadrzaj" name="sadrzaj"></textarea>
                </p>
                <p>
                    Predmet
                    <select name="predmet">
                        <?php
                            // Upit obezbedjuje da nece biti problema prilikom neovlascenog pristupa
                            require("mysql_functions.php");
                            $handle = dbConnect();
                            $result = mysqli_query($handle, "select * from drzi_predmet where id_nastavnika='".$_SESSION['email']."'");               
                            
                            /**
                             * Nema potrebe da se prikazuje isti predmet vise puta ukoliko nastavnik drzi vise grupa 
                            */
                            $occurences = array();

                            if ($result !== false && mysqli_num_rows($result) > 0)
                            {
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    $result_ime = mysqli_fetch_assoc(mysqli_query($handle, "select * from predmet where sifra_predmet='".$row['sifra_predmet']."'"))['naziv'];
                                    
                                    if (!isset($occurences[$row['sifra_predmet']]))
                                    {
                                        echo "<option value='".$row['sifra_predmet']."'>".$result_ime."</option>";
                                        $occurences[$row['sifra_predmet']] = 1;
                                    }                 
                                }
                            }
                            dbDisconnect($handle, false);
                        ?>
                    </select>
                </p>
                <p>Dodajte fajl uz obavestenje <input type="file" name="fajl" id="fajl"></p>
                <input type="submit" name='objavi' value="Objavi">
            </form>
        </div>
        <?php
            require("footer.php");

            if (isset($_POST['objavi']))
            {
                $naslov = $_POST['naslov'];
                $sadrzaj = $_POST['sadrzaj'];
                $sifra_predmet = $_POST['predmet'];

                $handle = dbConnect();

                $result = mysqli_query($handle, "insert into obavestenje_predmet(id_predmet, naslov, sadrzaj, datum_objave, id_nastavnik) values ('".$sifra_predmet."', '".$naslov."', '".$sadrzaj."', CURDATE(), '".$_SESSION['email']."')");        
                
                if (strcmp($_FILES['fajl']['name'], "") !== 0)
                {
                    $result = mysqli_query($handle, "select * from obavestenje_predmet");
                    // Najnovije obavestenje ce biti u poslednjem redu
                    for ($i = 0; $i < mysqli_num_rows($result); $i++)
                    {
                        $row = mysqli_fetch_assoc($result);
                    }
                
                    $id_obavestenja = $row['id_obavestenja'];

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

                        $result = mysqli_query($handle, "insert into fajl_uz_obavestenje (id_obavestenja, putanja) values (".$id_obavestenja.", '".$target_file."')");
                        header("Location:prof_novo_obavestenje.php");

                        
                    }
                }
                    
                    
                dbDisconnect($handle, false);
            }
        ?>
    </body>
</html>