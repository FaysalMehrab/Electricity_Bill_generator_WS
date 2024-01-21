<?php
    @include '../config.php';
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header('location:../login_form.php');
    }

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
<html>
<head>
    <title>Upload PDF</title>
    <link rel="stylesheet" type="text/css" href="../css/new.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 20px;
            margin-top: 30px;
          
        }
        .form-group label {
            display: block;
            margin-bottom: 10px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container-r">

        <div class="content-r">
<a href="../logout.php" class="btn">Logout</a>
<a href="../admin_page.php" class="btn">Main Menu</a>
<a href="../admin/bill.php" class="btn">Billing Page</a>

<h3>Bill For <span><?php echo $name?> And ID is: <?php echo $id?></span> </h3>

        </div>
        
    </div>
 
    




    <?php
  if(isset($_SESSION['upload']))
     {
       echo "<div style='background-color: green; padding: 10px; border-radius: 5px; margin-bottom: 20px;text-align: center;font-size: 20px;'>".$_SESSION['upload']."</div>"  ;
       // Unset the message after displaying it
       unset($_SESSION['upload']);
     }
?>


    <div class="container">
        <form action="upload_accept.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <br> <label for="pdfFile">PDF File:</label>
                <input type="file" id="pdfFile" name="pdfFile" accept=".pdf">
            </div>

            <!-- <div class="form-group">
                <label for="totalBill">Total Bill:</label>
                <input type="text" id="totalBill" name="totalBill">
            </div> -->

            <label for="billingMonth">Billing Month:</label><br>
        <input type="month" id="billingMonth" name="billingMonth"><br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">

<button type="submit" class="btn-primary">Upload</button>


        </form>
       
    </div>
</body>
</html>


