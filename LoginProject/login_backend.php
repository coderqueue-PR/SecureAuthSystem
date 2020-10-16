<?php

session_start();

require_once "connection.php";

if(isset($_POST['submit'])){

//Form Validation
$_SESSION['validation_errors'] = [];

if(empty($_POST['email'])){
    $_SESSION['validation_errors'] ['email'] = 'Email is required';
}

if(empty($_POST['password'])){
    $_SESSION['validation_errors'] ['password'] = 'password is required';
}

if(count($_SESSION['validation_errors']) > 0){
    header('Location: login.php');
}

$_SESSION['formdata']['email'] = $_POST['email'];

$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

$stmt = $conn->prepare("select * from users where email = :email");
$stmt->execute([
    'email' => $email,
]);

$row = $stmt->fetch();

if($row){ 

    if(password_verify($password, $row['password'])){

        $_SESSION['user'] = [
            'id' => $row['id'],
            'email' => $row['email'],
            'profile_picture' => $row['profile_picture'],
           
        ];

        header('Location: index.php');

    }else{
        $_SESSION['validation_errors']['email'] = "wrong username or password";
        header('Location: login.php');
    }
}else{
    $_SESSION['validation_errors']['email'] = "wrong username or password";
    header('Location: login.php');
}




}





?>