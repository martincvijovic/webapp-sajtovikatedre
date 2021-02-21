<html>
    <head>
        <title>Moji predmeti</title>
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
            
            if (!(isset($_SESSION['tip']) && strcmp($_SESSION['tip'], "student") == 0))
            {
                echo "Niste ovlasceni da vidite ovaj sadrzaj";
            }
            else
            {  
            ?>
            <div id="content">
                <h2 style='text-align: center'>Moji predmeti - <?php echo $_SESSION['email'] ?></h2>
                <ul>
                    <?php
                        require("mysql_functions.php");
                        $handle = dbConnect();
                        $result = mysqli_query($handle, "select * from prati_predmet where id_student='".$_SESSION['email']."'");

                        if ($result !== false && mysqli_num_rows($result) > 0)
                        {
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                $naziv_predmet = mysqli_fetch_assoc(mysqli_query($handle, "select * from predmet where sifra_predmet='".$row['sifra_predmet']."'"))['naziv'];
                                echo "<li><p>";
                                echo "<a href='predmet.php?sifra=".$row['sifra_predmet']."'>".$naziv_predmet."</a>";
                                ?>
                                <form method="GET">
                                    <input type="text" name="sifra_predmet" hidden value="<?php echo $row['sifra_predmet'] ?>">
                                    <input type="submit" value="Otprati predmet" name="otprati">
                                </form>
                                <?php
                                echo "</p></li>";
                            }
                        }

                        dbDisconnect($handle, false);
                    ?>
                </ul>
            </div>
            <?php
            }
            require("footer.php");
        ?>
        <?php
            if (isset($_GET['otprati']))
            {
                $sifra_predmet = $_GET['sifra_predmet'];
                
                $handle = dbConnect();
                $result = mysqli_query($handle, "delete from prati_predmet where id_student='".$_SESSION['email']."' and sifra_predmet='".$sifra_predmet."'");

                dbDisconnect($handle, false);

                header("Location:student_moji_predmeti.php");
            }
        ?>
    </body>
</html>