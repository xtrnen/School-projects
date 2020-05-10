<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: $_POST['ID_rajon']
 * vraci: json obsahujici aktualizovany rajon(ID_oblast, pocet_lidi, kapacita, dostupne_bohatstvi ) nebo NULL
 */



include_once "db_connect.php";
include_once "session_control.php";

if(!isset($_SESSION)){
    session_start();
}
//getting region
$query =
    "SELECT * FROM rajon
    WHERE ID_oblast = '".$_POST['ID_oblast']."' AND pocet_lidi < kapacita";
$result = $conn->query($query);
if (mysqli_num_rows($result) == 1) {
    $query =
        "INSERT INTO operuje (ID_rodne_cislo,ID_oblast ) VALUES('".$_SESSION['rodnecislo']."','".$_POST['ID_oblast']."')";
    $conn->query($query);

    $res = mysqli_fetch_array($result,MYSQL_ASSOC);

    //updating region
    $res['pocet_lidi'] += 1;
    $query = "UPDATE rajon SET pocet_lidi = '".$res['pocet_lidi']."' WHERE ID_oblast = '".$_POST['ID_oblast']."'";
    $conn->query($query);
    echo json_encode($res);
}else{
    echo NULL;
}


?>