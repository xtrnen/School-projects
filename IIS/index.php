<?php
include_once "php/login.php"
?>

<!DOCTYPE html>
<html>
<head>
    <title>THIEVES GUILD</title>
    <!--meta-->
    <!--<link rel="stylesheet" href="" />-->
    <!--<script src=""/> <script type="text/javascript" src=""/>-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
    .row {
        padding-top: 50px;
    }
    .container {
        background-color: #d0dbed;
    }
    h1 {
        text-align: center;
    }
    .subBut {
        margin-left: 30%;
    }
	form {
		margin-left: 20%;
	}
    </style>
</head>
<body>
<div class="row">
    <div class="col"></div>
    <div class="col container">
    <h1>Login</h1>
    <form method="post">
        <div>
            <label>Nickname</label>
            <input type="text" name="nickname" placeholder="nickname" value="<?php if(isset($_POST['nickname'])) echo $_POST['nickname']; ?>" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" placeholder="password" required>
        </div>
        <div class="subBut">
            <input type="submit" name="login" value="Log in">
        </div>
    </form>
    </div>
    <div class="col"></div>
</div>
</body>
</html>
