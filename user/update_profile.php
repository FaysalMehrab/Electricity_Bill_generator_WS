
<!DOCTYPE html>
<html lang="en">
<head><link rel="stylesheet" type="text/css" href="../css/user.css"></head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <body>
</body>
</html>

<?php
    @include '../config.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('location:../login_form.php');
    }

  


    // Get the form data
    $id = $_POST['id'];
    $nid = $_POST['nid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Create SQL Query to update Admin details
    $sql = "UPDATE login_info SET nid = '$nid', name = '$name', email = '$email', password = '$password' WHERE id = $id";

    // Execute the Query
    $res = mysqli_query($connect, $sql);

    // Check whether the query executed successfully or not
    if ($res == true) {
        // Redirect to the profile page with updated information
        $_SESSION['add'] = "<div class='success'>Profile Updated successfully </div>";
        header('location:profile.php?id=' . $id);
    } else {
        echo 'Failed to update profile. Please try again.';
    }

    $conn->close();
?>





