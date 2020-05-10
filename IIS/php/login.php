<?php
include_once "db_connect.php";

if(!isset($_SESSION)){
    session_start();
}

//control if we are already logged in
if(array_key_exists('prezdivka',$_SESSION)){
    $user_check = $_SESSION['prezdivka'];

    $query =
        "   SELECT *
        FROM zlodej
        WHERE prezdivka =  '".$_SESSION['prezdivka']."' ";

    $result = $conn->query($query);

    if (mysqli_num_rows($result) == 1) {
       header("location: menu.php");
    }
}

//controlling login
if (!empty($_POST['nickname'])
    && !empty($_POST['password'])) {

    $query =
        "SELECT * FROM zlodej WHERE prezdivka = '".$_POST['nickname']."' AND heslo = '".$_POST['password']."'";
    $result = $conn->query($query);

    //only one result is acceptable
    if (mysqli_num_rows($result) == 1) {

        //getting user info
        $res = mysqli_fetch_array($result,MYSQL_ASSOC);

        //todo sesion
        $_SESSION['prezdivka'] = $res['prezdivka'];
        $_SESSION['rodnecislo'] = $res['ID_rodne_cislo'];
        $_SESSION['vudce'] = $res['vudce'];
        $_SESSION['timestamp'] = time();

        if ($res['vudce'] == 1){
            header("location: http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menuAdmin.php");
        }else{
            header("location: http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php");
        }
        //header("Access-Control-Allow-Origin: *");
    } else {
        echo "<script type=\"text/javascript\">alert(\"Wrong password or username!\");</script>";
    }
}
?>