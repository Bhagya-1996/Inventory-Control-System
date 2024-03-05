<!DOCTYPE html>
<?php 
if(!isset($_SESSION))
{
  	session_start();
} 
if(!isset($_SESSION['sess_user'])) { header("refresh:2; url=index.php"); } 
else { 
include "include/connetion.php"; 

if(isset($_POST['editcus']))
{
	$det_cus_id = $_POST['editcus'];
	$sql = "SELECT * FROM customer WHERE cusID='".$det_cus_id."'";
		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) > 0) 
		{
    		while($row = mysqli_fetch_assoc($result)) 
			{
				$editFname=$row['fname'];
				$editLname=$row['lname'];
				$editEmail=$row['email'];
				$editContact=$row['contactno'];
			}
		}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head >
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
#form1 .auto-style1 {
	font-family: Cambria, Hoefler Text, Liberation Serif, Times, Times New Roman, serif;
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
function check()
{
	var fname = document.forms["addcus"]['fname'].value;
	var lname = document.forms["addcus"]['lname'].value;
	var contactno = document.forms["addcus"]['contactno'].value;
	var emailID = document.forms["addcus"]['email'].value;
    atpos = emailID.indexOf("@");
    dotpos = emailID.lastIndexOf(".");
	
	
	if(fname=="" || fname==null)
	{
		alert("Enter First Name.");
		return false;
	}
	else if(lname=="" || lname==null)
	{
		alert("Enter Last Name.");
		return false;
	}
	else if(emailID=="" || emailID==null)
	{
		alert("Enter Email Address.");
		return false;
	}
	else if (atpos < 1 || ( dotpos - atpos < 2 ))
    {
        	alert("Please enter correct Email Address")
        	return false;
    }
	else if(contactno=="" || contactno==null)
	{
		alert("Enter Contact Number.");
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
  <a class="active" href="customer1.php">Customer</a>
  <a href="supplier1.php">Supplier</a>
  <a href="itemDetails1.php">Item Details</a> 
  <a href="purcorder.php">Purchase Order</a>
  <a href="goodrn.php">GRN</a>
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
	<span class="auto-style3"><strong>Customer Details</strong></span>
    <br><br>
    	<span style="color:#33CC66;"><?php if(isset($_GET['msg'])){echo $_GET['msg'];}?></span> 
        <span style="color:#FF0000;"><?php if(isset($_GET['msg1'])){echo $_GET['msg1'];}?></span>
        <span style="color:#33CC66;"><?php if(isset($_GET['msg2'])){echo $_GET['msg2'];}?></span> 
    	<form action="customer.php" method="post" onSubmit="return check();" name="addcus">
          	<div class="col-xs-12" id=""> <input type="hidden" name="updateid" id="updateid" value="<?php if(!(empty($det_cus_id))){echo $det_cus_id; } ?>">
              	<div class="form-group">
                	<table border="0" cellpadding="15">
                    <tr><td><label for="fname" style="margin-right: 10px;">First name * </label></td>
                		<td><input type="text" name="fname" id="fname" placeholder=" First Name" value="<?php if(!(empty($editFname))){echo $editFname; } ?>"></td>
                      	<td><label for="lname" style="margin-right: 10px; margin-left:20px;">Last name * </label></td>
                    	<td><input type="text" name="lname" id="lname" placeholder=" Last Name" value="<?php if(!(empty($editLname))){echo $editLname; } ?>"></td></tr>
                    <tr><td><label for="email" style="margin-right: 10px;">Email * </label></td>
                    	<td><input type="text" name="email" id="email" placeholder="Email" value="<?php if(!(empty($editEmail))){echo $editEmail; } ?>"></td>
                        <td><label for="contactno" style="margin-right: 10px; margin-left:20px;">Contact No * </label></td>
                        <td><input type="text" maxlength="10" name="contactno" id="contactno" placeholder="Contact No" value="<?php if(!(empty($editContact))){echo $editContact; } ?>"></td></tr>
                   <tr><td>&nbsp;</td><td><input type="submit" value="Save" class="saveBtn"></td>
                   		<td><input type="reset" value="Clear" class="clearBtn"></td><td>&nbsp;</td></tr>
                   </table>            
   				</div>
   			</div>
   		</form>
        <hr>
        	<table width="849" border="1" class="gridtable">
                <tr>
                  <th width="118" scope="row"><div align="left">Customer ID</div></th>
                  <th width="169">First name</th>
                  <th width="195">Last name</th>
                  <th width="201">Email address</th>
                  <th width="132">Contact no</th>
                  <th></th><th></th>
                </tr>
                <?php 
					$sql = "SELECT * FROM customer ORDER BY cusID ASC";
					$result = mysqli_query($con, $sql);
						if (mysqli_num_rows($result) > 0) 
						{
    						while($row = mysqli_fetch_assoc($result)) 
							{
								echo "<tr><td>CUS".$row['cusID']."</td><td>".$row['fname']."</td><td>".$row['lname']."</td><td>".$row['email']."</td><td>".$row['contactno']."</td>
								<td><form action='customer1.php' method='post'>
									<input type='hidden' name='editcus' value='".$row['cusID']."'>
									<input type='submit' value='Edit' class='editBtn'></form></td>
								<td><form method='post' action='customer.php'>
									<input type='hidden' name='delcus' value='".$row['cusID']."'>
									<input type='submit' value='Delete' class='clearBtn'></form></td></tr>";
							}
						}
				?>
          	</table>
</div>
</body>
</html>
<?php } ?>