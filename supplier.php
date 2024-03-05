<?php
if(!isset($_SESSION))
{
  	session_start();
}   
if(!isset($_SESSION['sess_user'])) { header("refresh:2; url=index.php"); } 
else {
	include "include/connetion.php"; 

	if(isset($_POST['sname']) && $_POST['updateid']<=0) // add new supplier
  	{   
	$supname= $_POST['sname'];
	$supadd= $_POST['sadd'];
	$supemail= $_POST['semail'];
	$supcontact= $_POST['supcontactno'];
	$userid = $_SESSION['sess_userid'];
	
	$sql="INSERT INTO supplier(supname,supadd,supemail,supcontact,userid) VALUES ('$supname','$supadd','$supemail','$supcontact','$userid')"; 
		 
	if(!mysqli_query($con,$sql))
	{
		header("refresh:2; url=supplier1.php?msg1=Invalid data...Try again!");
	}
	else
	{
		header("refresh:2; url=supplier1.php?msg=Successfully Inserted Your Data");
	}
   }
   if(isset($_POST['updateid']) && ($_POST['updateid']>0))  // update supplier
   {
      	$updatesup = $_POST['updateid'];
		$supname= $_POST['sname'];
		$supadd= $_POST['sadd'];
		$supemail= $_POST['semail'];
		$supcontactno= $_POST['supcontactno'];
		
		$sql = "UPDATE supplier SET supname='".$supname."', supadd='".$supadd."',supemail='".$supemail."',supcontact='".$supcontactno."' WHERE supno='".$updatesup."'";
		if(!mysqli_query($con,$sql))
		{
			header("refresh:2; url=supplier1.php?msg1=Invalid data..Try again!");
		}
		else
		{
			header("refresh:2; url=supplier1.php?msg=Succesfully Update Supplier Data");
		}
	}
	if(isset($_POST['delsup']))   // delete supplier
	{
		$del_supplier = $_POST['delsup'];
		$sql = "DELETE FROM supplier WHERE supno = '".$del_supplier."' ";
		if(mysqli_query($con,$sql))
		{
			header("refresh:2; url=supplier1.php?msg2=Succesfully Delete Data");
		}
		else 
		{
		    header("refresh:2; url=supplier1.php");
		}
	}
   
}
?>
