<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: ID_vybaveni_typ, nepovinne ucinek, rozsah, potrebna_uroven
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

if (mysqli_num_rows($result) != 1){
    echo "ID_vybaveni_typ";
    return;
}

if(array_key_exists('ucinek', $_POST)){
    $query =
        "UPDATE past
            SET ucinek = '".$_POST['ucinek']."' 
            WHERE ID_vybaveni_typ = '".$_POST['ID_vybaveni_typ']."'";

    $conn->query($query);
}

if(array_key_exists('rozsah', $_POST)){
    if(!preg_match("/^[0-9]+$/",$_POST['rozsah'])){
        echo "Wrong range";
        return;
    }else{
        $query =
            "UPDATE past
            SET rozsah = '".$_POST['rozsah']."' 
            WHERE ID_vybaveni_typ = '".$_POST['ID_vybaveni_typ']."'";

        $conn->query($query);
    }
}

if(array_key_exists('potrebna_uroven', $_POST)){
    if(!preg_match("/^[0-9]+$/",$_POST['potrebna_uroven'])){
        echo "potrebna_uroven";
        return;
    }else{
        $query =
            "UPDATE typ_vybaveni
            SET potrebna_uroven = '".$_POST['potrebna_uroven']."' 
            WHERE ID_vybaveni_typ = '".$_POST['ID_vybaveni_typ']."'";

        $conn->query($query);
    }
}

echo "ok";

?>