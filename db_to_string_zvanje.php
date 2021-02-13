<?php
    function dbToStringZvanje($zvanje)
    {
        if (strcmp($zvanje, "redovniprofesor") == 0) return "Redovni profesor";
        if (strcmp($zvanje, "vanredniprofesor") == 0) return "Vanredni profesor";
        if (strcmp($zvanje, "docent") == 0) return "Docent";
        if (strcmp($zvanje, "asistent") == 0) return "Asistent";
        if (strcmp($zvanje, "saradnikunastavi") == 0) return "Saradnik u nastavi";
        if (strcmp($zvanje, "istrazivac") == 0) return "Istrazivac";
        if (strcmp($zvanje, "laboratorijskiinzenjer") == 0) return "Laboratorijski inzenjer";
        if (strcmp($zvanje, "laboratorijskitehnicar") == 0) return "Laboratorijski tehnicar";
    }
?>