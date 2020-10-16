<?php


try {
    $dns = "mysql:host=localhost; dbname=auth;charset=utf8";
    $conn = new PDO($dns, 'root' , '');
    
} catch (PDOException $e) {
   die('Connection error : ' . $e -> getMessage());
}


?>