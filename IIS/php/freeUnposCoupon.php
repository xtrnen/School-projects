<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 *
 * potrebuje: NIC
 * vraci: json obsahujici pole volnych kuponu (ID_poukazka, ID_loupez_typ, datum)
 */


include_once "session_control.php";

include_once "db_connect.php";

if(!isset($_SESSION)){
    session_start();
}

$query =
    "SELECT L.ID_loupez_typ
    FROM poukazka L NATURAL LEFT OUTER JOIN pouzije
    WHERE ID_rodne_cislo IS NULL AND NOT EXISTS (
        SELECT * 
        FROM skoleni S
        WHERE S.ID_rodne_cislo = '".$_SESSION['rodnecislo']."' AND S.ID_loupez_typ = L.ID_loupez_typ
) GROUP BY L.ID_loupez_typ";
$result = $conn->query($query);
$gear = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $gear[] = $row;
    }
}
echo json_encode($gear);

?>