<?php 
if(!isset($_SESSION))
{
  	session_start();
}  
if(!isset($_SESSION['sess_user'])) { header("refresh:2; url=index.php"); } 
else 
{ 
include "include/connetion.php"; 

if(isset($_POST['cus_name']))
{
	$date = $_POST['date'];
	$cus_no = $_POST['cus_name'];
	$userid = $_SESSION['sess_userid'];
	$sql = "INSERT INTO invoice(date,cusno,userid) VALUES('$date','$cus_no','$userid')";
	if (mysqli_query($con, $sql)) {
		$lastinvo_id = mysqli_insert_id($con);
    	} else { }
	if(!empty($lastinvo_id)){
	$sql = "SELECT * FROM invoice WHERE invono='$lastinvo_id'";
		$result = mysqli_query($con, $sql);
    		while($row = mysqli_fetch_assoc($result)) 
			{
				$invono = $row['invono'];
				$cus_no = $row['cusno'];
			}
	}
}
if(isset($_POST['invono']) )
{
	$selinvo = $_POST['invono'];
	$sql = "SELECT * FROM invoice WHERE invono='$selinvo'";
		$result = mysqli_query($con, $sql);
    		while($row = mysqli_fetch_assoc($result)) 
			{
				$invono = $row['invono'];
				$cus_no = $row['cusno'];
			}
}
if(isset($_POST['invono']) && (isset($_POST['item_id'])) && ($_POST['qty']))
{
	$selinvo = $_POST['invono'];
	$item_id = $_POST['item_id'];
	$qty = $_POST['qty'];
	$sql = "SELECT * FROM item WHERE itemno='$item_id'";
		$result = mysqli_query($con, $sql);
    		while($row = mysqli_fetch_assoc($result)) 
			{
				$unitprice = $row['unitprice'];
				$itemname = $row['itemname']; 
				$qtyonhand = $row['qty'];
			}
	if(!empty($qtyonhand) && ($qtyonhand >=$qty))
	{
			$amount = $unitprice * $qty;
			$sql = "INSERT INTO itemlist(invono,itemno,itemname,unitprice,qty,amount) VALUES('$selinvo','$item_id','$itemname','$unitprice','$qty','$amount')";
			if (mysqli_query($con, $sql)) {
				$cus_no = $_POST['selcustomer'];
				$sql8 = "INSERT INTO buy(itemno,cusID) VALUES('$item_id','$cus_no')";
			if (mysqli_query($con, $sql8)) {}
				
					$sql = "UPDATE item SET qty=qty-".$qty." WHERE itemno='$item_id'";
						if (mysqli_query($con, $sql)) {	}	
    			} else { }
	}
	else { $msg = "Can't supply this QTY";}
}
if(isset($_POST['invono']) && (isset($_POST['soleid'])))
{
	$soleitem = $_POST['soleid'];
	$selqty = $_POST['selqty'];
	$selitemno = $_POST['selitemno'];
	$sql = "DELETE FROM itemlist WHERE soleno='$soleitem'";
	if (mysqli_query($con, $sql)) {	}
	
	$sql = "UPDATE item SET qty=qty+".$selqty." WHERE itemno='$selitemno'";
	if (mysqli_query($con, $sql)) {	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>
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
.gridtable tr:hover {
	background-color:#f5f5f5;
}
.currency {
	text-align:right !important;
	font-family:"Courier New", Courier, monospace;
}
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
<script>
function checkInv()
{
	var cus_name = document.forms["addinvo"]["cus_name"].value;
	if(cus_name=="" || cus_name==-1)
	{
		alert("Select Customer Name.");
		return false;
	}
	else
	{
		return true;
	}
}
function checkItem()
{
	var item_id = document.forms["addsoit"]["item_id"].value;
	var qty = document.forms["addsoit"]["qty"].value;
	if(item_id=="" || item_id==-1)
	{
		alert("Select Item Name.");
		return false;
	}
	else if(qty=="" || qty==null)
	{
		alert("Enter QTY.");
		return false;
	}
	else
	{
		return true;
	}
}
</script>
</head>

<body><div class="topnav">
  <a href="customer1.php">Customer</a>
  <a href="supplier1.php">Supplier</a>
  <a href="itemDetails1.php">Item Details</a> 
  <a href="purcorder.php">Purchase Order</a>
  <a href="goodrn.php">GRN</a>
  <a class="active" href="invoice.php">Invoice</a>
  <a href="monSalRepot.php">Reports</a>
  <a class="logout" href="logout.php">Logout</a>
  </div>
<div class="imgcontainer">
<table border="0">
	<tr><td rowspan="2"><img src="images/logo.jpg" style="margin-right:5px;" /></td><td><h2 align="left" style="margin-bottom:2px;"><b><i>SD Computers</i></b></h2></td></tr>
    <tr><td><address>No 15, Ingiriya Road, Padukka.</address></td></tr>
</table> 
<hr width="849" align="left" />
	<h2><strong>Invoice</strong></h2>
	<br />
    <form method="post" action="invoice.php" onSubmit="return checkInv();" name="addinvo">
        <table border="0" cellpadding="15">
    	<tr>
        	<td>Date</td><td><input type="text" name="date" id="date" value="<?Php echo date('Y-m-d');?>" /></td>
            <td>&nbsp;</td><td>&nbsp;</td>
      	</tr>
        <tr>
        	<td>Customer</td><td><select name="cus_name" id="cus_name">
        <option value="-1"> -- select Customer -- </option> 
        <?php $sql = "SELECT * FROM customer";
		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) > 0) 
		{
    		while($row = mysqli_fetch_assoc($result)) 
			{
				if(!empty($cus_no) && ($cus_no == $row['cusID']))
				{
				echo "<option value='".$row['cusID']."' selected='selected'> ".$row['fname']."  ".$row['lname']." </option>";
				}
				else 
				{
				echo "<option value='".$row['cusID']."'> ".$row['fname']."  ".$row['lname']." </option>";
				}
			}
		}
		?>
        </select></td>
            <td>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr><td>&nbsp;</td><td><input type="submit" class="saveBtn" value="Create" <?php if(!empty($invono)){echo "disabled='disabled'";}?>/></td><td>&nbsp;</td><td>&nbsp;</td>
        </tr>
 	</table>
    </form>
    <?php if(!empty($invono)) { ?>
    <form method="post" action="invoice.php" onSubmit="return checkItem();" name="addsoit">
    <?php if(!empty($msg)){echo "<span style='color:#F00;'>".$msg."</span>";}?>
    <table border="0" cellpadding="15">
    <tr>
    	<td>Invoice No</td><td><input type="hidden" name="selcustomer" id="selcustomer" value="<?php if(!empty($cus_no)){echo $cus_no; }?>" /><input type="hidden" name="invono" id="invono" value="<?php echo $invono; ?>" />INVO<?php echo $invono; ?></td><td>&nbsp;</td><td>&nbsp;</td>
    </tr>
        <tr>
        	<td>Item</td><td><select name="item_id" id="item_id">
        <option value="-1"> -- select Item -- </option> 
        <?php $sql = "SELECT * FROM item";
		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) > 0) 
		{
    		while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<option value='".$row['itemno']."'> ".$row['itemname']." - ".$row['unitprice']." </option>";
			}
		}
		?>
        </select></td>
            <td>QTY</td><td><input type="text" name="qty" id="qty" />&nbsp;&nbsp;<input type="submit" value="Add" class="saveBtn" /> &nbsp;</td>
        </tr>
	</table>
    </form>
    <br />
    <form action="printinvoice.php" method="post">
    	<input type="hidden" name="compInvo" value="<?php if(!empty($invono)){echo $invono; }?>" /><input type="submit" value="Print" class="printBtn" />
    </form>
    <br /> 
    <table border="1" width="849" class="gridtable">
    	<tr><th>No. of Items</th><th>Item</th><th>Unit Price</th><th>Qty</th><th>Amount</th><th></th></tr>
    <?php $sql = "SELECT * FROM itemlist WHERE invono='$invono'";
		$result = mysqli_query($con, $sql);
		$no=1;
		$grantotal =0;
    		while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<tr><td>".$no."</td><td>".$row['itemname']."</td>
				<td class='currency'>".$row['unitprice']."</td><td>".$row['qty']."</td><td class='currency'>".$row['amount']."</td><td><form method='post' action='invoice.php'><input type='hidden' name='invono' value='".$invono."'><input type='hidden' name='soleid' value='".$row['soleno']."'><input type='hidden' name='selqty' value=".$row['qty']."><input type='hidden' name='selitemno' value='".$row['itemno']."'><input type='submit' value='Delete' class='clearBtn'></td></tr>";
				$no++;
				$grantotal += $row['amount'];
			}
			echo "<tr><td colspan='4'><b>Total </b></td><td class='currency'>".$grantotal."</td><td></td></tr>";
			
			$sql = "UPDATE invoice SET total=".$grantotal." WHERE invono='$invono'";
				if (mysqli_query($con, $sql)) {	}	



	?>
    </table>
    <?php } ?>
</div>
</body>
</html>
<?Php } ?>