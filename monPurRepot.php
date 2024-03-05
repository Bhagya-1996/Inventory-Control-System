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
    </style>
<script>
function checkdate()
{
	var year = document.forms["report"]["year"].value;
	var selectmonth = document.forms["report"]["selectmonth"].value;
	if(year=="" || year==-1)
	{
		alert("Select Year.");
		return false;
	}
	else if(selectmonth=="" || selectmonth==-1)
	{
		alert("Select Month.");
		return false;
	}
	else
	{
		return true;
	}
}
</script>
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
  <a href="goodrn.php">GRN</a>
  <a href="invoice.php">Invoice</a>
  <a class="active" href="monSalRepot.php">Reports</a>
  <a class="logout" href="logout.php">Logout</a>
  </div>
<div class="imgcontainer">
<table border="0">
	<tr><td rowspan="2"><img src="images/logo.jpg" style="margin-right:5px;" /></td><td><h2 align="left" style="margin-bottom:2px;">&nbsp;</h2></td></tr>
    <tr><td><address>No 15, Ingiriya Road, Padukka.</address></td></tr>
</table> 
<hr width="849" align="left" />
	<table border="0" cellpadding="5">
    	<tr><td><h4><strong><a href="monSalRepot.php">Monthly Sales Report</a></strong></h4></td>
    	<td><h4><strong><a href="monPurRepot.php"><b>Monthly Purchase Report</b></a></strong></h4></td></tr>
    </table>
	<br />
    <span class="auto-style3"><strong>Monthly Purchase Report</strong></span>
   		<form action="monPurRepot.php" method="post" onSubmit="return checkdate();" name="report">
        <table border="0" cellpadding="15">
    	<tr>
        	<td><label>Date</label></td><td><?Php echo date('Y-m-d');?></td>
            <td><label>Year</label></td><td><select name="year">
            									<option value="-1">-- select year -- </option>
            									<option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                            </select></td>
        	<td><label>Month</label></td><td><select name="selectmonth">
            							<option value="-1"> -- Select Month -- </option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">Octomber</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                   </select></td>
      	</tr>
        <tr>
        	<td><input type="submit" value="View" class="saveBtn" /></td><td>&nbsp;</td>
            <td>&nbsp;</td><td>&nbsp;</td>
        </tr>
 	</table></form>
    <hr width="849" align="left" />
    <?php 
	if(isset($_POST['selectmonth']) && (isset($_POST['year'])))
	{
		echo "<table border='1' width='849' class='gridtable printgridtable'>
    	<tr><th>No.</th><th>Purchase Order No</th><th align='left'>Supplier Name</th><th align='left'>Date</th></tr>";
	$selectmonth = $_POST['selectmonth'];
	$startDate = $_POST['year']."-".$_POST['selectmonth']."-01";
	$endDate = $_POST['year']."-".$_POST['selectmonth']."-31";
	$sql = "SELECT * FROM purchaseorder WHERE date BETWEEN '$startDate' AND '$endDate'  AND status='yes' ORDER BY poderno ASC";
	$no=1;
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
	?>
    </table>
    <br /><form action="printmonPurRepot.php" method="post"><input type="hidden" name="stDate" id="stDate" value="<?php if(!empty($startDate)){ echo $startDate;}?>" />
    <input type="hidden" name="enDate" id="enDate" value="<?php if(!empty($endDate)){ echo $endDate;}?>" /><input type="submit" value="Print" class="printBtn" /></form>
    <?php		
	}
	?>
    
    <br />
    <br />
</div>
</body>
</html>
<?Php } ?>