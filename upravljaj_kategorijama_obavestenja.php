<html>
    <head>
        <title>Upravljaj kategorijama obavestenja</title>
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
            
            if (!(isset($_SESSION['tip']) && strcmp($_SESSION['tip'], "administrator") == 0))
            {
                echo "Niste ovlasceni da vidite ovaj sadrzaj";
            }
            else
            {  
            ?>
            <div id="content">
                <h2 style='text-align: center'><b>Trenutne kategorije obavestenja</b></h2>
                <table>
                    <tr>
                        <td>ID</td>
                        <td>Naziv</td>               
                    </tr>
                    <?php
                        require("mysql_functions.php");
                        $handle = dbConnect();

                        $result = mysqli_query($handle, "select * from kategorija_obavestenja");

                        if ($result !== false && mysqli_num_rows($result) > 0)
                        {
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['naziv'] ?></td>
                                    <td>                                        
                                        <form method="GET">
                                            <input type="text" name="id" value="<?php echo $row['id']?>" hidden>
                                            <input type="submit" name="obrisi" value="Obrisi">
                                        </form>                                        
                                    </td>
                                </tr>
                                <?php
                            }
                        }

                        dbDisconnect($handle, $result);
                    ?>
                </table>
                <hr>
                <h2 style='text-align: center'><b>Dodaj novu kategoriju</b></h2>
                <form method="GET" onSubmit="return validateNewGeneralNotificationCategory();">
                    <p>Naziv kategorije <input type="text" id="imekategorije" name="imekategorije"> <input type="submit" name="dodaj" value="Dodaj kategoriju"></p>
                </form>
            </div>
            <?php
            }
            require("footer.php");
        ?>
        <?php
            if (isset($_GET['obrisi']))
            {
                $id_delete = $_GET['id'];

                $handle = dbConnect();
                $result = mysqli_query($handle, "delete from kategorija_obavestenja where id=".$id_delete);

                dbDisconnect($handle, false);
                header("Location:upravljaj_kategorijama_obavestenja.php");
            }
            if (isset($_GET['dodaj']))
            {
                $naziv_dodaj = $_GET['imekategorije'];

                $handle = dbConnect();
                $result = mysqli_query($handle, "insert into kategorija_obavestenja(naziv) values('".$naziv_dodaj."')");

                dbDisconnect($handle, false);
                header("Location:upravljaj_kategorijama_obavestenja.php");
            }
        ?>
    </body>
</html>