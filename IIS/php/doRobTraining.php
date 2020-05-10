<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: $_POST['ID_loupez_typ']
 * vraci: nic
 */


include_once "db_connect.php";
include_once "session_control.php";

if(!isset($_SESSION)){
    session_start();
}

$tmp = getdate();
$date = $tmp['year']."-".$tmp['mon']."-".$tmp['mday'];
//getting region
$query =
    "INSERT INTO skoleni (datum, ID_rodne_cislo, ID_loupez_typ) VALUES('$date','".$_SESSION['rodnecislo']."','".$_POST['ID_loupez_typ']."')";
$conn->query($query);



?>