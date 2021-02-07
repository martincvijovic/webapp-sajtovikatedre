<html>
    <head>
        <title>Prijava</title>
        <link rel="stylesheet" type="text/css" href="login_style.css">
    </head>
    <body>
        <h2>Prijavite se</h2>
        
        <form method="POST">
            <p>Email: <input type="text" name="email" value=<?php echo (isset($_POST['login'])) ? $_POST['email'] : "" ?> ></p>
            <p>Password: <input type="password" name="password"></p>
            <input type="submit" name="login" value="Login">
        </form>

        <?php
            if (isset($_POST['login'])) // TODO : DODAJ STATUS !!!
            {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if (strlen($email) == 0 || strlen($password) == 0)
                {
                    echo "<p'>Polje za unos ne sme biti prazno!</p>";
                    exit();
                }

                require("mysql_functions.php");
                
                $handle = dbConnect();

                if ($handle == false)
                {
                    exit();
                }

                $result = mysqli_query($handle, "select * from korisnik where email='".$email."' and lozinka='".$password."'");

                if ($result != false && mysqli_num_rows($result) > 0) 
                {
                    $row = mysqli_fetch_assoc($result);
                    $first_access = $row['prvipristup'];
                    $ime = $row['ime'];
                    $status = $row['status'];
                }
                else
                {
                    echo "<p>Pogresno korisnicko ime ili lozinka</p>";
                    dbConnect($handle, false);
                    exit();
                }

                if ($status == 0)
                {
                    echo "<p>Nalog '$ime' nije aktivan. Molimo kontaktirajte administratora.</p>";
                }

                $tipovi = ["administrator", "zaposleni", "student"];
                foreach ($tipovi as $tip)
                {
                    $result = mysqli_query($handle, "select * from ".$tip." where email='".$email."'");

                    if ($result != false && mysqli_num_rows($result) > 0)
                    {
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['ime'] = $ime;
                        $_SESSION['tip'] = $tip;
                        break;
                    }
                }

                dbDisconnect($handle, $result);

                if ($first_access)
                {
                    header("Location:/projekat/change_password.php");
                }
                else
                {
                    header("Location:/projekat/index.php");
                }
            }
        ?>
    </body>
</html>