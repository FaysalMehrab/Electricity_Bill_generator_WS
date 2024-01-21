<?php
    @include '../config.php';
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header('location:../login_form.php');
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM login_info WHERE id = $id";
    $res = mysqli_query($connect, $sql);
    if ($res == true) {
        $row = $res->fetch_assoc();
        $id = $row['id'];
        $nid = $row['nid'];
        $name = $row['name'];
        $email = $row['email'];
    } 
    $connect->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Electricity Bill Calculator</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
</head>
<body>
    <form id="billForm">
        <label for="billingMonth">Billing Month:</label><br>
        <input type="month" id="billingMonth" name="billingMonth"><br>
        <label for="billNo">Bill No:</label><br>
        <input type="text" id="billNo" name="billNo"><br>
        <label for="issueDate">Issue Date:</label><br>
        <input type="date" id="issueDate" name="issueDate"><br>
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
            var billingMonth = document.getElementById('billingMonth').value;
            var billNo = document.getElementById('billNo').value;
            var issueDate = new Date(document.getElementById('issueDate').value);
            var dueDate = new Date(issueDate.setMonth(issueDate.getMonth() + 1));
            var resultDiv = document.getElementById('result');
            resultDiv.innerHTML = 'Name: <?php echo $name?>'+ '<br>'+ '<br>'+
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
doc.setFontSize(22);
doc.text('DESCO Electricity Bill', 105, 20, null, null, 'center');
doc.setLineWidth(0.5);
doc.line(20, 25, 190, 25);
doc.setFontSize(12);
var lines = resultDiv.innerText.split('<br>');
for (var i = 0; i < lines.length; i++) {
    doc.text(lines[i], 20, 40 + i * 10);
}
doc.save('bill.pdf');

    // Convert the generated PDF to a base64 string
    var pdfBase64String = doc.output('datauristring');

    // Send the base64 string to the server using AJAX
    $.ajax({
        url: 'upload.php',  // replace with the path to your PHP script
        method: 'POST',
        data: {
            pdf_data: pdfBase64String,
            nid: nid,  // Assuming you have the nid and totalbill variables defined
            totalbill: totalbill
        },
        success: function(response) {
            console.log(response);
        }
    });


}
 </script>
</body>
</html>
