<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: ID_vyrobni_cislo, ID_vybaveni_typ, cena
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

$query = "SELECT ID_vybaveni_typ
FROM typ_vybaveni
WHERE ID_vybaveni_typ = '".$_POST['ID_vybaveni_typ']."'";

$result = $conn->query($query);

if (mysqli_num_rows($result) == 0){
    echo "ID_vybaveni_typ";
    return;
}

$query = "SELECT ID_vyrobni_cislo
FROM vybaveni
WHERE ID_vyrobni_cislo = '".$_POST['ID_vyrobni_cislo']."'";

$result =$conn->query($query);

if (mysqli_num_rows($result) != 0){
    echo "ID_vyrobni_cislo";
    return;
}

if(!preg_match("/^.+$/",$_POST['ID_vyrobni_cislo'])){
    echo "ID_vyrobni_cislo";
    return;
}

if(!preg_match("/^[0-9]+$/",$_POST['cena'])){
    echo "cena";
    return;
}

$query =
    "INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('".$_POST['ID_vyrobni_cislo']."','".$_POST['ID_vybaveni_typ']."', '".$_POST['cena']."')";
$conn->query($query);

echo "ok";

?>