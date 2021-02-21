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
            <h2 style='text-align: center'><b>Master studije</b></h2>
            <?php
                require("mysql_functions.php");
                $handle = dbConnect();

                $result = array();

                for ($i = 9; $i <= 10; $i ++)
                {
                    echo "<h3><b>".$i.". semestar</b></h3>";

                    require("config.php");

                    $result = mysqli_query($handle, "select * from nastavni_plan where semestar=".$i." and id_odseka=".$ID_RTI);

                    if ($result !== false && mysqli_num_rows($result) > 0)
                    {
                        echo "<ul>";
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            /*
                                Neregistrovani korisnik vidi samo imena predmeta dok registrovani korisnik dobija link
                            */
                            $result_predmet = mysqli_query($handle, "select * from predmet where sifra_predmet='".$row['sifra_predmet']."'");
                            $info_predmet = mysqli_fetch_assoc($result_predmet);

                            if (isset($_SESSION['email']))
                            {
                                echo "<li><a href='predmet.php?sifra=".$info_predmet['sifra_predmet']."'>".$info_predmet['naziv']."</a></li>";
                            } 
                            else
                            {   
                                echo "<li>".$info_predmet['naziv']."</li>";
                            }
                        }
                        echo "</ul>";

                    }     
                }

                dbDisconnect($handle, false);
            ?>
           
        </div>
        <?php
            require("footer.php");
        ?>
    </body>
</html>