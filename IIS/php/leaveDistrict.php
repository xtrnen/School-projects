<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: $_POST['ID_oblast']
 * vraci: json obsahujici aktualizovany rajon(ID_oblast, pocet_lidi, kapacita, dostupne_bohatstvi )
 */


include_once "db_connect.php";
include_once "session_control.php";

if(!isset($_SESSION)){
    session_start();
}



$query =
    "DELETE FROM operuje WHERE ID_rodne_cislo = '".$_SESSION['rodnecislo']."' AND ID_oblast = '".$_POST['ID_oblast']."'";
$conn->query($query);

$query =
    "SELECT * FROM rajon
    WHERE ID_oblast = '".$_POST['ID_oblast']."'";
$result = $conn->query($query);

$res = mysqli_fetch_array($result,MYSQL_ASSOC);

//updating region
$res['pocet_lidi'] -= 1;
$query = "UPDATE rajon SET pocet_lidi = '".$res['pocet_lidi']."' WHERE ID_oblast = '".$_POST['ID_oblast']."'";
$conn->query($query);
echo json_encode($res);

?>