<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: NIC
 * vraci: json obsahujici zlodeje (ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena)
 */
include_once "db_connect.php";
include_once "session_control.php";
if(!isset($_SESSION)){
    session_start();
}

$query =
    "SELECT * FROM zlodej 
    WHERE prezdivka = '".$_SESSION['prezdivka']."'";
$result = $conn->query($query);


//getting user info
$res = mysqli_fetch_array($result,MYSQL_ASSOC);
echo json_encode($res);
?>