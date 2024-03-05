<?php 
if(!isset($_SESSION))
{
  	session_start();
}   
if(!isset($_SESSION['sess_user'])) { header("refresh:2; url=index.php"); } 
else 
{ 
include "include/connetion.php"; 

if(isset($_POST['seldelpoderno']))
{
 $puroderno = $_POST['seldelpoderno'];
}

if(isset($_POST['selsupno']))
{
 $supno = $_POST['selsupno'];
}

if(isset($_POST['seldelitem']))
{
	$seldelitem = $_POST['seldelitem'];
	$sql3 = "DELETE FROM purlist WHERE porderlistno='$seldelitem'";
	if (mysqli_query($con, $sql3)) { }
}
if(isset($_POST['sup_no']))
{
	$date = $_POST['date'];
	$supno = $_POST['sup_no'];
	$userid = $_SESSION['sess_userid'];
	$sql = "INSERT INTO purchaseorder(date,supno,status,userid) VALUES('$date','$supno','no','$userid')";
	if (mysqli_query($con, $sql)) {
		$puroderno = mysqli_insert_id($con);
		$msg = "Succesfully Save Data";
    	} else { }
		
	$sql2 = "INSERT INTO supply(supno,poderno) VALUES('$supno','$puroderno')";
	if (mysqli_query($con, $sql2)) {
		
    	} else { }
}
if(isset($_POST['selpoderno']))
{
	$puroderno = $_POST['selpoderno'];
	$itemno = $_POST['item_id'];
	$qty = $_POST['qty'];
	$sql = "INSERT INTO purlist(porderno,itemno,order_qty) VALUES('$puroderno','$itemno','$qty')";
	if (mysqli_query($con, $sql)) {
    	} else { }
}
if(isset($_POST['selorder']))
{
	$selorder = $_POST['selorder'];
	$sql = "DELETE FROM purchaseorder WHERE poderno='$selorder'";
	if (mysqli_query($con, $sql)) { $msg = "Succesfully Delete Data";}
	$sql2 = "DELETE FROM purlist WHERE porderno='$selorder'";
	if (mysqli_query($con, $sql2)) { }
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
function checkaddpr()
{
	var sup_no = document.forms["addpr"]['sup_no'].value;
	if(sup_no=="" || sup_no==-1)
	{
		alert("Select Supplier Name.");
		return false;
	}
	else
	{
		return true;
	}
}
function checkadditm()
{
	var item_id = document.forms["additem"]['item_id'].value;
	var qty = document.forms["additem"]['qty'].value;	
	
	if(item_id=="" || item_id==-1)
	{
		alert("Select Item Name .");
		return false;
	}
	else if(qty=="" || qty==null)
	{
		alert("Enter Quantity.");
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
  <a class="active" href="purcorder.php">Purchase Order</a>
  <a href="goodrn.php">GRN</a>
  <a href="invoice.php">Invoice</a>
  <a href="monSalRepot.php">Reports</a>
  <a class="logout" href="logout.php">Logout</a>
  </div>
<div class="imgcontainer">
<table border="0">
	<tr><td rowspan="2"><img src="images/logo.jpg" style="margin-right:5px;" /></td><td><h2 align="left" style="margin-bottom:2px;"><b><i>SD Computers</i></b></h2></td></tr>
    <tr><td><address>No 15, Ingiriya Road, Padukka.</address></td></tr>
</table> 
<hr width="849" align="left" />
	<h2><strong>Purchase Order</strong></h2>
	<br />
    <span style="color:#33CC66;"><?php if(!empty($msg)){echo $msg;}?></span> 
    <form method="post" action="purcorder.php" name="addpr" onSubmit="return checkaddpr();">
        <table border="0" cellpadding="15">
    	<tr>
        	<td>Date</td><td><input type="text" name="date" id="date" value="<?Php echo date('Y-m-d');?>" readonly="readonly"/></td>
            <td>&nbsp;</td><td>&nbsp;</td>
      	</tr>
        <tr>
        	<td>Supplier</td><td><select name="sup_no" id="sup_no">
        <option value="-1"> -- select Supplier -- </option> 
        <?php $sql = "SELECT * FROM supplier";
		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) > 0) 
		{
    		while($row = mysqli_fetch_assoc($result))  
			{
				if(!empty($supno) && $row['supno']==$supno)
				{
					echo "<option value='".$row['supno']."' selected='selected'> ".$row['supname']."</option>";
				}
				else 
				{
					echo "<option value='".$row['supno']."'> ".$row['supname']."</option>";
				}
			}
		}
		?>
        </select></td>
            <td>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr><td><input type="submit" value="Create" class="saveBtn" <?php if(!empty($puroderno) && $puroderno>0){echo "disabled='disabled'";}?>  /></td><td></td><td></td><td></td></tr>
        </table>
        </form>
	<?php if(!empty($puroderno) && $puroderno>0){?>
    <hr />
      	<table border="0" cellpadding="10" width="500" class="gridtable">
        <tr><th>Item No</th><th>QTY</th><th></th></tr>
        <?php $sql4 = "SELECT * FROM purlist WHERE porderno='$puroderno' ";
            $result4 = mysqli_query($con, $sql4);
            if (mysqli_num_rows($result4) > 0) 
            {
                while($row4 = mysqli_fetch_assoc($result4)) 
                {
                    echo "<tr><td>".$row4['itemno']."</td><td>".$row4['order_qty']."</td><td><form name='delitem' action='purcorder.php' method='post'><input type='hidden' name='seldelitem' value='".$row4['porderlistno']."'><input type='submit' value='Delete' class='clearBtn'><input type='hidden' name='seldelpoderno' id='seldelpoderno' value='".$puroderno."' /><input type='hidden' name='selsupno' id='selsupno' value='".$supno."' /></form></td><tr>";
                }
            }?>
            </table>
            <hr />
	<form name="additem" method="post" action="purcorder.php" onSubmit="return checkadditm();">
       	<input type="hidden" name="selpoderno" id="selpoderno" value="<?php if(!empty($puroderno) && $puroderno>0){echo $puroderno;} ?>" />
        <input type="hidden" name="selsupno" id="selsupno" value="<?php if(!empty($supno) && $supno>0){echo $supno;} ?>" />        
            <table border="0" cellpadding="10" width="500">
            <tr><td>Item</td><td><select name="item_id" id="item_id">
            <option value="-1"> -- select Item -- </option> 
            <?php $sql = "SELECT * FROM item";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<option value='".$row['itemno']."'> ".$row['itemname']."</option>";
                }
            }
            ?>
            </select></td>
            <td>Qty</td><td><input type="text" name="qty" id="qty" /></td>
            </tr>
            <tr><td><input type="submit" value="Add" class="saveBtn" /></td><td></td><td></td><td></td></tr>
        </table>
    </form>
	<?php } ?>
    <hr /> 
    <table border="1" width="849" class=">
    	<tr><th>No.</th><th>Date</th><th>Supplier Name</th></tr>
    <?php $sql = "SELECT * FROM purchaseorder WHERE status='no'";  
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
				<td align='right'>".$supname."</td><td><form method='post' action='purcorder.php'>
				<input type='hidden' name='selorder' value=".$row['poderno']."><input type='submit' value='Delete' class='clearBtn'></td></tr>";
				$no++;
			}
	?>
    </table>
</div>
</body>
</html>
<?Php } ?>