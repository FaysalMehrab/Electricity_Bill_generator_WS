
<?php   
     @include '../config.php';
    session_start();

    if(!isset($_SESSION['admin_name']))
    {
        header('location:../login_form.php');
    }

    // 1. get the ID of Admin to be deleted
    $id = $_GET['id'];

    //2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM register_info WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($connect, $sql);

    // Check whether the query executed successfully or not
    if($res==true)
    {
        //Query Executed Successully and Admin Deleted
        //echo "Admin Deleted";
        //Create SEssion Variable to Display Message
      $_SESSION['delete'] = "<div class='success'><b>Request Denied</div>";
        //Redirect to Manage Admin Page
        
         header('location:../admin/register_info.php');
    }
    else
    {
        //Failed to Delete Admin
        //echo "Failed to Delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
         header('location:../admin/register_info.php');
    }

    //3. Redirect to Manage Admin page with message (success/error)

?>