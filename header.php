<html>
    <head>
        <link rel="stylesheet" type="text/css" href="header_style.css">
    </head>
    <body>
        <div id="info">
            <p>Katedra za racunarsku tehniku i informatiku</p>
        </div>
        <div id="user">
            <?php
                session_start();
                if (isset($_SESSION['email']))
                {
                    echo "Ulogovani ste kao: ".$_SESION['ime'].".";
                    ?>
                    <form method="GET">
                        <input type="submit" value="Izlogujte se" name="logout">
                    </form>
                    <?php
                }
                else
                {
                    ?>
                    <form action="login.php">
                        <p>Trenutno ste ulogovani kao gost. <input type="submit" name="login" value="Prijavite se"></p>
                    </form>
                    <?php
                }
            ?>
        </div>
        <?php
            if (isset($_GET['logout']))
            {
                session_destroy();
                $_SESSION = array();
            }
        ?>
    </body>
</html>