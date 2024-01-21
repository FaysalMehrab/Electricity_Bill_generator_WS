<?php
    @include '../config.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('location:../login_form.php');
    }

    // 1. Get the ID of the Admin to be edited
    $id = $_GET['id'];

    // 2. Create SQL Query to fetch Admin details
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
        $email = $row['email'];
        $password = $row['password'];
    } else {
        echo 'No user found with the provided ID.';
        exit;
    }

    $connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head><link rel="stylesheet" type="text/css" href="../css/user.css"></head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
    

    #header {
      background-color: deepskyblue;
      color: #fff;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    #header #left-section h3 {
      font-size: 24px;
    }
    #header ul {
      list-style: none;
      display: flex;
      align-items: center;
    }
    #header ul li {
      margin-right: 20px;
    }
    #header ul li a {
      text-decoration: none;
      color: #fff;
      font-size: 16px;
      transition: color 0.3s ease-in-out;
    }
    #header ul li a:hover {
      color: black;
    }

    /* Animation styles */
    @keyframes slideIn {
      from {
        transform: translateY(-100%);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }
    #header {
      animation: slideIn 0.5s ease-in-out;
    }

</style>


<script> 
       // JavaScript animation
    window.addEventListener("DOMContentLoaded", () => {
      const header = document.getElementById("header");
      header.style.animation = "slideIn 0.8s ease-in-out";
    });
</script>


    <body>
  <div id="header">
    <div id="left-section">

      <h3>Hello <span><?php echo $_SESSION['user_name']?></span> </h3>
    
    </div>
    <ul id="options">
      <li><a href="../user_page.php">Home</a></li>
      <li><a href="../User/profile.php?id=<?php echo $id; ?>">Profile</a></li>
      <li><a href="user/bill_info.php?id=<?php echo $id; ?>" class="btn-primary">Bill Info</a></li>
      <li><a href="../logout.php">Logout</a></li>
    </ul>
  
</div>
</body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: darkblue;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: skyblue;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;

            transform: translateY(20px);
            transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out;
        }
        .container.show {
            opacity: 1;
            transform: translateY(0);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #ff6b6b;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <form action="update_profile.php" method="POST">
            <div class="form-group">
                <label for="nid">NID:</label>
                <input type="text" id="nid" name="nid" value="<?php echo $nid; ?>" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo "********"; ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <button href="../User/update_profile.php" type="submit">Update</button>
            </div>
        </form>
    </div>
</body>

</html>
