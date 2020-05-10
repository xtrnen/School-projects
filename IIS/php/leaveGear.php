<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: $_POST['ID_vyrobni_cislo']
 * vraci: NIC
 */


include_once "db_connect.php";
//include_once "session_control.php";

if(!isset($_SESSION)){
    session_start();
}

$tmp = getdate();
$date = $tmp['year']."-".$tmp['mon']."-".$tmp['mday'];

$query =
    "UPDATE vlastnictvi SET do = '$date' WHERE ID_rodne_cislo = '".$_SESSION['rodnecislo']."' AND ID_vyrobni_cislo = '".$_POST['ID_vyrobni_cislo']."' AND do IS NULL";
$conn->query($query);


?>