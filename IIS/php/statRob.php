<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: NIC
 * vraci: json obsahujici setrideni seznam zlodeju s poctem loupezi
 */



include_once "db_connect.php";
include_once "session_control.php";
if(!isset($_SESSION)){
    session_start();
}

$tmp = getdate();
$date = $tmp['year']."-".$tmp['mon']."-".$tmp['mday'];

$query =
    "SELECT prezdivka, COUNT(ID_rodne_cislo) as pocet_loupezi
    FROM pouzije NATURAL LEFT JOIN zlodej
    GROUP BY prezdivka
    ORDER BY pocet_loupezi DESC";
$result = $conn->query($query);

$res = array();

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
        $res[] = $row;
    }
}


echo json_encode($res);

?>