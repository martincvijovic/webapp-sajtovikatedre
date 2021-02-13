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
            
            if (!(isset($_SESSION['tip']) && strcmp($_SESSION['tip'], "administrator") == 0))
            {
                echo "Niste ovlasceni da vidite ovaj sadrzaj";
            }
            else
            {  
            ?>
            <div id="content">
                <h2 style='text-align: center'><b>Novo opste obavestenje</b></h2>
                <form id="novoopsteobavestenje" method="POST" onSubmit="return validateNewGeneralNotification();">
                    <p>
                        Kategorija
                        <select name="kategorija">
                            <?php
                                require("mysql_functions.php");
                                $handle = dbConnect();

                                $result = mysqli_query($handle, "select * from kategorija_obavestenja");
                                
                                if ($result !== false)
                                for ($i=0; $i<mysqli_num_rows($result); $i++)
                                {
                                    $row = mysqli_fetch_assoc($result);
                                    $id = $row['id'];
                                    $naziv = $row['naziv'];

                                    echo "<option value='".$id."'>".$naziv."</option>";
                                }

                                dbDisconnect($handle, $result);
                            ?>
                        </select>
                        <p>Naslov <input type="text" id="naslov" name="naslov"> </p>
                        <p>Sadrzaj obavestenja:
                            <textarea class="ckeditor" id="sadrzaj" name="sadrzaj"></textarea>
                        </p>
                        <input type="submit" name="posaljiopsteobavestenje" value="Objavi">
                    </p>
                </form>
            </div>
            <?php
            }
            require("footer.php");
        ?>
        <?php
            if (isset($_POST['posaljiopsteobavestenje']))
            {
                $naslov = $_POST['naslov'];
                $sadrzaj = $_POST['sadrzaj'];
                $kategorija = $_POST['kategorija'];

                $autor = $_SESSION['email'];

                $handle = dbConnect();
                $result = mysqli_query($handle, "insert into obavestenje_sajt(id_kategorije, naslov, sadrzaj, datum_objave, autor) values (".$kategorija.", '".$naslov."', '".$sadrzaj."', '".date('Y-m-d')."', '".$autor."')");

                dbDisconnect($handle, false);

                header("Location:index.php");
            }
        ?>
    </body>
</html>