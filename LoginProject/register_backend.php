<?php
 
session_start(); 

require_once 'connection.php';
//planning for form validation

# All fields are required
# Email is valid email
# Password must be 6 chars long
# Both passwords should match
# Image is Selected

if(isset($_POST['submit'])){
    $_SESSION['validation_errors'] = [];

    if(empty($_POST['email'])){
        $_SESSION['validation_errors'] ['email'] = 'Email is required';
    }
    else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $_SESSION['validation_errors'] ['email'] = 'Invalid Email id';
        $_SESSION['formdata']['email'] = $_POST['email'];
    }

    if(empty($_POST['password'])){
        $_SESSION['validation_errors'] ['password'] = 'password is required';
    }
    else if(strlen(trim($_POST['password'])) < 6){
        $_SESSION['validation_errors']['password'] = 'Password must be 6 char long';
    }
    else if(trim($_POST['password']) !== trim($_POST['repeat_password'])){
        $_SESSION['validation_errors']['password'] = 'Password does not match';
    }

    if(empty($_FILES['profile_picture']['name'])){
        $_SESSION['validation_errors'] ['profile_picture'] = 'profile_picture is required';
    }

    if(count($_SESSION['validation_errors'])>0){
        header('Location: register.php');
    }
    else{

        //validation done
        //Form sanitization

        $email = htmlspecialchars($_POST['email']);
        
        $password = htmlspecialchars($_POST['password']);
        
        $profile_picture = $_FILES['profile_picture'];
        
        $remember = htmlspecialchars($_POST['remember']);


        //Check if mail exists or not

        $stmt = $conn->prepare("select * from users where email = :email");

        $stmt->execute([
            'email' => $email,
        ]);

            $rowCount = $stmt->rowCount();

            if($rowCount > 0){
                $_SESSION['validation_errors']['email'] = 'Email is already exists';
                header('Location: register.php');
            }

            // File upload

            $check = getimagesize($profile_picture['tmp_name']);
           
            if($check !== false){
               $uploadOk = 1;
           }else{
               $uploadOk = 0;
           }

           $extension = image_type_to_extension($check[2]);
           
           $target_dir = "upload/";

           $hash_name = md5(basename($profile_picture['name']) . time());

        $target_file = $target_dir . $hash_name . $extension;

         if($uploadOk == 0){
             echo "Sorry, your file was not uploaded";
         }else{
             //file upload

            if(move_uploaded_file($profile_picture['tmp_name'], $target_file)){

                //uploaded ok

                echo "uploaded successfully";

            }else{
                //uploaded error
                echo "upload error";

            }
  }

    //PASSWORD
     
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    //STORE AT DATABASE

    $stmt = $conn->prepare("insert into users(email, password, profile_picture, remember, created_at, updated_at)
        values(:email, :password, :profile_picture, :remember, :created_at, :updated_at)");

    $res =  $stmt->execute([

        'email' => $email,
        'password' => $password_hash,
        'profile_picture' => $target_file,
        'remember' => $remember,
        'created_at' => date('Y-m-d H:i:s' , time()),
        'updated_at' => date('Y-m-d H:i:s' , time()),

    ]);
        
        if($res){
            //Login
            $last_id = $conn->lastInsertId();
            $_SESSION['user'] = [
                'id' => $last_id,
                'email' => $email,
                'profile_picture' => $target_file,
            ];

            //Redirect to homepage

            header('Location: index.php');

        }


    }




}


?>