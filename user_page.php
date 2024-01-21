<?php
    @include 'config.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('location:login_form.php');
        exit;
    }
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM login_info WHERE id = $id";

    // Execute the Query
    $res = mysqli_query($connect, $sql);

    // Check whether the query executed successfully or not
    if ($res == true) {
        $row = $res->fetch_assoc();

        // Store the retrieved information in variables
        $id = $row['id'];
        $nid = $row['nid'];
        $name = $row['name'];

        
    } else {
        echo 'No user found with the provided ID.';
        exit;
    }

?>







<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/new.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F5F5F5; /* off-white background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        #options {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }
        #options li {
            margin-bottom: 20px; /* increased bottom margin */
        }
        .btn-primary {
            background-color: #007bff; /* blue background */
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block; /* added to give the buttons block properties */
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <ul id="options">
      <h2>Welcome <span><?php echo $name?></span> </h2>
      <h2>NID: <span><?php echo $nid?></span> </h2>
      <li><a href="user/profile.php?id=<?php echo $id; ?>" class="btn-primary">Profile</a></li>
      <li><a href="user/bill_info.php?id=<?php echo $id; ?>" class="btn-primary">Bill Info</a></li>
      <li><a href="logout.php" class="btn-primary">Logout</a></li>
    </ul>
</body>
</html>
