<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: NIC
 * vraci: json obsahujici pole vlastnene vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena)
 */



include_once "db_connect.php";
include_once "session_control.php";
if(!isset($_SESSION)){
    session_start();
}

$query =
    "SELECT ID_vyrobni_cislo, ID_vybaveni_typ, cena, od
        FROM vybaveni NATURAL LEFT JOIN vlastnictvi 
        WHERE ID_rodne_cislo = '".$_SESSION['rodnecislo']."' AND do IS NULL";
$result = $conn->query($query);
$gear = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $gear[] = $row;
    }
}
echo json_encode($gear);

?>