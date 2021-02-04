<html>
    <head>
        <title>Pocetna strana</title>
        <link rel="stylesheet" type="text/css" href="homepage_style.css">
    </head>
    <body>
        <h2>Dobrodosli</h2>
        
        <form method="POST">
            <p>Username: <input type="text" name="username" value=<?php echo (isset($_POST['login'])) ? $_POST['username'] : "" ?> ></p>
            <p>Password: <input type="password" name="password"></p>
            <input type="submit" name="login" value="Login">
        </form>

        <?php
            if (isset($_POST['login']))
            {
                $username = $_POST['username'];
                $password = $_POST['password'];

                if (strlen($username) == 0 || strlen($password) == 0)
                {
                    echo "<span style='color: red'>Polje za unos ne sme biti prazno!</span>";
                }

                require("mysql_functions.php");
                
                $handle = dbConnect();

                if ($handle == false)
                {
                    exit();
                }


                $result = mysqli_query($handle, "select * from administrator where email='".$username."' and lozinka='".$password."'");

                $result = mysqli_query($handle, "select * from zaposleni where email='".$username."' and lozinka='".$password."'");

                $result = mysqli_query($handle, "select * from student where email='".$username."' and lozinka='".$password."'");
            }
        ?>

    </body>
</html>