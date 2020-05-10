<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: NIC
 * vraci: json obsahujici seznam nepodstoupenych treninku na typ loupeze(ID_loupez_typ, detaily, mira_obtiznosti)
 */



include_once "db_connect.php";
include_once "session_control.php";

if(!isset($_SESSION)){
    session_start();
}

$query =
    "SELECT L.ID_loupez_typ, L.detaily, L.mira_obtiznosti
    FROM loupez_typ L
    WHERE NOT EXISTS
    (
        SELECT S.ID_loupez_typ
        FROM skoleni S
        WHERE L.ID_loupez_typ = S.ID_loupez_typ AND S.ID_rodne_cislo = '".$_SESSION['rodnecislo']."'
    )";

$result = $conn->query($query);
$res = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $res[] = $row;
    }
}
echo json_encode($res);

?>