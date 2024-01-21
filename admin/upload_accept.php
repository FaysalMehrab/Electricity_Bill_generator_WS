<?php
    @include '../config.php';
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header('location:../login_form.php');
    }

   $id = $_POST['id'];
   
$totalbill = $_POST['totalBill'];
$month = $_POST['billingMonth'];


    // 2. Create SQL Query to fetch Admin details
    $sql = "SELECT * FROM login_info WHERE id = $id";

    // Execute the Query
    $res = mysqli_query($connect, $sql);

    // Check whether the query executed successfully or not
    if ($res == true) {
        $row = $res->fetch_assoc();

        // Store the retrieved information in variables
        $id = $row['id'];

    } else {
        echo 'No user found with the provided ID.';
        exit;
    }
      
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}
$target_file = $target_dir . basename($_FILES["pdfFile"]["name"]);

if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $target_file)) 

{
    $query = "INSERT INTO bill_info(id, bills, totalbill, month) VALUES ('$id', '$target_file', '$totalbill', '$month')";
    if (mysqli_query($connect, $query))


     {
        

             $_SESSION['upload'] = "Uploaded To The Database" ;
        header('Location:../admin/upload.php?id='.$id);

    } 



    else 

    {
        echo "Error uploading data: " . mysqli_error($connect);
    }
} 


else 


{
    echo "Sorry, there was an error uploading your file.";
}

$connect->close();

?>
