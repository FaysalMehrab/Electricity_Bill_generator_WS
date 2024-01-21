
<?php
    @include '../config.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('location:../login_form.php');
    }


    // 1. Get the ID of the Admin to be displayed
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

    
?>

<!DOCTYPE html>
<html lang="en">

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
      header.style.animation = "slideIn 1s ease-in-out";
    });
</script>

</head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

<body>

  <div id="header">
    <div id="left-section">

      <h3>Hello <span><?php echo $_SESSION['user_name']?></span> </h3>
    
    </div>
    <ul id="options">
       <li><a href="../user_page.php">Home</a></li>
       <li><a href="../user/bill_info.php">Bill Info</a></li>
     
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
            margin: 100px auto;
            background-color: skyblue;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 50px;
            opacity: 0;
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

        table {
            width: 100%;
        }

        table td {
            padding: 10px 0;
            color: #555;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }


        .edit-button {
            padding: 10px 20px;
            background-color: #ff6b6b;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
        }
         .edit-button:hover
         {
            color: black;
         }


        .edit-button.show {
            opacity: 1;
            transform: scale(1);
        }

        .success
        {
              background-color: silver;
              color: green;
              text-align: center;
              font-size: 20px;
              font-style: oblique;

        }
    </style>
</head>

<body>
        <?php

    if(isset($_SESSION['add']))
    {
        echo '<div class="success">' . $_SESSION['add'] . '</div>';
        unset($_SESSION['add']);
    }

    ?>
    <div class="container">
        <h2>Profile Information</h2>
        <table>
            <tr>
                <td><strong>ID:</strong></td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td><strong>NID:</strong></td>
                <td><?php echo $nid; ?></td>
            </tr>
            <tr>
                <td><strong>Name:</strong></td>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td><strong>Password:</strong></td>
                <td><?php echo $password; ?></td>
            </tr>
        </table>
        <div class="button-container">
            <button class="edit-button">Edit Profile</button>
        </div>
    </div>

    <script>
        const container = document.querySelector('.container');
        const editButton = document.querySelector('.edit-button');

        // Show the profile container and edit button with animation
        setTimeout(() => {
            container.classList.add('show');
            editButton.classList.add('show');
        }, 300);

        editButton.addEventListener('click', () => {
            // Redirect to the edit profile page
            window.location.href = '../user/edit_profile.php?id=<?php echo $id; ?>';

        });
    </script>
</body>

</html>


