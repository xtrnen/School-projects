<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: NIC
 * vraci: json obsahujici pocet = pocet pokuazek
 */



include_once "db_connect.php";
include_once "session_control.php";
if(!isset($_SESSION)){
    session_start();
}

$tmp = getdate();
$date = $tmp['year']."-".$tmp['mon']."-".$tmp['mday'];

$query =
    "SELECT COUNT(*) as pocet
    FROM poukazka
    WHERE datum = '".$date."'";
$result = $conn->query($query);

$row = mysqli_fetch_array($result, MYSQL_ASSOC);

echo json_encode($row);

?>