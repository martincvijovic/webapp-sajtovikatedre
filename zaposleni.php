<html>
    <head>
        <title>Pocetna strana</title>
        <link rel="stylesheet" type="text/css" href="nomargin-style.css">
        <link rel="stylesheet" type="text/css" href="content-style.css">
        <script src="validate.js"></script>
        <script src="ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <?php
            ob_start();
            require("header.php");
            require("sidemenu.php");
        ?>
        <div id="content">
            <h2 style='text-align: center'><b>Zaposleni</b></h2>
            <ul>
                <?php
                    require("mysql_functions.php");
                    require("db_to_string_zvanje.php");

                    $handle = dbConnect();

                    $result = mysqli_query($handle, "select * from zaposleni");
                    if ($result !== false && mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $zaposleni_info = mysqli_fetch_assoc(mysqli_query($handle, "select * from korisnik where email='".$row['email']."'"));

                            echo "<li>";
                            ?>
                            <p><b><?php echo "<a href='info_zaposleni.php?email=".$zaposleni_info['email']."'>".$zaposleni_info['ime']." ".$zaposleni_info['prezime']."</a> " ?></b></p>
                            <div class="row">
                                <div class="col">
                                    <img src= <?php echo $row['profilnaslika'] ?>>
                                </div>
                                <div class="col">
                                    <p><?php echo dbToStringZvanje($row['zvanje']) ?></p>
                                    <p>Predmeti:</p>
                                    <ul>
                                        <?php
                                            $result_predmet = mysqli_query($handle, "select * from drzi_predmet where id_nastavnika='".$row['email']."'");
                                            
                                            if ($result_predmet !== false && mysqli_num_rows($result_predmet) > 0)
                                            {
                                                while ($row_predmet = mysqli_fetch_assoc($result_predmet))
                                                {
                                                    $sifra_predmeta = $row_predmet['sifra_predmet'];
                                                    $predmet_result = mysqli_fetch_assoc(mysqli_query($handle, "select * from predmet where sifra_predmet='".$sifra_predmeta."'"));
                                                    $imepredmeta = $predmet_result['naziv'];
                                                    $grupa_drzanja_predmeta = $row_predmet['grupa'];

                                                    if (isset($_SESSION['email']))
                                                    {
                                                        echo "<li><a href='predmet.php?sifra=".$sifra_predmeta."'>".$imepredmeta."</a> - ".$grupa_drzanja_predmeta."</li>";
                                                    }
                                                    else
                                                    {
                                                        echo "<li>".$imepredmeta." - ".$grupa_drzanja_predmeta."</li>";
                                                    }
                                                    
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div id="content_left">                               
                                
                            </div>
                            <div id="content_right">
                                
                            </div>
                            <?php
                            echo "</li>";
                        }
                    }

                    dbDisconnect($handle, false);

                ?>
            </ul>
        </div>
        <?php       
        require("footer.php");
        ?>
    </body>
</html>