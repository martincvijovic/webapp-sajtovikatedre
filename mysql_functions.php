<?php
    function dbConnect()
    {
        require("config.php");
        $handle = mysqli_connect($dbPath, $dbUsername, $dbPassword, $dbName);

        if (mysqli_connect_errno())
        {
            echo "Neuspesna konekcija sa bazom podataka: ".mysqli_connect_errno();
        }

        return $handle;
    }

    function dbDisconnect($handle, $query_result)
    /**
     * TODO : Funkcija treba da POTENCIJALNO prima niz query_result-ova a ne samo jedan, takodje treba da radi i ako ne postoji drugi argument
     */
    {
        if ($query_result != true && $query_result != false)
        {
            mysqli_free_result($query_result);
        }

        mysqli_close($handle);
    }
    
?>