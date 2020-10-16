<?php

session_start();
if(isset($_POST['submit'])){

    unset($_SESSION['user']);
    unset($_SESSION['validation_errors']);
    header('Location: login.php');

}

?>