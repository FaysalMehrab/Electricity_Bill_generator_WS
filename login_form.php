<?php

// Include the configuration file
@include 'config.php';

// Start a new session
session_start();

// Check if the login form is submitted
if(isset($_POST['submit'])){

   // Retrieve user input from the form
   $email =  $_POST['email'];
   $password = md5($_POST['password']);

   // Select user from the database based on email and password
   $select = "SELECT * FROM login_info WHERE email = '$email' && password = '$password'";
   $result = mysqli_query($connect, $select);

   // If a matching user is found in the database
   if(mysqli_num_rows($result) > 0){

      // Fetch the user information
      $row = mysqli_fetch_array($result);

      // Check user type and set session variables accordingly
      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_id'] = $row['id'];
         // Redirect to admin page
         header('location:admin_page.php');
      } elseif($row['user_type'] == 'user'){
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_id'] = $row['id'];
         // Redirect to user page
         header('location:user_page.php');
      }
     
   } else {
      // If no matching user is found, display an error message
      $error[] = 'Incorrect email or password!';
   }

};
?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Login_form</title>
   <link rel="stylesheet" type="text/css" href="css/st.css">
</head>
<body>

<div class="form_cont">
   
   <form action="" method="post">
      
      <h3>Login Now</h3><br><br>

      <?php
      // Display error messages, if any
      if(isset($error)){
         foreach($error as $error_message){
            echo '<span class="error-msg">'.$error_message.'</span>';
         };
      };
      ?>

      <!-- Form fields for user input -->
      <input type="email" name="email" required placeholder="enter your email"><br><br>
      <input type="password" name="password" required placeholder="enter your password"><br><br>
      <input type="submit" name="submit" value="Login" class="form-btn"><br><br>

      <p>Don't have an account? <a href="register_form.php">Register now</a> </p>

   </form>

</div>

</body>
</html>
