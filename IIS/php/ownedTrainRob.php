<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: NIC
 * vraci: json obsahujici pole podstoupenych treninku na loupez (ID_loupez_typ, detaily, mira_obtiznosti)
 */

include_once "db_connect.php";
include_once "session_control.php";

if(!isset($_SESSION)){
    session_start();
}

$query =
    "SELECT ID_loupez_typ, detaily, mira_obtiznosti, datum
FROM skoleni NATURAL LEFT JOIN loupez_typ
WHERE ID_rodne_cislo = '".$_SESSION['rodnecislo']."' AND ID_loupez_typ IS NOT NULL";

$result = $conn->query($query);
$res = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $res[] = $row;
    }
}
echo json_encode($res);

?>