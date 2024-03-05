<?php
if(!isset($_SESSION))
{
  	session_start();
}   
if(!isset($_SESSION['sess_user'])) { header("refresh:2; url=index.php"); } 
else {
	include "include/connetion.php"; 
	
	if(isset($_POST['iname']) && $_POST['updateno']<=0) // add new item
	{
		$itemname= $_POST['iname'];
		$itype= $_POST['itype'];
		$uprice= $_POST['uprice'];
		$qty= $_POST['qty'];
		$userid = $_SESSION['sess_userid'];
	
		$sql="INSERT INTO item(itemname,itemtype,unitprice,qty,userid) VALUES ('$itemname','$itype','$uprice','$qty','$userid')"; 
		 
		if(!mysqli_query($con,$sql))
		{
			header("refresh:2; url=itemDetails1.php?msg1=Try again!");
		}
		else
		{
			header("refresh:2; url=itemDetails1.php?msg=Succesfully Inserted Your Data");
		}
	}
	if(isset($_POST['updateno']) && ($_POST['updateno']>0))  // update itemdetails
	{
		$updateitem = $_POST['updateno'];
		$itemname= $_POST['iname'];
		$itype= $_POST['itype'];
		$uprice= $_POST['uprice'];
		$qty= $_POST['qty'];
		
		$sql = "UPDATE item SET itemname='".$itemname."',itemtype='".$itype."',unitprice='".$uprice."',qty='".$qty."' WHERE itemno='".$updateitem."'";
		if(!mysqli_query($con,$sql))
		{
			header("refresh:2; url=itemDetails1.php?msg1=Try again!");
		}
		else
		{
			header("refresh:2; url=itemDetails1.php?msg=Succesfully Update Item Data");
		}
	}
	if(isset($_POST['delitem']))   // delete item
	{
		$del_item = $_POST['delitem'];
		$sql = "DELETE FROM item WHERE itemno = '".$del_item."' ";
		if(mysqli_query($con,$sql))
		{
			header("refresh:2; url=itemDetails1.php?msg2=Succesfully Delete Data");
		}
		else 
		{
		    header("refresh:2; url=itemDetails1.php");
		}
	}
}
?>