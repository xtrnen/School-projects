<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: NIC
 * vraci: json obsahujici pole volneho vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena)
 */

include_once "session_control.php";
include_once "db_connect.php";

if(!isset($_SESSION)){
    session_start();
}

$query =
    "SELECT V.ID_vyrobni_cislo, V.ID_vybaveni_typ, V.cena
    FROM vybaveni V
    WHERE NOT EXISTS(
	    SELECT C.ID_vyrobni_cislo
	    FROM vlastnictvi C
	    WHERE V.ID_vyrobni_cislo = C.ID_vyrobni_cislo AND C.do IS NULL
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