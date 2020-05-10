<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: NIC
 * vraci: json seznam rajonu ve kterych zlodej neperuje(ID_oblast, pocet_lidi, kapacita, dostupne_bohatstvi )
 */


include_once "db_connect.php";
include_once "session_control.php";

if(!isset($_SESSION)){
    session_start();
}

$query =
    "SELECT V.ID_oblast, V.pocet_lidi, V.kapacita, V.dostupne_bohatstvi
    FROM rajon V
    WHERE NOT EXISTS(
	    SELECT C.ID_oblast
	    FROM operuje C
	    WHERE V.ID_oblast = C.ID_oblast AND C.ID_rodne_cislo = '".$_SESSION['rodnecislo']."'
);";
$result = $conn->query($query);
$res = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $res[] = $row;
    }
}
echo json_encode($res);

?>