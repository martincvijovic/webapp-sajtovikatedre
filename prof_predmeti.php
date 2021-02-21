<html>
    <head>
        <title>Moji predmeti</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
    </head>
    <body>
        <?php
            require("header.php");
            require("sidemenu.php");
        ?>
        <div id="content">
            <h2 style='text-align: center'><b>Moji predmeti</b></h2>
            <?php
                require("mysql_functions.php");
                $handle = dbConnect();

                $occurences = array(); // objasnjeno u daljim komentarima
                
                // ovaj upit automatski resava problem neovlascenog pristupa stranici
                $result_predmeti_sifre = mysqli_query($handle, "select * from drzi_predmet where id_nastavnika='".$_SESSION['email']."'");

                if ($result_predmeti_sifre !== false && mysqli_num_rows($result_predmeti_sifre) > 0)
                {
                    echo "<ul>";
                    while ($row = mysqli_fetch_assoc($result_predmeti_sifre))
                    {
                        $sifra = $row['sifra_predmet'];
                        $result = mysqli_query($handle, "select * from predmet where sifra_predmet='".$sifra."'");

                        if ($result !== false && mysqli_num_rows($result) > 0)
                        {
                            $row = mysqli_fetch_assoc($result); // samo jedan rezultat, pretpostavljamo ispravnu bazu

                            /**
                             * 
                             * Buduci da jedan profesor moze drzati vise tipova nastave, bitno je da ne prikazujemo
                             * isti predmet vise puta
                             * 
                            */

                            if (!isset($occurences[$row['sifra_predmet']]))
                            {
                                echo "<li>";
                                echo "<a href='prof_izmeni_predmet.php?sifra=".$sifra."'>".$row['naziv']."</a>";
                                echo "</li>";

                                $occurences[$row['sifra_predmet']] = 1;
                            }
                        }
                    }
                    echo "</ul>";
                }
            ?>
        </div>
        <?php
            require("footer.php");
        ?>
    </body>
</html>