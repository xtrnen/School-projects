<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: ID_loupez_typ, nepovinne nove detaily ci mira_obtiznosti
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


$query = "SELECT ID_loupez_typ
FROM loupez_typ
WHERE ID_loupez_typ = '".$_POST['ID_loupez_typ']."'";

$result =$conn->query($query);

if (mysqli_num_rows($result) != 1){
    echo "ID_loupez_typ";
    return;
}

if(array_key_exists('mira_obtiznosti', $_POST)){
    if(!preg_match("/^.+$/",$_POST['mira_obtiznosti'])){
        echo "mira_obtiznosti";
        return;
    }else{
        $query =
            "UPDATE loupez_typ
            SET mira_obtiznosti = '".$_POST['mira_obtiznosti']."' 
            WHERE ID_loupez_typ = '".$_POST['ID_loupez_typ']."'";

        $conn->query($query);
    }
}

if(array_key_exists('detaily', $_POST)){
    $query =
        "UPDATE loupez_typ
            SET detaily = '".$_POST['detaily']."' 
            WHERE ID_loupez_typ = '".$_POST['ID_loupez_typ']."'";
    $conn->query($query);
}



echo "ok";

?>