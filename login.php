<?php
	include "include/connetion.php"; 

	$userid= 'userid';

	$username= $_POST['uname'];
	$password= $_POST['psw'];
			
	$sql = "SELECT * FROM login WHERE username='".$username."' AND password='".$password."'";
		$result = mysqli_query($con, $sql);

			if (mysqli_num_rows($result) > 0) 
			{
    			while($row = mysqli_fetch_assoc($result)) 
				{
					if(!isset($_SESSION))
					{
  					 	session_start();
					}  
        			 $_SESSION['sess_user']=$row["username"];
					 $_SESSION['sess_userid']=$row["userid"];
					 header("refresh:2; url=customer1.php");
    			}
			} 
			else
			{
			   header("refresh:2; url=index.php?err=Invalid User Name or Password");
			}
	mysqli_close($con);
?>