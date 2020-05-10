<?php
include_once "php/session_control.php";
if(!isset($_SESSION)){
    session_start();
}

if($_SESSION['vudce'] != 1){
    session_destroy();
    header("location: http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/index.php");
}
?>
<!DOCTYPE html>
<html lag="cs">
<head>
   <title>THIEVES GUILD</title>
   <!--meta-->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

   <script type="text/javascript" src="http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/js/history.js"></script>
   <script type="text/javascript" src="http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/js/robbery.js"></script>
   <script type="text/javascript" src="http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/js/training.js"></script>
   <script type="text/javascript" src="http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/js/equipment.js"></script>
   <script type="text/javascript" src="http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/js/territories.js"></script>
   <script type="text/javascript" src="http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/js/profile.js"></script>
   <style>
       body {
           margin: 0;
           background-color: #F1F3FA;
           height:100%;
           overflow:auto
           transform: translateZ(0);
            -webkit-transform: translateZ(0);
       }
       .profile {
           margin: 20px 0;
       }
       .profile {
           padding: 20px 0 10px 0;
           background: #fff;
       }
       .profile-pic img{
            float: none;
            margin: 0 auto;
            width: 50%;
            height: 50%;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
       }
       .profile-user-title {
           text-align: center;
           margin-top: 20px;
       }
       .profile-user-nickname {
           color: #5a7391;
           font-size: 20px;
           font-weight: 600;
           margin-bottom: 7px;
       }
       .profile-user-name {
           text-transform: uppercase;
           color: #5b9bd1;
           font-size: 16px;
           font-weight: 600;
           margin-bottom: 15px;
       }
       .profile-user-age-status {
            text-transform: uppercase;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 23px;
       }
       .profile.user-bounty {
           font-size: 16px;
           font-weight: 500;
       }
       .profile.nav {
           margin-top: 30px;
       }
       .profile-nav ul li {
           border-bottom: 1px solid #f0f4f7;
       }
       .profile.nav ul li:last-child {
           border-bottom: none;
       }
       .profile-nav ul li a {
           color: #93a3b5;
           font-size: 14px;
           font-weight: 400;
       }
       .profile-nav ul li a i {
           margin-right: 8px;
           font-size: 14px;
       }
       .profile-nav ul li a:hover {
           background-color: #fafcfd;
           color: #5b9bd1;
       }
       .profile-nav ul li.active a {
           border-bottom: none;
       }
       .profile-nav ul li.active a {
           color: #5b9bd1;
           background-color: #f6f9fb;
           border-left: 2px solid #5b9bd1;
           margin-left: -2px;
       }
       .prof-content {
            padding: 20px;
            background: #fff;
            min-height: 460px;
       }
   </style>
</head>
<body>
    <div class="container">
            <div class="col-md-3 profile">
                <!--PICTURE-->
                <div class="profile-pic">
                    <img src="src/thief.jpg" class="img-responsive" alt="">
                </div>
                <!--User Title-->
                <div class="profile-user-title">
                    <div class="profile-user-nickname"></div>
                    <div class="profile-user-name"></div>
                    <div class="profile-user-age-status"></div>
                    <div class="profile-user-bounty"></div>
                </div>
				<div class="profile-nav">
                    <ul class="nav">
                        <li class="home-a active">
                            <a href="#home">
                                <i class="glyphicon glyphicon-home"></i>
                                Home
                            </a>
                        </li>
                        <li class="territory-a">
                            <a href="#territories">
                                <i class="glyphicon glyphicon-flag"></i>
                                Territories
                            </a>
                        </li>
                        <li class="equip-a">
                            <a href="#equipment">
                                <i class="glyphicon glyphicon-wrench"></i>
                                Equipment
                            </a>
                        </li>
                        <li class="training-a">
                            <a href="#training">
                                <i class="glyphicon glyphicon-book"></i>
                                Training
                            </a>
                        </li>
                        <li class="burglary-a">
                            <a href="#burglary">
                                <i class="glyphicon glyphicon-usd"></i>
                                Robbery
                            </a>
                        </li>
                        <li class="history-a">
                            <a href="#history">
                                <i class="glyphicon glyphicon-calendar"></i>
                                History
                            </a>
                        </li>
                        <li class="admin-a">
                            <a href="#admin">
                                <i class="glyphicon glyphicon-cog"></i>
                                Edit
                            </a>
                        </li>
			            <li>
                            <a href="#logout">
                                <i class="glyphicon glyphicon-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 row restOf" style="padding: 20px;"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
 $(document).ready(function(){
    $('a[href="#admin"]').click(function(){
       location.replace("admin/editMenu.php");
    }); 
 });

</script>
</body>
</html>