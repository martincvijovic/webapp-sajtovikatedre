<html>
    <head>
        <title>Pocetna strana</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
    </head>
    <body>
        <?php
            require("header.php");
            require("sidemenu.php");
        ?>
        <div id="content">
            <h2 style='text-align: center'><b>Obavestenja</b></h2>
            <?php

                require("mysql_functions.php");

                $handle = dbConnect();
                $result = mysqli_query($handle, "select * from obavestenje_sajt where datum_objave >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)");

                if ($result !== false && mysqli_num_rows($result) > 0)
                {
                    for ($i=0; $i<mysqli_num_rows($result); $i++)
                    {
                        $row = mysqli_fetch_assoc($result);
                        
                        $result_author = mysqli_query($handle, "select * from korisnik where email='".$row['autor']."'");
                        $row_author = mysqli_fetch_assoc($result_author);
                        $author = $row_author['ime']." ".$row_author['prezime'];

                        $result_kategorija = mysqli_query($handle, "select * from kategorija_obavestenja where id='".$row['id_kategorije']."'");
                        $kategorija = strtoupper(mysqli_fetch_assoc($result_kategorija)['naziv']);
                        
                        ?>
                        <p><b>
                            <span style='color: red'><?php echo $row['datum_objave']; ?></span>
                            | <?php echo $kategorija ?>
                            | <?php echo $row['naslov']; ?>
                        </b></p>
                        <p>
                        Autor: <?php echo $author ?>
                        </p>
                        <ul>
                            <li>
                                <?php echo $row['sadrzaj']; ?>
                            </li>
                        </ul>
                        <?php
                    }
                }
                else
                {
                    echo "<p style='text-align: center'>Nema novih obavestenja.</p>";
                }

                dbDisconnect($handle, $result);
            ?>
        </div>
        <?php
            require("footer.php");
        ?>
    </body>
</html>