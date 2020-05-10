<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: ID_oblast nepovinne nove kapacita, dostupne_bohatstvi
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

$query = "SELECT ID_oblast
FROM rajon
WHERE ID_oblast = '".$_POST['ID_oblast']."'";

$result =$conn->query($query);

if (mysqli_num_rows($result) == 0){
    echo "ID_oblast";
    return;
}

if(array_key_exists('dostupne_bohatstvi', $_POST)){
    if(!preg_match("/^[0-9]+$/",$_POST['dostupne_bohatstvi'])){
        echo "dostupne_bohatstvi";
        return;
    }else{
        $query =
            "UPDATE rajon
            SET dostupne_bohatstvi = '".$_POST['dostupne_bohatstvi']."' 
            WHERE ID_oblast = '".$_POST['ID_oblast']."'";

        $conn->query($query);
    }
}

if(array_key_exists('kapacita', $_POST)){
    if(!preg_match("/^[0-9]+$/",$_POST['kapacita'])){
        echo "kapacita";
        return;
    }else{
        $query =
            "UPDATE rajon
            SET kapacita = '".$_POST['kapacita']."' 
            WHERE ID_oblast = '".$_POST['ID_oblast']."'";

        $conn->query($query);
    }
}






echo "ok";

?>