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

                    $result = mysqli_query($handle, "select * from predmet where semestar=".$i);

                    if ($result !== false && mysqli_num_rows($result) > 0)
                    {
                        echo "<ul>";
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            /*
                                Neregistrovani korisnik vidi samo imena predmeta dok registrovani korisnik dobija link
                            */
                            if (isset($_SESSION['email']))
                            {
                                echo "<li><a href='predmet.php?sifra=".$row['sifra_predmet']."'>".$row['naziv']."</a></li>";
                            } 
                            else
                            {   
                                echo "<li>".$row['naziv']."</li>";
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