<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: ID_loupez_typ, detaily, mira_obtiznosti
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


if(!preg_match("/^.+$/",$_POST['ID_loupez_typ'])){
    echo "ID_loupez_typ";
    return;
}

if(!preg_match("/^.+$/",$_POST['mira_obtiznosti'])){
    echo "mira_obtiznosti";
    return;
}

$query = "SELECT ID_loupez_typ
FROM loupez_typ
WHERE ID_loupez_typ = '".$_POST['ID_loupez_typ']."'";

$result =$conn->query($query);

if (mysqli_num_rows($result) != 0){
    echo "ID_loupez_typ";
    return;
}

$query =
    "INSERT INTO loupez_typ (ID_loupez_typ, detaily, mira_obtiznosti) VALUES('".$_POST['ID_loupez_typ']."', '".$_POST['detaily']."', '".$_POST['mira_obtiznosti']."')";

$conn->query($query);

echo "ok";

?>