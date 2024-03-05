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
<title>Menu</title>
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
<a href="monPurRepot.php">  Back</a>
	<br />
    <table border="0">
	<tr><td rowspan="2"><img src="images/logo.jpg" style="margin-right:5px;" /></td><td><h2 align="left" style="margin-bottom:2px;">&nbsp;</h2></td></tr>
    <tr><td><address>No 15, Ingiriya Road, Padukka.</address></td></tr>
</table> 
<hr width="849" align="left" />
    <h2>Monthly Purchase Report</h2>
    <hr width="849" align="left" />    	
    <table border="1" width="849" class="gridtable printgridtable">
    	<tr><th>No.</th><th>Purchase Order No</th><th>Supplier Name</th><th>Date</th></tr>
    <?php 
	if(isset($_POST['stDate']) && (isset($_POST['enDate'])))
	{
	$startDate = $_POST['stDate'];
	$endDate = $_POST['enDate'];
	$sql = "SELECT * FROM purchaseorder WHERE date BETWEEN '$startDate' AND '$endDate'  AND status='yes' ORDER BY poderno ASC";
	$no=1;
	echo "<h5>From -- $startDate to -- $endDate</h5>";
	$result = mysqli_query($con, $sql);
    		while($row = mysqli_fetch_assoc($result))
			{
				$sql11 = "SELECT * FROM supplier WHERE supno='".$row['supno']."'";    
								$result11 = mysqli_query($con, $sql11);
								if (mysqli_num_rows($result11) > 0) 
								{
    								while($row11 = mysqli_fetch_assoc($result11)) 
									{
										$supname=$row11['supname'];
									}
								}
				echo "<tr><td>$no</td><td>PUR".$row['poderno']."</td><td width='254'>".$supname."</td><td width='120'>".$row['date']."</td></tr>";
				echo "<tr><td colspan=4'>";
				 $sql4 = "SELECT * FROM purlist WHERE porderno='".$row['poderno']."' ";
            		$result4 = mysqli_query($con, $sql4);
            		if (mysqli_num_rows($result4) > 0) 
            		{
						echo "<table width='400' border='1' align='right' class='dottable'>";
                	while($row4 = mysqli_fetch_assoc($result4)) 
                		{
							$sql6 = "SELECT * FROM item WHERE itemno='".$row4['itemno']."'";    
								$result6 = mysqli_query($con, $sql6);
								if (mysqli_num_rows($result6) > 0) 
								{
    								while($row6 = mysqli_fetch_assoc($result6)) 
									{
										$itemname=$row6['itemname'];
									}
								}
				echo "<tr><td width='200'>".$itemname."</td><td width='80'>".$row4['receqty']."</td></tr>";
						}
						echo "</table>";
					}
					echo "</td></tr>";
					$no=$no+1;
			}
			
	}
	?>
    </table>
    <br />
    <br />
</div>
</body>
</html>
<?Php } ?>