<html>
    <head>
        <title>Predmet</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
    </head>
    <body>
        <?php
            $sifra = $_GET['sifra'];

            require("header.php");
            require("sidemenu.php");
            require("mysql_functions.php");

            $handle = dbConnect();
            $ime_predmeta = mysqli_fetch_assoc(mysqli_query($handle, "select * from predmet where sifra_predmet='".$sifra."'"))['naziv'];

            dbDisconnect($handle, false);
        ?>
        <div id="content">
            <h2 style='text-align: center'><b><?php echo $ime_predmeta ?></b></h2>
            <hr>
            <table id="predmet-meni">
                <tr>              
                    <td><a href="<?php echo "prof_izmeni_info_predmet.php?sifra=".$sifra ?>" target="frame">Informacije o predmetu</a></td>
                    <td><a href="<?php echo "prof_izmeni_predavanja_predmet.php?sifra=".$sifra ?>" target="frame">Predavanja</a></td>
                    <td><a href="<?php echo "prof_izmeni_vezbe_predmet.php?sifra=".$sifra ?>" target="frame">Vezbe</a></td>
                    <td><a href="<?php echo "prof_izmeni_ispitnapitanja_predmet.php?sifra=".$sifra ?>" target="frame">Ispitna pitanja</a></td>
                </tr>
            </table>
            <hr>
            <iframe src="<?php echo "prof_izmeni_info_predmet.php?sifra=".$sifra ?>" name="frame" style="border: none; width:100%; height:100%">
            </iframe>
        </div>
        <?php
            require("footer.php");
        ?>
    </body>
</html>