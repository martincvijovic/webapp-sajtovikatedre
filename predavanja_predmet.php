
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

            echo "<p><a href='".$row['fajlputanja']."' target='_blank'>".$row['naslov']."</a> | ".$row['datum_objave']." | Autor: ".$autor_ime."<p>";
        }
    }

    dbDisconnect($handle, false);
?>

