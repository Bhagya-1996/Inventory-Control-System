<?php 
if(!isset($_SESSION))
{
  	session_start();
}  
if(!isset($_SESSION['sess_user'])) { header("refresh:2; url=index.php"); } 
else 
{ 
include "include/connetion.php"; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Monthly Sales Report</title>
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
<a href="monSalRepot.php">  Back</a>
	<br />
<table border="0">
	<tr><td rowspan="2"><img src="images/logo.jpg" style="margin-right:5px;" /></td>
	  <td>&nbsp;</td>
	</tr>
    <tr><td><address>No 15, Ingiriya Road, Padukka.</address></td></tr>
</table> 
<hr width="849" align="left" />
    <h2>Monthly Sales Report</h2>
    <hr width="849" align="left" />
    <table border="1" width="849" class="gridtable printgridtable">
    	
    <?php 
	if(isset($_POST['stDate']) && (isset($_POST['enDate'])))
	{
	$startDate = $_POST['stDate'];
	$endDate = $_POST['enDate'];
	$sql = "SELECT * FROM invoice WHERE date BETWEEN '$startDate' AND '$endDate' ORDER BY invono ASC";
	$no=1;
	echo "<h5>From -- $startDate to -- $endDate</h5>";
	echo "<tr><th>No.</th><th>Invoice No</th><th>Date</th><th>Amount</th></tr>";
	$nettotal=0;
		$result = mysqli_query($con, $sql);
    		while($row = mysqli_fetch_assoc($result))
			{
				echo "<tr><td>$no</td><td>INVO".$row['invono']."</td><td>".$row['date']."</td><td align='right'>".$row['total']."</td></tr>";
				$no++;
				$nettotal= $nettotal+$row['total'];
			}
			echo "<tr><td>Net Total</td><td></td><td></td><td align='right'>".$nettotal."</td></tr>";
	}
	?>
    </table>
    <br />
    <br />
</div>
</body>
</html>
<?Php } ?>