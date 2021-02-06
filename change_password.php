<html>
    <head></head>
    <?php
        session_start();
        $email = $_SESSION['email'];
        $tip = $_SESION['tip'];

        require("mysql_functions.php");

        $handle = dbConnect();

        /**
         * Pod pretpostavkom da je baza ispravna
         * ovaj upit ce uvek vracati jedan i 
         * samo jedan rezultat.
         */
        $result = mysqli_query($handle, "select ime from ".$tip." where email='".$email."'"); 

        $row = mysqli_fetch_assoc($result);
        $first_name = $row['ime'];

        dbDisconnect($handle, $result);
        
    ?>
    <body>
        <h3>Hello, <?php echo $first_name ?>!</h3>
        <p>Promena lozinke</p>

        <form method="POST">
            <p>Unesite novu lozinku <input type="password" name="password1"></p>
            <p>Ponovite novu lozinku <input type="password" name="password2"></p>
            <input type="submit" name="changepassword" value="Promeni lozinku">
        </form>

        <?php
            if (isset($_POST['changepassword']))
            {
                // query zameni lozinku i flag prvipristup
            }
        ?>
    </body>
</html>