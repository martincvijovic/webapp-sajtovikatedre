<?php
    $sifra = $_GET['sifra'];

    require("mysql_functions.php");
    $handle = dbConnect();
    // Upit za obavestenja koja nisu starija od 7 dana
    $result = mysqli_query($handle, "select * from obavestenje_predmet where id_predmet='".$sifra."' and datum_objave >= now() - interval 1 week order by id_obavestenja desc");

    if ($result !== false && mysqli_num_rows($result) > 0)
    {
        echo "<div style='border:solid'>";

        while ($row = mysqli_fetch_assoc($result))
        {
            $result_fajl = mysqli_query($handle, "select * from fajl_uz_obavestenje where id_obavestenja=".$row['id_obavestenja']);

            ?>
            <p><b>
                <span style='color: red'><?php echo $row['datum_objave']; ?></span>
                | <?php echo $row['naslov']; ?>
            </b></p>
            <p>
            Autor: <?php echo $row['id_nastavnik'] ?>
            </p>
            <ul>
                <li>
                    <?php echo $row['sadrzaj']; ?>
                </li>
            </ul>
            <?php
            if ($result_fajl !== false && mysqli_num_rows($result_fajl) > 0)
            {
                echo "<a style='color: red' target='_blank' href='".mysqli_fetch_assoc($result_fajl)['putanja']."'>PRILOZENI FAJL</a>";
            }
        }
    }
    echo "</div>";

    // Upit za ostala obavestenja
    $result = mysqli_query($handle, "select * from obavestenje_predmet where id_predmet='".$sifra."' and datum_objave < now() - interval 1 week order by id_obavestenja desc");

    if ($result !== false && mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            $result_fajl = mysqli_query($handle, "select * from fajl_uz_obavestenje where id_obavestenja=".$row['id_obavestenja']);    
            ?>
            <p><b>
                <span style='color: red'><?php echo $row['datum_objave']; ?></span>
                | <?php echo $row['naslov']; ?>
            </b></p>
            <p>
            Autor: <?php echo $row['id_nastavnik'] ?>
            </p>
            <ul>
                <li>
                    <?php echo $row['sadrzaj']; ?>
                </li>
            </ul>
            <?php
            if ($result_fajl !== false && mysqli_num_rows($result_fajl) > 0)
            {
                echo "<a style='color: red' target='_blank' href='".mysqli_fetch_assoc($result_fajl)['putanja']."'>PRILOZENI FAJL</a>";
            }
        }
    }

    dbDisconnect($handle, false);
?>