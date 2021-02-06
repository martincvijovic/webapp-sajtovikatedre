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
                    ?>
                    <form method="GET">
                        <p>Ulogovani ste kao: <?php echo $_SESSION['ime'] ?> <input type="submit" value="Izlogujte se" name="logout"></p>
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
                header("Location:/projekat/index.php");
            }
        ?>
    </body>
</html>