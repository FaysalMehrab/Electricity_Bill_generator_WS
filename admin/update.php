
<?php   
     @include '../config.php';
    session_start();

    if(!isset($_SESSION['admin_id']))
    {
        header('location:../login_form.php');
    }

   
    $id = $_POST['id'];
    $b_month = $_POST['billingMonth'];
    $b_number = $_POST['billNo'];
    $issue_date = $_POST['issueDate'];
    $due_date = $_POST['dueDate'];
    $pre_unit = $_POST['prevUnit'];
    $cur_unit = $_POST['currUnit'];
    $type = $_POST['hourType'];
    $totalbill = $_POST['totalBill'];




// SQL query to insert the row into the destination table
$sql_insert = "INSERT INTO bill_all_info(id, b_month, b_number, issue_date,due_date, pre_unit, cur_unit,totalbill, type) VALUES ('$id', '$b_month', '$b_number','$issue_date', '$due_date','$pre_unit', '$cur_unit', '$totalbill','$type')";

// Execute the insert query
if ($connect->query($sql_insert) === TRUE) {

        $_SESSION['update'] = "Updated" ;
        header('Location: ../admin/make_bill.php?id='.$id);
    } 




?>
