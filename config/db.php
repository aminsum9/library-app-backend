<?php

class Database
{

    function db()
    {
        $db_connect = mysqli_connect("localhost", "root", "", "perpustakaan_botika");

        if ($db_connect->connect_errno) {
            echo "Failed to connect to MySQL: " . $db_connect->connect_error;
            exit();
        };

        return $db_connect;
    }
}
