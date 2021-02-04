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
    {
        if ($query_result != true && $query_result != false)
        {
            mysqli_free_result($query_result);
        }

        mysqli_close($handle);
    }
    
?>