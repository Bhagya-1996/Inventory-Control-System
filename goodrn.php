<?php 
if(!isset($_SESSION))
{
  	session_start();
}  
if(!isset($_SESSION['sess_user'])) { header("refresh:2; url=index.php"); } 
else 
{ 
include "include/connetion.php"; 

if(isset($_POST['receorder']))
{
	$selorderno = $_POST['receorder'];
}
if(isset($_POST['selorder']))
{
	$selorderno = $_POST['selorder'];
}

if(isset($_POST['porderlistno']))
{
	$porderlistno = $_POST['porderlistno'];
	$selorder = $_POST['selorder'];
	$reqty = $_POST['reqty'];
	$daqty = $_POST['daqty'];
	$date = date('Y-m-d');
	
	$sql8 = "UPDATE purchaseorder SET redate='$date', status='yes' WHERE poderno='$selorder'";
	if (mysqli_query($con, $sql8)) { $msg="Succesfully Update QTY";}
	$print=1;
	$sql6 = "UPDATE purlist SET receqty='$reqty',damageqty='$daqty',receivestatue='yes' WHERE porderlistno='$porderlistno'";
	if (mysqli_query($con, $sql6)){}
	
	$itemno = $_POST['itemno'];
	$sql7 = "UPDATE item SET qty = qty +'$reqty' WHERE itemno='$itemno'";
	if (mysqli_query($con, $sql7)){}
	$userid = $_SESSION['sess_userid'];
	$sql = "INSERT INTO grn(date,purno,userid) VALUES('$date','$selorder','$userid')";
	if (mysqli_query($con, $sql)) { } else { }	
}
if(!empty($selorderno) && $selorderno>0)
{	
$print=1;
	$sql = "SELECT * FROM purchaseorder WHERE poderno='$selorderno'";  
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
							$supname = $row3['supname'];
						}
					}			
			}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Menu</title>
<style type="text/css">
body {margin:0;}
.imgcontainer { 
	margin-left:30px;
	margin-right:30px;
}
.topnav {
  overflow: hidden;
  background-color: #333;
}
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.topnav a:hover {
  background-color: #ddd;
  color: black;
}
.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
.topnav a.logout {
    background-color:#FF9900;
    color: white;
}
.auto-style1 {
    color: #000000;
    font-size: x-large;
}
.auto-style2 {
    width: 182px;
}
.auto-style3 {
    font-size: x-large;
}
.container {
    width: 1250px;
}
.auto-style4 {
    width: 100%;
    border: 1px solid #333333;
    background-color: #FFFFFF;
	border-color:#636863;
}
.auto-style5 {
    width: 158px;
	border: 1px solid #333333;
    background-color: #FFFFFF;
	border-color:#636863;
}
.auto-style6 {
    width: 171px;
	border: 1px solid #333333;
    background-color: #FFFFFF;
	border-color:#636863;
}
.cancelbtn {
     width: auto;
     padding: 10px 18px;
     background-color: #f44336;
}
.submitbtn {
     width: auto;
     padding: 10px 18px;
     background-color:#606363;
}
.auto-style7 {
    width: 216px; border: 1px solid #333333;
    background-color: #FFFFFF;
	border-color:#636863;
}
.auto-style8 {
    width: 210px; border: 1px solid #333333;
    background-color: #FFFFFF;
	border-color:#636863;    
}
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
.gridtable th, .gridtable td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.gridtable tr:hover {background-color:#f5f5f5;}
.saveBtn {
	background-color:#4CAF50;
	padding: 7px 14px;
	font-size: 14px;
	color:#FFF;
	border:none;
}	
.clearBtn {
	background-color:#F00;
	padding: 7px 14px;
	font-size: 14px;
	color:#FFF;
	border:none;
}	
.editBtn {
	background-color:#008CBA;
	padding: 7px 14px;
	font-size: 14px;
	color:#FFF;
	border:none;
}	
.printBtn {
	background-color:#63C;
	padding: 7px 14px;
	font-size: 14px;
	color:#FFF;
	border:none;
}	
    </style>
</head>

<body><div class="topnav">
  <a href="customer1.php">Customer</a>
  <a href="supplier1.php">Supplier</a>
  <a href="itemDetails1.php">Item Details</a> 
  <a href="purcorder.php">Purchase Order</a>
  <a class="active" href="goodrn.php">GRN</a>
  <a href="invoice.php">Invoice</a>
  <a href="monSalRepot.php">Reports</a>
  <a class="logout" href="logout.php">Logout</a>
  </div>
<div class="imgcontainer">
<table border="0">
	<tr><td rowspan="2"><img src="images/logo.jpg" style="margin-right:5px;" /></td><td><h2 align="left" style="margin-bottom:2px;">&nbsp;</h2></td></tr>
    <tr><td><address>No 15, Ingiriya Road, Padukka.</address></td></tr>
</table> 
<hr width="849" align="left" />
	<h2><strong>Good Received Note</strong></h2>
    <span style="color:#33CC66;"><?php if(!empty($msg)){echo $msg;}?></span>
    <br /> 
    <input type="hidden" name="receorder" value="<?php if(!empty($purno)){echo $purno; } ?>" />
	<table width="800" border="0">
    	<tr><td>Order No</td><td><?php if(!empty($purno)){echo "PUR" . $purno;} ?></td><td></td><td></td></tr>
		<tr><td>Order date</td><td><?php if(!empty($orderdate)){echo $orderdate;}?></td><td>Received Date</td><td><input type="text" name="date" id="date" value="<?Php if(!empty($redate)) {echo $redate; }else { echo date('Y-m-d');}?>" readonly="readonly" /></td></tr>
		<tr><td>Supplier Name </td><td><?php if(!empty($supname)){echo $supname; }?></td><td></td><td></td></tr>
    </table>
    </form>   
    <?php
	if(!empty($purno)){
		$sql4 = "SELECT * FROM purlist WHERE porderno='$purno' ";
        $result4 = mysqli_query($con, $sql4);
        if (mysqli_num_rows($result4) > 0) 
        {
          	while($row4 = mysqli_fetch_assoc($result4)) 
            {
				$sql9 = "SELECT * FROM supplier WHERE supno='".$row4['itemno']."'";    
				$result9 = mysqli_query($con, $sql9);
					if (mysqli_num_rows($result9) > 0) 
					{
    					while($row9 = mysqli_fetch_assoc($result9)) 
						{
							$supname = $row9['supname'];
						}
					}
					
			if($row4['receivestatue']=='yes')
				{
            	echo "<form name='receitem' action='goodrn.php' method='post'>
					<table width='800' border='0' cellpadding='2'>
					<tr><td>Item</td><td>QTY</td><td>QTY without Damage</td><td>QTY with Damage</td></tr>
					<tr><td>Item".$row4['itemno']."</td><td>".$row4['order_qty']."</td><td><input type='text' size='6' name='reqty' id='reqty' value='".$row4['receqty']."'></td><td><input type='text' size='6' name='daqty' id='daqty' value='".$row4['damageqty']."'><input type='hidden' name='porderlistno' id='porderlistno' value='".$row4['porderlistno']."'><input type='submit' class='saveBtn' disabled='disabled' value='Add'><input type='hidden' name='selorder' id='selorder' value='".$purno."' /><input type='hidden' name='itemno' id='itemno' value='".$row4['itemno']."'></td><tr></table></form>";
				} else 
				{
        		echo "<form name='receitem' action='goodrn.php' method='post'>
					<table width='800' border='0' cellpadding='2'>
					<tr><td>Item</td><td>QTY</td><td>QTY without Damage</td><td>QTY with Damage</td></tr>
					<tr><td>Item".$row4['itemno']."</td><td>".$row4['order_qty']."</td><td><input type='text' size='6' name='reqty' id='reqty' value='".$row4['receqty']."'></td><td><input type='text' size='6' name='daqty' id='daqty' value='".$row4['damageqty']."'><input type='hidden' name='porderlistno' id='porderlistno' value='".$row4['porderlistno']."'><input type='submit' class='saveBtn' value='Add'><input type='hidden' name='selorder' id='selorder' value='".$purno."' /><input type='hidden' name='itemno' id='itemno' value='".$row4['itemno']."'></td><tr></table></form>";
				}
          	}
       }
	}
	?> 
     <br />
     <?php if(!empty($print) && $print==1){echo "<form method='post' action='grnprint.php'><input type='hidden' name='printgrn' value='$purno'><input type='submit' value='Print' class='printBtn'></form>";}?>
     <hr width="849" align="left" />
     <h4>Purchase Orders</h4>
    <table border="1" width="849" class="gridtable">
    	<tr><th>No.</th><th>Date</th><th>Supplier Name</th><th></th></tr>
    <?php $sql = "SELECT * FROM purchaseorder ORDER BY poderno ASC";  
		$result = mysqli_query($con, $sql);
		$no=1;
		$grantotal =0;
    		while($row = mysqli_fetch_assoc($result)) 
			{
				
				$sql3 = "SELECT * FROM supplier WHERE supno='".$row['supno']."'";    
				$result3 = mysqli_query($con, $sql3);
					if (mysqli_num_rows($result3) > 0) 
					{
    					while($row3 = mysqli_fetch_assoc($result3)) 
						{
						$supname=$row3['supname'];
						}
					}

				echo "<tr><td>".$no."</td><td>".$row['date']."</td>
				<td align='left'>".$supname."</td><td><form method='post' action='goodrn.php'>
				<input type='hidden' name='selorder' id='selorder' value=".$row['poderno']."><input type='submit' value='Select' class='editBtn'></form></td></tr>";
				$no++;
			}
	?>
    </table>
</div>
</body>
</html>
<?Php } ?>