<form enctype="multipart/form-data" method="POST">
    <p>Dodajte novi fajl</p>
    <p>Ime fajla <input type="text" name="naslov"></p>
    <input type="file" name="fajl" id="fajl">
    <input type="submit" value="Dodaj" name="dodajfajl">
</form>

<?php
    require("mysql_functions.php");

    $handle = dbConnect();
    $result = mysqli_query($handle, "select * from materijal where tip_materijala = 'predavanja' and sifra_predmet = '".$_GET['sifra']."' order by datum_objave desc");

    if ($result !== false && mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $result_autor = mysqli_fetch_assoc(mysqli_query($handle, "select * from korisnik where email='".$row['id_nastavnik']."'"));
            $autor_ime = $result_autor['ime']." ".$result_autor['prezime'];

            echo "<p><a href='".$row['fajlputanja']."' target='_blank'>".$row['naslov']."</a> | ".$row['datum_objave']." | Autor: ".$autor_ime." <a href='prof_izmeni_predavanja_predmet.php?obrisi=1&id=".$row['id_materijal']."'>Obrisi</a></p>";
        }
    }

    if (isset($_GET['obrisi']) && $_GET['obrisi'] == 1)
    {
        $result = mysqli_query($handle, "delete from materijal where id_materijal=".$_GET['id']);
        unset($_GET['obrisi']);
        dbDisconnect($handle, false);
        
        header("Location:prof_izmeni_predavanja_predmet.php?sifra=".$_GET['sifra']);
    }

    dbDisconnect($handle, false);
?>
<?php
    if (isset($_POST['dodajfajl']))
    {
        if (strcmp($_POST['naslov'], "") == 0)
        {
            echo("Morate uneti ime fajla");
            exit();
        }
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

                session_start();
                echo ($_GET['sifra']);

                echo ($_SESSION['email']);
                echo ($_POST['naslov']);
                echo ($target_file);

                $result = mysqli_query($handle, "insert into materijal (naslov, fajlputanja, sifra_predmet, tip_materijala, id_nastavnik, datum_objave, vidljiv) values ('".$_POST['naslov']."', '".$target_file."', '".$_GET['sifra']."', 'predavanja', '".$_SESSION['email']."', CURDATE(), 1)");
                header("Location:prof_izmeni_predavanja_predmet.php?sifra=".$_GET['sifra']);

                dbDisconnect($handle, false);
            }
        }
    }
?>

