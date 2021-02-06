<html>
    <head>
    </head>
    <?php
        session_start();
        $email = $_SESSION['email'];
        $tip = $_SESSION['tip'];

        require("mysql_functions.php");

        $handle = dbConnect();
        $result = mysqli_query($handle, "select ime from korisnik where email='".$email."'"); 

        $row = mysqli_fetch_assoc($result);
        $first_name = $row['ime'];

        dbDisconnect($handle, $result);
    ?>
    <body>
        <p>Promena lozinke</p>

        <form method="POST">
            <p>Unesite novu lozinku <input type="password" name="password1"></p>
            <p>Ponovite novu lozinku <input type="password" name="password2"></p>
            <input type="submit" name="changepassword" value="Promeni lozinku">
        </form>

        <?php
            if (isset($_POST['changepassword']))
            {
                $password1 = $_POST['password1'];
                $password2 = $_POST['password2'];

                if (strcmp($password1, $password2) == 0)
                {
                    $handle = dbConnect();

                    // menjamo sifru i stavljamo prvi pristup na nulu
                    $result = mysqli_query($handle, "update korisnik set lozinka='".$password1."' where email='".$email."'");
                    $result = mysqli_query($handle, "update korisnik set prvipristup=0 where email='".$email."'");

                    dbDisconnect($handle, $result);

                    header("Location:/projekat/login.php");
                }
                else
                {
                    echo "<span style='color: red'>Polja za unos nove lozinke se ne poklapaju.</span>";
                }
            }
        ?>
    </body>
</html>