<?php
/**
 * Created by PhpStorm.
 * User: trubk
 * Date: 18.11.2018
 * Time: 15:00
 */

$server_name = "localhost";
$username = "xtrubk00";
$password = "jica8ofe";
$dbname = "xtrubk00";

// Create connection
$conn = new mysqli($server_name, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
}
//echo "Connected successfully";
?>