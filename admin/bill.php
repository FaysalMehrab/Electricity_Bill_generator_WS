
<?php
    @include '../config.php';
	session_start();

	if(!isset($_SESSION['admin_id']))
	{
		header('location:../login_form.php');
	}
?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DESCO Billing Page</title>
 <link rel="stylesheet" type="text/css" href="../css/new.css">
 <style>
    .btn-primary {
        display: inline-block;
        background-color: #3498db; 
        color: white; 
        padding: 10px 20px; 
        margin: 10px 0px; 
        border-radius: 5px; 
        text-decoration: none; 
    }
    .btn-primary:hover {
        background-color: #2980b9; 
    }
</style>

</head>
<body>

	<div class="container-r">

		<div class="content-r">
			
			
			<p>DESCO Billing Page</p>
            
            <a href="../logout.php" class="btn">Logout</a>  
             <a href="../admin_page.php" class="btn">Main Menu</a> 
            
			
			

		</div>
		
	</div>

 <div class="main-content">
            <div class="wrapper">
                <h1>Generate Bills</h1>

                <br />


<?php
  if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['accept']))
                    {
                        echo $_SESSION['accept'];
                        unset($_SESSION['accept']);
                    }
?>


<table class="tbl-full">
                    <tr>
                    	<th>SI.NO.</th>
                        <th>ID</th>
                        <th>NID</th>
                        <th>NAME</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Actions</th>
                    </tr>

                    
                    <?php 

                        //Query to Get all Admin
                        $select = "SELECT * FROM login_info ";
                        //Execute the Query
                        $result = mysqli_query($connect, $select);

                        //CHeck whether the Query is Executed or Not
                        if($result==TRUE)
                        {
                            // Count Rows to CHeck whether we have data in database or not
                            $count = mysqli_num_rows($result); // Function to get all the rows in database

                            $sn=1; //Create a Variable and Assign the value

                            //CHeck the num of rows
                            if($count > 0)
                            {
                                //WE HAve data in database
                                while($rows=mysqli_fetch_assoc($result))
                                {
                                    //Using While loop to get all the data from database.
                                    //And while loop will run as long as we have data in database

                                    //Get individual DAta
                                    $id=$rows['id'];
                                    $nid=$rows['nid'];
                                    $name=$rows['name'];
                                    $email=$rows['email'];
                                    $user_type=$rows['user_type'];

                                    //Display the Values in our Table
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?>)</td>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $nid; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $user_type; ?></td>
                                        <td>

                                           <!-- <a href="../admin/make_bill.php?id=<?php echo $id; ?>" class="btn-primary">Make_Bill</a> -->
                                           <a href="../admin/make_bill.php?id=<?php echo $id; ?>" class="btn-primary">Make Bill</a>
                                            <a href="../admin/upload.php?id=<?php echo $id; ?>" class="btn-primary">Upload Bill</a>
                                            
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else
                            {
                                echo "The Database Is Empty";
                            }
                        }

                    ?>


                    
                </table>

            </div>
        </div>
        


</body>
</html>