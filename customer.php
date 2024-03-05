<?php
if(!isset($_SESSION))
{
  	session_start();
}   
if(!isset($_SESSION['sess_user'])) { header("refresh:2; url=index.php"); } 
else {

		include "include/connetion.php"; 
	
	if(isset($_POST['fname']) && !($_POST['updateid'])>0) // add new customer
	{
		$fname= $_POST['fname'];
		$lname= $_POST['lname'];
		$email= $_POST['email'];
		$contactno= $_POST['contactno'];
		$userid = $_SESSION['sess_userid'];
	
		$sql="INSERT INTO customer(fname,lname,email,contactno,userid) VALUES ('$fname','$lname','$email','$contactno','$userid')"; 
		 
		if(!mysqli_query($con,$sql))
		{
			header("refresh:2; url=customer1.php?msg1=Try again!");
		}
		else
		{
			header("refresh:2; url=customer1.php?msg=Succesfully Inserted Your Data");
		}
	}
	if(isset($_POST['updateid']) && ($_POST['updateid']>0))  // update customer
	{
		$updateCus = $_POST['updateid'];
		$fname= $_POST['fname'];
		$lname= $_POST['lname'];
		$email= $_POST['email'];
		$contactno= $_POST['contactno'];
		
		$sql = "UPDATE customer SET fname='".$fname."',lname='".$lname."',email='".$email."',contactno='".$contactno."' WHERE cusID='".$updateCus."'";
		if(!mysqli_query($con,$sql))
		{
			header("refresh:2; url=customer1.php?msg1=Try again!");
		}
		else
		{
			header("refresh:2; url=customer1.php?msg=Succesfully Update Customer Data");
		}
	}
	if(isset($_POST['delcus']))   // delete customer
	{
		$del_customer = $_POST['delcus'];
		$sql = "DELETE FROM customer WHERE cusID = '".$del_customer."' ";
		if(mysqli_query($con,$sql))
		{
			header("refresh:2; url=customer1.php?msg2=Succesfully Delete Data");
		}
		else 
		{
		    header("refresh:2; url=customer1.php");
		}
	}
}
?>