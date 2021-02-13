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
            <table id="predmet-meni">
                <tr>              
                    <td><a href="<?php echo "info_predmet.php?sifra=".$sifra ?>" target="frame">O predmetu</a></td>
                    <td><a href="<?php echo "predavanja_predmet.php?sifra=".$sifra ?>" target="frame">Predavanja</a></td>
                    <td><a href="<?php echo "vezbe_predmet.php?sifra=".$sifra ?>" target="frame">Vezbe</a></td>
                    <td><a href="<?php echo "ispitnapitanja_predmet.php?sifra=".$sifra ?>" target="frame">Ispitna pitanja</a></td>
                </tr>
            </table>
            <iframe src="<?php echo "info_predmet.php?sifra=".$sifra ?>" name="frame" style="border: none; width:100%; height:100%">
            </iframe>
        </div>
        <?php
            require("footer.php");
        ?>
    </body>
</html>