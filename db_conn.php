
<?php
//Check connections
    $mysqli = new mysqli('localhost','jinzhih','518845','jinzhih');
    if(mysqli_connect_error())
	{
		printf("Connect failed:%s\n", mysqli_connect_error());
		exit();
	}
?>