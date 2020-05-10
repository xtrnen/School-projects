<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: $_POST['ID_vyrobni_cislo']
 * vraci: json noveho vlastnictvi (ID_vyrobni_cislo, od) nebo NULL pokud je zabrane
 */


include_once "db_connect.php";
include_once "session_control.php";

if(!isset($_SESSION)){
    session_start();
}


$tmp = getdate();
$date = $tmp['year']."-".$tmp['mon']."-".$tmp['mday'];


//check if gear is still free
$query =
    "SELECT * FROM vlastnictvi
    WHERE ID_vyrobni_cislo = '".$_POST['ID_vyrobni_cislo']."' AND do IS NULL";
$result_free = $conn->query($query);

$query =
    "SELECT * FROM vybaveni
    WHERE ID_vyrobni_cislo = '".$_POST['ID_vyrobni_cislo']."'";
$result_id = $conn->query($query);

if(mysqli_num_rows($result_id) != 0){
    $get_id = mysqli_fetch_array($result_id,MYSQL_ASSOC);
    $ID_vybaveni_typ = $get_id['ID_vybaveni_typ'];
}

//check if robber have training
$query =
    "SELECT * FROM skoleni
    WHERE ID_vybaveni_typ = '$ID_vybaveni_typ' AND ID_rodne_cislo = '".$_SESSION['rodnecislo']."'";
$result_train = $conn->query($query);

if (mysqli_num_rows($result_free) == 0 && mysqli_num_rows($result_train) > 0) {
    //insert
    $query =
        "INSERT INTO vlastnictvi (ID_rodne_cislo,ID_vyrobni_cislo, od) VALUES('".$_SESSION['rodnecislo']."','".$_POST['ID_vyrobni_cislo']."', '$date')";
    $conn->query($query);

    //get new ownership
    $query =
        "SELECT * FROM vlastnictvi
    WHERE ID_vyrobni_cislo = '".$_POST['ID_vyrobni_cislo']."' AND do IS NULL";
    $ownership = $conn->query($query);

    $res = mysqli_fetch_array($ownership,MYSQL_ASSOC);

    echo json_encode($res);
}else{
    echo NULL;
}

?>