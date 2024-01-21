<?php
    @include '../config.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('location:../login_form.php');
    }

    $id = $_SESSION['user_id'];

    // Create SQL Query to fetch bill details for the logged-in user
    $sql = "SELECT * FROM bill_info WHERE id = $id";

    // Execute the Query
    $res = mysqli_query($connect, $sql);

    // Check whether the query executed successfully or not
    if ($res == false) {
        echo 'Error: ' . mysqli_error($connect);
        exit;
    }

    // Fetch the data for the graph and table
    $sql_all_info = "SELECT * FROM bill_all_info WHERE id = $id";
    $res_all_info = mysqli_query($connect, $sql_all_info);
    $data = array();
    while ($row = mysqli_fetch_assoc($res_all_info)) {
        $data[] = $row;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bill Info</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

            li {
        list-style-type: none; 
        padding: 10px; 
        margin-bottom: 10px;

    }
    .btn-primary {
        background-color: #007bff; 
        color: white; 
        text-decoration: none; 
        padding: 10px 20px; 
        border-radius: 5px; 
    }
    .btn-primary:hover {
        background-color: #0056b3; /* Change background color on hover */
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

   <ul>
    
    <li><a href="../user_page.php?id=<?php echo $id; ?>" class="btn-primary">Home</a></li>
    <li><a href="../user/profile.php?id=<?php echo $id; ?>" class="btn-primary">Profile</a></li>
    <li><a href="../logout.php" class="btn-primary">Logout</a></li>
</ul>

    <table>
        <tr>
            <th>ID</th>
            <th>Bill PDF</th>
            <th>Billing Month</th>
            <th>Billing Number</th>
            <th>Issue Date</th>
            <th>Due Date</th>
            <th>Previous Unit (TK)</th>
            <th>Current Unit (TK)</th>
            <th>Total Bill</th>
            <th>Type</th>
        </tr>
        <?php 
            $bill_info = mysqli_fetch_assoc($res);
            foreach ($data as $row) { 
        ?>
            <tr>
                <td><?php echo $bill_info['id']; ?></td>
                <td><a href="../admin/upload/<?php echo $bill_info['bills']; ?>" download>Download Bill Of <?php echo $row['b_month']; ?></a></td>
                <td><?php echo $row['b_month']; ?></td>
                <td><?php echo $row['b_number']; ?></td>
                <td><?php echo $row['issue_date']; ?></td>
                <td><?php echo $row['due_date']; ?></td>
                <td><?php echo $row['pre_unit']; ?></td>
                <td><?php echo $row['cur_unit']; ?></td>
                <td><?php echo $row['totalbill']; ?></td>
                <td><?php echo $row['type']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <canvas id="myChart" width="300" height="100"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php foreach ($data as $row) echo '"' . $row['b_month'] . '",'; ?>],
                datasets: [{
                    label: 'Total Bill',
                    data: [<?php foreach ($data as $row) echo $row['totalbill'] . ','; ?>],
                    backgroundColor: 'rgba(0,0,0)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
