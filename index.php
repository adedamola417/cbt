<?php
require_once('session/index.php');
$cbt_login="";
$cbt_login .= "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>CBT Login</title>
</head>
<body><div class='container'>
    <img src='logo.png' alt='Logo' class='logo'>
";
$cbt_login .= "<h1>CBT Login</h1>";
if(isset($_SESSION['success'])){
$cbt_login .= $_SESSION['success'];
	unset($_SESSION['success']);
}
$cbt_login .= "<form method='post' action='login.php'>";
$cbt_login .= "<input type='text' name='matricnumber' placeholde='enter Matric number' /><input type='password' name='password' placeholder='enter password' /><input type='hidden' name='type' value='login'/><input type='submit' value='Login' /><br><a href='signup.php'>Sign Up</a>   ";
$cbt_login .= "</form>";
$cbt_login .= "</div></body>";
print($cbt_login);
if(isset($_SESSION['error'])) {
    echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}

?>

<style>

    /* You can add your style - this is for Samuel Ademoroti Github */
    *{
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }
    .container {
        width: 300px;
        margin: 0 auto;
        text-align: center;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }
    .logo {
        width: 100px;
        height: auto;
        margin-bottom: 20px;
    }
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

</style>

