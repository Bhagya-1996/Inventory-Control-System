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
<?php 
if(!isset($_SESSION))
{
  	session_start();
}   
if(!isset($_SESSION['sess_user'])) { header("refresh:2; url=index.php"); } 
else 
{ 
include "include/connetion.php"; 

if(isset($_POST['printgrn']))
{
	$printgrn = $_POST['printgrn'];	
	$sql = "SELECT * FROM purchaseorder WHERE poderno='$printgrn' ";  
		$result = mysqli_query($con, $sql);
    		while($row = mysqli_fetch_assoc($result)) 
			{
				$purno = $row['poderno'];
				$orderdate = $row['date'];
				$sql3 = "SELECT * FROM supplier WHERE supno='".$row['supno']."'";    
				$result3 = mysqli_query($con, $sql3);
					if (mysqli_num_rows($result3) > 0) 
					{
    					while($row3 = mysqli_fetch_assoc($result3)) 
						{
						$supname=$row3['supname'];
						}
					}
			}
	$sql2 = "SELECT * FROM grn WHERE purno='$printgrn' ";  
		$result2 = mysqli_query($con, $sql2);
    		while($row2 = mysqli_fetch_assoc($result2)) 
			{
				$grnno = $row2['grnno'];
				$redate = $row2['date'];
			}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Menu</title>
</head>

<body>
<div class="imgcontainer">
<a href="goodrn.php">  Back</a>
<br />
<table border="0">
	<tr><td rowspan="2"><img src="images/logo.jpg" style="margin-right:5px;" /></td><td><h2 align="left" style="margin-bottom:2px;"><b><i>SD Computers</i></b></h2></td></tr>
    <tr><td><address>No 15, Ingiriya Road, Padukka.</address></td></tr>
</table> 
<hr width="849" align="left" />
	<h2><strong>Good Received Note</strong></h2>
    <br /> 
    
	<table width="800" border="1" cellpadding="5px" class="dottable">
    	<tr><td>Order No</td><td><?php if(!empty($purno)){echo "PUR" .$purno;}?></td><td>GRN No</td><td><?php if(!empty($grnno)){echo "GRN" . $grnno;} ?></td></tr>
		<tr><td>Order date</td><td><?php if(!empty($orderdate)){echo $orderdate;}?></td><td>Received Date</td><td><?Php if(!empty($redate)) {echo $redate; }?></td></tr>
		<tr><td>Supplier Name </td><td><?php if(!empty($supname)){echo $supname; }?></td><td></td><td></td></tr>
        </table>
        <hr width="849" align="left" />
       <table width="800" border="1" cellpadding="5px" class="printgridtable gridtable">
		<tr><th>Item No </th><th>Order QTY</th><th>QTY without Damage</th><th>QTY with Damage</th></tr>
        <?php if(!empty($purno))
		{
		$sql4 = "SELECT * FROM purlist WHERE porderno='$purno' ";
        $result4 = mysqli_query($con, $sql4);
        if (mysqli_num_rows($result4) > 0) 
        {
          	while($row4 = mysqli_fetch_assoc($result4)) 
            {
			echo "<tr><td>".$row4['itemno']."</td><td>".$row4['order_qty']."</td><td>".$row4['receqty']."</td><td>".$row4['damageqty']."</td></tr>";		
			}
		}
		}
		?>
        </table> 

</div>
</body>
</html>
<?Php } ?>