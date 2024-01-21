<?php
    @include '../config.php';
    
session_start();
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
        
    } else {
        echo 'No user found with the provided ID.';
        exit;
    }
    
?>


<!DOCTYPE html>
<html>
<head>
    <title>Electricity Bill Calculator</title>
    <link rel="stylesheet" type="text/css" href="../css/new.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        #billForm {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        #billForm label {
            display: block;
            margin-bottom: 5px;
        }
        #billForm input, #billForm select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        #billForm input[type="button"] {
            cursor: pointer;
        }
        #result {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
  if(isset($_SESSION['update']))
     {
       echo "<div style='background-color: green; padding: 10px; border-radius: 5px; margin-bottom: 20px;text-align: center;font-size: 20px;'>".$_SESSION['update']."</div>"  ;
       // Unset the message after displaying it
       unset($_SESSION['update']);
     }
?>

    <h2 style="text-align: center;">DESCO Electricity Bill Calculator</h2>




    <form id="billForm" action="update.php" method="post" enctype="multipart/form-data">
        <label for="billingMonth">Billing Month:</label><br>
        <input type="month" id="billingMonth" name="billingMonth"><br>

        <label for="billNo">Bill No:</label><br>
        <input type="text" id="billNo" name="billNo"><br>

        <label for="issueDate">Issue Date:</label><br>
        <input type="date" id="issueDate" name="issueDate"><br>

        <label for="dueDate">Due Date:</label><br>
        <input type="date" id="dueDate" name="dueDate"><br>

        <label for="prevUnit">Previous Unit:</label><br>
        <input type="number" id="prevUnit" name="prevUnit"><br>

        <label for="currUnit">Current Unit:</label><br>
        <input type="number" id="currUnit" name="currUnit"><br>

        <label for="hourType">Hour Type:</label><br>
        <select id="hourType" name="hourType">

            <option value="peak">Peak Hours</option>
            <option value="offPeak">Off-Peak Hours</option>

        </select><br>
        <input type="button" value="Calculate" onclick="calculateBill()">
         
       <input type="hidden" name="id" value="<?php echo $id; ?>">
       <input type="hidden" id="totalBillInput" name="totalBill">

      <button type="submit" class="btn-primary">Upload To Database</button>

        
    </form>



    <form id="billForm" action="upload.php" method="post" enctype="multipart/form-data">
         <input type="hidden" id="totalBillInput" name="totalBill">
     </form>


    <div id="result"></div>

    <script>
        function calculateBill() {
            var prevUnit = document.getElementById('prevUnit').value;
            var currUnit = document.getElementById('currUnit').value;
            var hourType = document.getElementById('hourType').value;

            var unitDiff = currUnit - prevUnit;
            var costPerUnit = (hourType == 'peak') ? 10.24 : 6.80;
            var totalCost = unitDiff * costPerUnit;
            var vat = totalCost*0.05;
            var totalbill = totalCost+vat;
            document.getElementById('totalBillInput').value = totalbill.toFixed(2);
        
            
            var billingMonth = document.getElementById('billingMonth').value;
            var billNo = document.getElementById('billNo').value;
            var issueDate = new Date(document.getElementById('issueDate').value);
            var dueDate = new Date(document.getElementById('dueDate').value);

            var resultDiv = document.getElementById('result');
            resultDiv.innerHTML = 'Name: <?php echo $name?>'+ '<br>'+ '<br>'+
                                  'ID: <?php echo $id?>'+ '<br>'+ '<br>'+
                                   'NID: <?php echo $nid?>'+ '<br>'+ '<br>'+
                                   'Email: <?php echo $email?>'+ '<br>'+ '<br>'+
                                  'Billing Month: ' + billingMonth + '<br>' + '<br>'+
                                  'Bill No: ' + billNo + '<br>' + '<br>'+
                                  'Issue Date: ' + issueDate.toDateString() + '<br>' + '<br>'+
                                  'Due Date: ' + dueDate.toDateString() + '<br>' + '<br>'+
                                  'Unit Difference: ' +  unitDiff.toFixed(2)+ '<br>' + '<br>'+
                                  'Total Cost: TK ' + totalCost.toFixed(2) + '<br>' + '<br>'+
                                  'Vat (On Current Dues: TK)' + vat.toFixed(2) + '<br>' + '<br>'+
                                  'Total Bill: TK' + totalbill.toFixed(2) ;

                                  var doc = new jsPDF();

// Set font size
doc.setFontSize(22);

// Add a title
doc.text('DESCO Electricity Bill', 105, 20, null, null, 'center');

// Draw a line
doc.setLineWidth(0.5);
doc.line(20, 25, 190, 25);

// Set font size for the rest of the document
doc.setFontSize(12);

// Add the content
var lines = resultDiv.innerText.split('<br>');
for (var i = 0; i < lines.length; i++) {
    doc.text(lines[i], 20, 40 + i * 10);
}

// Save the PDF
doc.save('<?php echo $name?>.pdf');


}
    </script>  


</body>
</html>
