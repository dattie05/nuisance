<?php 

    $dbhost = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "nuisances_system";

    $conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    if ( $conn->connect_error ) {
        die( "Database Connection Error: " . $conn->connect_error );
    }

?>