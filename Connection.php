<?php
$servername = "localhost";
$username = "root";
// $db_name = "DB_Octa";
// $password = "";
$db_name = "db_octa";
$password = "#OctaAdmin23";
$con = new mysqli($servername, $username, $password, $db_name);

if ($con->connect_error) {
    die("Connection Failed: " . $con->connect_error);
}

?>
