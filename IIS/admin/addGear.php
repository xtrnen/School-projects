<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: ID_vybaveni_typ,  efekt, umisteni, potrebna_uroven
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

$result =$conn->query($query);

if (mysqli_num_rows($result) != 0){
    echo "ID_vybaveni_typ";
    return;
}

if(!preg_match("/^.+$/",$_POST['ID_vybaveni_typ'])){
    echo "ID_vybaveni_typ";
    return;
}

if(!preg_match("/^[0-9]+$/",$_POST['potrebna_uroven'])){
    echo "potrebna_uroven";
    return;
}




$query =
    "INSERT INTO typ_vybaveni (ID_vybaveni_typ, potrebna_uroven) VALUES('".$_POST['ID_vybaveni_typ']."','".$_POST['potrebna_uroven']."')";
$conn->query($query);

$query =
    "INSERT INTO vybava (ID_vybaveni_typ, efekt, umisteni) VALUES('".$_POST['ID_vybaveni_typ']."','".$_POST['efekt']."','".$_POST['umisteni']."')";
$conn->query($query);

echo "ok";

?>