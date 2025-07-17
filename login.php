<?php
require_once('session/index.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch($_POST['type']){
        case 'login':
            Login();
            break;
        case 'signup':
            Signup();
            break;
        default:
            echo 'Invalid request type';
            break;
    }


   

}
else {
    if(isset($_SESSION['user'])){
        header('Location: question.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
}
 function Login(){
        global $port;
        $query = $port->prepare("SELECT *, COUNT(*) AS numrow FROM users WHERE matric_number=:matricnumber AND auth_key=:authkey");
        $query->execute(['matricnumber' => $_POST['matricnumber'], 'authkey' => $_POST['password']]);
        $user = $query->fetch();
        if($user['numrow'] > 0){
            $_SESSION['user'] = $user;
            header('Location: question.php');
        } else {
            $_SESSION['error'] = 'Invalid login credentials';
            header('location: index.php');
        }
    }
function Signup(){
    global $port;
    $checkQuery = $port->prepare("SELECT COUNT(*) AS numrow FROM users WHERE matric_number=:matricnumber");
    $checkQuery->execute(['matricnumber' => $_POST['matricnumber']]);
    $check = $checkQuery->fetch();
    if($check['numrow'] > 0){
        $_SESSION['error'] = "You have already Signed Up";
        header('Location: Signup.php');
        exit();
    } else {
    $query = $port->prepare("INSERT INTO users (matric_number, first_name, last_name, department, auth_key) VALUES(:matric_number, :first_name, :last_name, :department, :auth_key)");
    $query->execute(['matric_number'=>$_POST['matricnumber'], 'first_name'=>$_POST['firstname'], 'last_name'=>$_POST['lastname'], 'department'=>$_POST['department'], 'auth_key'=>$_POST['password']]);
    $_SESSION['success'] = "You have successfully Registered";
    header('Location: login.php');
}

    
    }
?>