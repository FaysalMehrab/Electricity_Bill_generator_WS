<?php

// Include the configuration file
@include 'config.php';

// Check if the registration form is submitted
if(isset($_POST['submit']))
{
    // Retrieve user input from the form
    $name = $_POST['name'];
    $nid = $_POST['nid'];
    $email =  $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    // Check if the user with the same email and password already exists
    $select = "SELECT * FROM register_info WHERE email = '$email' && password = '$password'";
    $result = mysqli_query($connect, $select);

    // If a user with the same email and password exists, display an error message
    if(mysqli_num_rows($result) > 0)
    {
        $error[] = 'User already exists!';
    }
    else
    {
        // If passwords match, insert the user information into the database
        if($password != $cpassword)
        {
            $error[] = 'Passwords did not match';
        }
        else
        {
            $insert = "INSERT INTO register_info(nid, name, email, password, user_type) VALUES('$nid','$name','$email', '$password','$user_type')";
            mysqli_query($connect, $insert);
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register_Form</title>
    <link rel="stylesheet" type="text/css" href="css/st.css">  
</head> 

<body>
    <div class="form_cont">
        <form action="" method="post">
            <h3>Register Form</h3><br>

            <?php
            // Display error messages, if any
            if(isset($error))
            {
                foreach ($error as $error_message) {
                    echo '<span class="error-msg">'.$error_message.'</span>';
                };
            };
            ?>

            <!-- Form fields for user input -->
            <input type="text" name="name" required placeholder="Enter Your Full Name"><br><br>
            <input type="number" name="nid" required placeholder="Enter Your NID Number"><br><br>
            <input type="email" name="email" required placeholder="Enter Your Email Address"><br><br>
            <input type="password" name="password" required placeholder="Enter Your Password"><br><br>
            <input type="password" name="cpassword" required placeholder="Confirm Your Password"><br><br>

            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select><br><br>

            <input type="submit" name="submit" value="Register Now" class="form-btn"><br><br>  

            <p>Already have an account? <a href="login_form.php">Login</a></p>
        </form>
    </div>
</body>
</html>
