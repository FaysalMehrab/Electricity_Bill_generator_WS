
<?php   
     @include '../config.php';
    session_start();

    if(!isset($_SESSION['admin_name']))
    {
        header('location:../login_form.php');
    }

    // 1. get the ID of Admin to be deleted
    $id = $_GET['id'];

// SQL query to insert the row into the destination table
$sql_insert = "INSERT INTO  login_info SELECT * FROM register_info WHERE id = $id";

// Execute the insert query
if ($connect->query($sql_insert) === TRUE) {
    // SQL query to delete the row from the source table
    $sql_delete = "DELETE FROM register_info WHERE id = $id";

    // Execute the delete query
    if ($connect->query($sql_delete) === TRUE) {
         $_SESSION['accept'] = "<div class='success'><b >Request Accepted </div>";
        //Redirect to Manage Admin Page
        
         header('location:../admin/register_info.php');
    } else {
         $_SESSION['accept'] = "<div class='error'><b>Error</div>";
        //Redirect to Manage Admin Page
        
         header('location:../admin/register_info.php');
    }
} else {
    $_SESSION['accept'] = "<div class='error'><b>Error</div>";
        //Redirect to Manage Admin Page
        
         header('location:../admin/register_info.php');
}

// Close the connection
$conn->close();

?>
