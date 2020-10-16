<?php  session_start(); 

if(isset($_SESSION['user'])){
  header('Location: index.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class= "bg-gray-200" >
<nav class="flex items-center justify-between flex-wrap bg-blue-500 p-6">
  <div class="flex items-center flex-shrink-0 text-white mr-6">
    <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
    <span class="font-semibold text-xl tracking-tight"><b>Secure Login</b></span>
  </div>
  <div class="block lg:hidden">
    <button class="flex items-center px-3 py-2 border rounded text-blue-200 border-blue-400 hover:text-white hover:border-white">
      <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
    </button>
  </div>
  <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
    <div class="text-sm lg:flex-grow">
      <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
        <b>Home</b> 
      </a>
      <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
       <b>Login</b> 
      </a>
    </div>
    <div>
      <a href="http://localhost/LoginProject/register.php" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Register</a>
    </div>
  </div>
</nav>
<div class="w-full max-w-xs mx-auto mt-24">
  <form action="login_backend.php" method="POST"  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
  <h2 class="text-2xl mb-4" >Login</h2>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
        Email
      </label>
      <input name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="text" placeholder="Enter Your Email" value="<?php echo isset($_SESSION['formdata']) ? $_SESSION['formdata']['email']: '' ?>">
    
    <?php

  if(isset($_SESSION['validation_errors']) && isset($_SESSION['validation_errors'] ['email'])):
    ?>

    <p class="text-red-500 text-xs italic mt-2"><?=$_SESSION['validation_errors']['email']?></p>
    <?php

endif;

?>

    </div>

    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Password
      </label>
      <input name="password" class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700  leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
      
      <?php

if(isset($_SESSION['validation_errors']) && isset($_SESSION['validation_errors'] ['password'])):
  ?>

  <p class="text-red-500 text-xs italic mt-2"><?=$_SESSION['validation_errors']['password']?></p>
  <?php

endif;

?>

    </div>

    <div class="mb-6">
    <input class=""  name="remember" type="checkbox" id="remember">
      <label class="text-gray-700 text-sm font-bold mb-2" for="remember">
        Remember me
      </label>
    </div>
    
    <div class="flex items-center justify-between">
      <button type="submit" name="submit" class="bg-blue-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Login
      </button>
      <a class="inline-block align-baseline font-bold text-sm text-teal-500 hover:text-blue-800" href="#">
        Forgot Password?
      </a>
    </div>
  </form>
  <p class="text-center text-gray-500 text-xs">
    &copy;2020.All rights reserved.Developed By Pranaya Rath
  </p>
</div>
</body>
</html>