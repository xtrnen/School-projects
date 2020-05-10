<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: $_POST['ID_rajon'] $_POST['ID_loupez_typ']
 * vraci: json obsahujici pole zlodeju v rajonu (ID_rodne_cislo, prezdivka )
 */

include_once "session_control.php";
include_once "db_connect.php";

if(!isset($_SESSION)){
    session_start();
}

$query =
    "SELECT Z.ID_rodne_cislo, Z.prezdivka 
    FROM operuje NATURAL LEFT JOIN zlodej Z
    WHERE ID_oblast = '".$_POST['ID_rajon']."' AND stav = 'Z' AND EXISTS(
	    SELECT *
	    FROM skoleni S
	    WHERE S.ID_rodne_cislo = Z.ID_rodne_cislo and S.ID_loupez_typ = '".$_POST['ID_loupez_typ']."' AND Z.ID_rodne_cislo != '".$_SESSION['rodnecislo']."'
)";
$result = $conn->query($query);
$gear = array();

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
        $gear[] = $row;
    }
}
echo json_encode($gear);

?>