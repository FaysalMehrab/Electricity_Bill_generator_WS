<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h3 {
            text-align: center;
            padding: 20px;
            color: #333;
        }
        .btn {
            display: block;
            width: 200px;
            height: 50px;
            margin: 20px auto;
            background-color: #3498db;
            text-align: center;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            line-height: 50px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<h3>Admin Page</h3>	

<form action="admin/register_info.php" method="POST"> 
  <button class="btn" type="submit">Registration Information</button> 
</form> 

<form action="admin/bill.php" method="POST"> 
  <button class="btn" type="submit">Bill Generator</button> 
</form> 

<a href="logout.php" class="btn">Logout</a>

</body>
</html>
