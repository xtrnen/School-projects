<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: ID_loupez_typ
 * vraci: ok nebo chybovou hlasku
 */

include_once "../php/db_connect.php";
include_once "../php/session_control.php";
if(!isset($_SESSION)){
    session_start();
}

if($_SESSION['vudce']!= 1){
    session_destroy();
    header("location: http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/index.php");
}


$query = "SELECT ID_loupez_typ
FROM loupez_typ
WHERE ID_loupez_typ = '".$_POST['ID_loupez_typ']."'";

$result =$conn->query($query);

if (mysqli_num_rows($result) != 1){
    echo "ID_loupez_typ";
    return;
}

$tmp = getdate();
$date = $tmp['year']."-".$tmp['mon']."-".$tmp['mday'];

$query =
    "INSERT INTO poukazka (datum, ID_loupez_typ) VALUES('".$date."','".$_POST['ID_loupez_typ']."')";
$conn->query($query);

echo "ok";

?>