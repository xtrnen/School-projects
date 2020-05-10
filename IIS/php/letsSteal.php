<?php
/**
 * Created by PhpStorm.
 * User: trubk00
 * Date: 24.11.2018
 * Time: 10:07
 * potrebuje: {ID_poukazka, ID_oblast, korist, ID_loupez_typ, zlodejove: [index, id_rodne_cislo]}
 * vraci: NULL nebo json
 */
include_once "db_connect.php";
include_once "session_control.php";
if(!isset($_SESSION)){
    session_start();
}

//control if voucher exists and is free
$query =
    "
SELECT ID_poukazka
FROM poukazka NATURAL LEFT JOIN pouzije
WHERE ID_poukazka = '".$_POST['ID_poukazka']."' AND ID_rodne_cislo IS NULL";

$result = $conn->query($query);

if(mysqli_num_rows($result) == 0){
    echo "Voucher is already used.";
}else{
    if(checkRobbers($conn) == 1){
        echo "Someone don't have training or is not in region.";
    }else{
        if(checkRegion($conn) == 1){
            echo "Not enough money in the region";
        }else{
            doTheRobbery($conn);
            echo "ok";
        }
    }
}

//check if all robbers are eligible to join robbery
function checkRobbers($conn) {
    $query =
        "SELECT O.ID_rodne_cislo, O.ID_oblast
        FROM operuje O NATURAL LEFT JOIN zlodej
        WHERE O.ID_oblast = '".$_POST['ID_oblast']."' AND O.ID_rodne_cislo = '".$_SESSION['rodnecislo']."' AND EXISTS(
	            SELECT S.ID_rodne_cislo, S.ID_loupez_typ
	            FROM skoleni S NATURAL LEFT JOIN zlodej
	            WHERE S.ID_rodne_cislo = '".$_SESSION['rodnecislo']."' AND S.ID_loupez_typ = '".$_POST['ID_loupez_typ']."'
    )";
    $result = $conn->query($query);
    if(mysqli_num_rows($result) == 0){
        return 1;
    }

    if(!array_key_exists('zlodejove', $_POST)){
        return 0;
    }

    $robb=$_POST['zlodejove'];
    foreach ( $robb as $key => $value){
        $query =
            "SELECT O.ID_rodne_cislo, O.ID_oblast
            FROM operuje O NATURAL LEFT JOIN zlodej
            WHERE O.ID_oblast = '".$_POST['ID_oblast']."' AND O.ID_rodne_cislo = '".$value."' AND EXISTS(
	                    SELECT S.ID_rodne_cislo, S.ID_loupez_typ
	                    FROM skoleni S NATURAL LEFT JOIN zlodej
	                    WHERE S.ID_rodne_cislo = '".$value."' AND S.ID_loupez_typ = '".$_POST['ID_loupez_typ']."'
        )";
        $result = $conn->query($query);
        if(mysqli_num_rows($result) == 0){
            return 1;
        }
    }
    return 0;
}

function doTheRobbery($conn) {
    //add the robbery
    $query = "INSERT INTO loupez (korist, ID_oblast, ID_poukazka, ID_loupez_typ) VALUES('".$_POST['korist']."','".$_POST['ID_oblast']."','".$_POST['ID_poukazka']."', '".$_POST['ID_loupez_typ']."')";
    $conn->query($query);

    //add all robbers to the robbery
    $query = "INSERT INTO pouzije (ID_rodne_cislo, ID_poukazka ) VALUES('".$_SESSION['rodnecislo']."','".$_POST['ID_poukazka']."')";
    $conn->query($query);

    if(array_key_exists('zlodejove', $_POST)){
        $robb=$_POST['zlodejove'];
        foreach ( $robb as $key => $value){
            $query = "INSERT INTO pouzije (ID_rodne_cislo, ID_poukazka ) VALUES('".$value."','".$_POST['ID_poukazka']."')";
            $conn->query($query);
        }
    }


    //set new value in region
    $query = "SELECT dostupne_bohatstvi
    FROM rajon
    WHERE ID_oblast = '".$_POST['ID_oblast']."'";
    $result = $conn->query($query);
    $row = mysqli_fetch_array($result,MYSQL_ASSOC);
    $new_wealth = $row['dostupne_bohatstvi'] - $_POST['korist'];
    $query = "UPDATE rajon SET dostupne_bohatstvi = '$new_wealth' WHERE ID_oblast = '".$_POST['ID_oblast']."'";
    $conn->query($query);

    //increase wanted reward
    $query = "SELECT vypsana_odmena
    FROM zlodej
    WHERE ID_rodne_cislo = '".$_SESSION['rodnecislo']."'";
    $result = $conn->query($query);
    $row = mysqli_fetch_array($result,MYSQL_ASSOC);
    $new_reward = $row['vypsana_odmena'] + round($_POST['korist']/10);
    $query = "UPDATE zlodej SET vypsana_odmena = '$new_reward' WHERE ID_rodne_cislo = '".$_SESSION['rodnecislo']."'";
    $conn->query($query);

}

//check if there is enough money in region
function checkRegion($conn){
    $query = "SELECT ID_oblast
    FROM rajon
    WHERE ID_oblast = '".$_POST['ID_oblast']."' AND dostupne_bohatstvi >= '".$_POST['korist']."'";
    $result = $conn->query($query);
    if(mysqli_num_rows($result) == 0){
        return 1;
    }
    return 0;
}


?>