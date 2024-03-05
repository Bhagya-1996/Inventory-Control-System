<?php
$con =mysqli_connect('localhost','root','');

	if(!$con)
	{
		echo 'Not connected to server';
	}

	if(!mysqli_select_db($con,'sdcomputers3'))
	{
		 echo 'Database not Selected';
	}
?>