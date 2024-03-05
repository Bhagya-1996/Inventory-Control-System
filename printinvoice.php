<?php 
if(!isset($_SESSION))
{
  	session_start();
} 
if(!isset($_SESSION['sess_user'])) { header("refresh:2; url=index.php"); } 
else 
{ 
include "include/connetion.php"; 

if(isset($_POST['compInvo']))
{
	$compInvo = $_POST['compInvo'];

	$sql = "SELECT * FROM invoice WHERE invono='$compInvo'";
		$result = mysqli_query($con, $sql);
    		while($row = mysqli_fetch_assoc($result)) 
			{
				$invono = $row['invono'];
				$invodate = $row['date'];
				$cus_no = $row['cusno'];
				$amount = $row['total'];
			}
	$sql = "SELECT * FROM customer WHERE cusID = '$cus_no'";
		$result = mysqli_query($con, $sql);
		
		while($row = mysqli_fetch_assoc($result)) 
			{ 
				$cusfname = $row['fname'];
				$cuslname = $row['lname'];
			}
} else {header("refresh:2; url=invoice.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Invoice</title>
<style>
.gridtable {
    border-collapse: collapse;
    width: 849px;
}
 .gridtable th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
 .printgridtable th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color:#f4f4f4;
    color:#000;
}
.gridtable th, .gridtable td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
.dottable, .dottable th, .dottable td {
	border: 1px dashed black;
}

.gridtable tr:hover {background-color:#f5f5f5;}
</style>
</head>

<body>
<div class="imgcontainer">
<a href="invoice.php"><< Back</a>
<br />
<table border="0">
	<tr><td rowspan="2"><img src="images/logo.jpg" style="margin-right:5px;" /></td><td><h2 align="left" style="margin-bottom:2px;">&nbsp;</h2></td></tr>
    <tr><td><address>No 15, Ingiriya Road, Padukka.</address></td></tr>
</table> 
<hr width="849" align="left" />
	<h2><strong>Invoice</strong></h2>
   
        <table border="0" cellpadding="15">
    	<tr>
        	<td><label>Invoice No</label></td><td>INVO<?Php if(!empty($invono)){echo $invono; }?></td>
        	<td><label>Date</label></td><td><?Php if(!empty($invodate)){echo $invodate; }?></td>
      	</tr>
        <tr>
        	<td><label>Customer</label></td><td><?Php if(!empty($cusfname)){echo $cusfname; }?> &nbsp; <?Php if(!empty($cuslname)){echo $cuslname; }?></td>
            <td>&nbsp;</td><td>&nbsp;</td>
        </tr>
 	</table>
    <br /> 
    <table border="1" width="849" class="gridtable printgridtable">
    	<tr><th>No. of Items</th><th>Item</th><th>Unit Price</th><th>Qty</th><th>Amount</th></tr>
    <?php if(!empty($invono)){
	$sql = "SELECT * FROM itemlist WHERE invono='$invono'";
		$result = mysqli_query($con, $sql);
		$no=1;
		$grantotal =0;
    		while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr><td>".$no."</td><td>".$row['itemname']."</td>
				<td align='right'>".$row['unitprice']."</td><td>".$row['qty']."</td><td align='right'>".$row['amount']."</td></tr>";
				$no++;
				$grantotal += $row['amount'];
			}
			echo "<tr><td colspan='4'>Total </td><td align='right'>".$grantotal."</td></tr>";
			
			
			$sql = "UPDATE invoice SET total=".$grantotal." WHERE invono='$invono'";
				if (mysqli_query($con, $sql)) {	}	
	}
	?>
    </table>
</div>
</body>
</html>
<?Php } ?>