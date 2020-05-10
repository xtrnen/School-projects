<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: $_POST['ID_rodne_cislo'] upravovaneho zlodeje a volitelne POST vek stav nebo vypsana odmena
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

$array = array();
$fail = false;

$query = "SELECT ID_rodne_cislo
FROM zlodej
WHERE ID_rodne_cislo = '".$_POST['ID_rodne_cislo']."'";

$result =$conn->query($query);

if (mysqli_num_rows($result) != 1){
    echo "ID_rodne_cislo";
    return;
}


if(array_key_exists('vek', $_POST)){
    if (preg_match("/^[0-9]+$/",$_POST['vek'])){

        $query =
            "UPDATE zlodej
        SET vek = '".$_POST['vek']."' 
        WHERE ID_rodne_cislo = '".$_POST['ID_rodne_cislo']."'";
        $conn->query($query);
    }else{
        echo "vek";
        return;
    }
}

if(array_key_exists('stav', $_POST)){
    if (preg_match("/^[ZM]$/",$_POST['stav'])){
        $query =
            "UPDATE zlodej
        SET stav = '".$_POST['stav']."' 
        WHERE ID_rodne_cislo = '".$_POST['ID_rodne_cislo']."'";
        $conn->query($query);
    }else{
        echo "stav";
        return;
    }
}

if(array_key_exists('vypsana_odmena', $_POST)){
    if (preg_match("/^[0-9]+$/",$_POST['vypsana_odmena'])){

        $query =
            "UPDATE zlodej
        SET vypsana_odmena = '".$_POST['vypsana_odmena']."' 
        WHERE ID_rodne_cislo = '".$_POST['ID_rodne_cislo']."'";
        $conn->query($query);
    }else{
        echo "vypsana_odmena";
        return;
    }
}


echo "ok";

?>