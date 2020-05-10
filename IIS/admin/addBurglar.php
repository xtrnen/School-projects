<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena
 * vraci: ok nebo chybovou hlasku
 */

include_once "../php/db_connect.php";
include_once "../php/session_control.php";
if(!isset($_SESSION)){
    session_start();
}

if($_SESSION['vudce']!= 1){
    session_destroy();
    header("location: http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/index.php");
}

if(!preg_match("/^[0-9]+$/",$_POST['ID_rodne_cislo'])){
    echo "ID_rodne_cislo";
    return;
}

if(!preg_match("/^.+$/",$_POST['prezdivka'])){
    echo "prezdivka";
    return;
}
if(!preg_match("/^.+$/",$_POST['heslo'])){
    echo "heslo";
    return;
}

if(!preg_match("/^[0-9]+$/",$_POST['vek'])){
    echo "vek";
    return;
}

if(!preg_match("/^[ZM]$/",$_POST['stav'])){
    echo "stav";
    return;
}
if(!preg_match("/^[01]$/",$_POST['vudce'])){
    echo "vudce";
    return;
}


if(!preg_match("/^[0-9]+$/",$_POST['vypsana_odmena'])){
    echo "vypsana_odmena";
    return;
}


$query = "SELECT ID_rodne_cislo
FROM zlodej
WHERE ID_rodne_cislo = '".$_POST['ID_rodne_cislo']."'";

$result =$conn->query($query);

if (mysqli_num_rows($result) != 0){
    echo "ID_rodne_cislo";
    return;
}


$query =
    "INSERT INTO zlodej (ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena)
VALUES('".$_POST['ID_rodne_cislo']."','".$_POST['heslo']."',".$_POST['vudce'].",'".$_POST['jmeno']."','".$_POST['prijmeni']."','".$_POST['prezdivka']."','".$_POST['vek']."','".$_POST['stav']."','".$_POST['vypsana_odmena']."')";
$conn->query($query);

echo "ok";

?>