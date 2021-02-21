<?php
    $sifra = $_GET['sifra'];

    require("mysql_functions.php");
    $handle = dbConnect();
    // Pretpostavljamo ispravnu sifru predmeta (dohvata se iz baze, ne bi trebalo da ima neispravnosti)
    $row = mysqli_fetch_assoc(mysqli_query($handle, "select * from predmet where sifra_predmet='".$sifra."'"));

    // Trazimo sve zaposlene na tom predmetu
    $result = mysqli_query($handle, "select * from drzi_predmet where sifra_predmet='".$sifra."'");
?>

<h2><b><?php echo $row['naziv'] ?></b></h2>

<ul>
    <li><p>Fond casova: <?php echo $row['fond_casova'] ?></p></li>
    <li><p>Broj ESPB: <?php echo $row['broj_ESPB'] ?></p></li>
    <li><p>Cilj predmeta: <?php echo $row['cilj_predmeta'] ?></p></li>
    <li><p>Ishod predmeta: <?php echo $row['ishod_predmeta'] ?></p></li>
    <li><p>Tip predmeta: <?php echo $row['tip_predmeta'] ?></p></li>
    <li><p>Komentar: <?php echo $row['komentar'] ?></p></li>
    
    <li>
        <p>Zaposleni:</p>
        <ul>
            <?php
                if ($result !== false && mysqli_num_rows($result) > 0)
                {
                    while ($row_zaposleni = mysqli_fetch_assoc($result))
                    {
                        $result_zaposleni = mysqli_fetch_assoc(mysqli_query($handle, "select * from korisnik where email='".$row_zaposleni['id_nastavnika']."'"));   
                        echo "<li>";
                        echo $result_zaposleni['ime']." ".$result_zaposleni['prezime'];
                        echo "</li>";
                    }
                }
            ?>
        </ul>
    </li>
</ul>