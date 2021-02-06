<html>
    <head>
        <title>Pocetna strana</title>
        <link rel="stylesheet" type="text/css" href="homepage_style.css">
    </head>
    <body>
        <h2>Dobrodosli</h2>
        
        <form method="POST">
            <p>Email: <input type="text" name="email" value=<?php echo (isset($_POST['login'])) ? $_POST['email'] : "" ?> ></p>
            <p>Password: <input type="password" name="password"></p>
            <input type="submit" name="login" value="Login">
            <input type="submit" name="guestlogin" value="Nastavi kao gost">
        </form>

        <?php
            if (isset($_POST['login']))
            {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if (strlen($email) == 0 || strlen($password) == 0)
                {
                    echo "<span style='color: red'>Polje za unos ne sme biti prazno!</span>";
                    exit();
                }

                require("mysql_functions.php");
                
                $handle = dbConnect();

                if ($handle == false)
                {
                    exit();
                }

                $result_administrator = mysqli_query($handle, "select * from administrator where email='".$email."' and lozinka='".$password."'");
                $result_zaposleni = mysqli_query($handle, "select * from zaposleni where email='".$email."' and lozinka='".$password."'");
                $result_student = mysqli_query($handle, "select * from student where email='".$email."' and lozinka='".$password."'");

                dbDisconnect($handle, $result_administrator); // brise se rezultat za administratora, treba obrisati i rezultat za zaposlenog i studenta
                // TODO : dbDisconnect da prima niz rezultata umesto samo jedan, vrlo cesto ce se raditi sa vise upita pre DC-ovanja.
                if ($result_zaposleni != false) mysqli_free_result($result_zaposleni);
                if ($result_student != false) mysqli_free_result($result_student);

                if ($result_administrator != false && mysqli_num_rows($result_administrator) > 0)
                {
                    $row = mysqli_fetch_assoc($result_administrator);
                    $first_access = $row['prvipristup'];
                    $status = $row['status'];

                    if ($status == 1)
                    {
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['tip'] = "administrator";

                        if ($first_access == 1)
                        {
                            header("Location:/administrator.php");
                        }
                        else
                        {
                            header("Location:/change_password.php");
                        }
                    }
                    else
                    {
                        echo "<span style='color: red'>Kreirani nalog je neaktivan. Molimo kontaktirajte administratora sistema.</span>";
                    }
                }
                else if ($result_zaposleni != false && mysqli_num_rows($result_zaposleni) > 0)
                {
                    $row = mysqli_fetch_assoc($result_administrator);
                    $first_access = $row['prvipristup'];

                    if ($status == 1)
                    {
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['tip'] = "zaposleni";

                        if ($first_access == 1)
                        {
                            header("Location:/administrator.php");
                        }
                        else
                        {
                            header("Location:/change_password.php");
                        }
                    }
                    else
                    {
                        echo "<span style='color: red'>Kreirani nalog je neaktivan. Molimo kontaktirajte administratora sistema.</span>";
                    }
                }
                else if ($result_student != false && mysqli_num_rows($result_student) > 0)
                {
                    $row = mysqli_fetch_assoc($result_administrator);
                    $first_access = $row['prvipristup'];

                    if ($status == 1)
                    {
                        session_start();
                        $_SESSION['email'] = $email;
                        $_SESSION['tip'] = "student";

                        if ($first_access == 1)
                        {
                            header("Location:/administrator.php");
                        }
                        else
                        {
                            header("Location:/change_password.php");
                        }
                    }
                    else
                    {
                        echo "<span style='color: red'>Kreirani nalog je neaktivan. Molimo kontaktirajte administratora sistema.</span>";
                    }
                }
                else
                {
                    echo "<span style='color: red'>Pogresan email ili lozinka.</span>";
                }

            }
            else if (isset($_POST['guestlogin']))
            {
                session_start();
                $_SESSION['email'] = "GUEST";

                header("Location:/gost.php");
            }
        ?>

    </body>
</html>