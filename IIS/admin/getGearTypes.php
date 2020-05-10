<?php
/**
 * Created by PhpStorm.
 * User: trubk
 * Date: 30.11.2018
 * Time: 8:24
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

$query =
    "
SELECT ID_vybaveni_typ, potrebna_uroven, COUNT(ID_vybaveni_typ) as NumOfRob
FROM typ_vybaveni NATURAL LEFT JOIN skoleni
WHERE ID_vybaveni_typ IS NOT NULL
GROUP BY ID_vybaveni_typ";
$result = $conn->query($query);

$res = array();

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {
        $res[] = $row;
    }
}

echo json_encode($res);


?>