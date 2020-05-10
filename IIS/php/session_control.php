<?php
# @Author: Miroslav Karpíšek, Michal Kolář
# @Date:   26-11-2017
# @Email:  karpisek.m@email.cz, kholli29.mk@gmail.com
# @Project: IIS

include_once 'db_connect.php';

if(!isset($_SESSION)){
    session_start();
}

if(!array_key_exists('prezdivka',$_SESSION)){
    header("location: http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/index.php");
}

$user_check = $_SESSION['prezdivka'];

$query =
    "   SELECT *
        FROM zlodej
        WHERE prezdivka =  '".$_SESSION['prezdivka']."' ";

$result = $conn->query($query);

if (!(mysqli_num_rows($result) == 1)) {
    header("location: http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/index.php");
}

$old_time = $_SESSION['timestamp'];
$actual_time =  time();

if($actual_time - $old_time > 300){
    session_destroy();
    header("location: http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/index.php");
}
$_SESSION['timestamp'] = $actual_time;


?>
