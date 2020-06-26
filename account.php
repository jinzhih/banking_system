<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/accountlayout.css"> 
	<script src="jquery-3.1.1.min.js">
	</script>
	  <!-- js logout function -->
	 <script>
		  function logout(){
			alert("<?php echo'You are logging out your account!';
			echo date('Y-m-d H:i:s',time()); 


		   ?>")

     } 
</script>
</head>

<body>
<!-- Create the header-->
<div id="header">
	<div id="logo">
		<img src="images/logo1.png" alt="logo">
    </div>
	
	<div id="title">Account page</div>
	
	<div id="menu">
	<a href="index.html" id="homepage" >Homepage</a> 
	</div> 
	
	<div id="tool">
	<a href="signout.php" onclick="logout()"id="logoutbutton" >Logout</a>  
	</div>
</div>
<!-- Create the middle section-->
<div id="section">

	

<?php
	//keep the status in server side
	include("session.php");
	//Check connection
		include("db_conn.php");
		if($session_user==""||$session_access!=2)
    {
        echo"<script>alert('You do not have access to this page!');</script>";
        echo"<meta http-equiv='Refresh' content='0;URL=index.html'>";
    }
		
	
	//selcet 
		$query1 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='1')";
		$result1 = $mysqli->query($query1);
		
			echo "<div id='' onclick='window.open('saving_transfer.php','_self');'>
			<h2>Saving Account</h2>
				</div>";
	
			echo "<table  id='accounts'>			
			<tr>
			<th>BSB</th>
			<th>Account number</th>
			<th>Balance</th>
			</tr>";
			while($rows=mysqli_fetch_array($result1))
			{?>
					<tr>
							<td><a href="saving_transfer.php" style="display:block; width:100%; height:100%"><?php echo $rows['BSB'];?></a></td>
							<td><a href="saving_transfer.php" style="display:block; width:100%; height:100%"><?php echo $rows['ACCOUNT_NUMBER'];?></a></td>
							<td><a href="saving_transfer.php" style="display:block; width:100%; height:100%"><?php echo $rows['BALANCE'];?></a></td> 
						
					
					</tr><?php
	
			}
			echo"</table>";	
	
	
		$query2 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
		$result2 = $mysqli->query($query2);
		
			echo "<div id='' onclick='window.open('saving_transfer.php','_self');'>
			<h2>Business Account</h2>
				</div>";
			echo "<table id='accounts'>
		
			<tr>
			<th>BSB</th>
			<th>Account number</th>
			<th>Balance</th>
			</tr>";
			while($rowsb=mysqli_fetch_array($result2))
			{?>
					<tr>
					    <td><a href="business_transfer.php" style="display:block; width:100%; height:100%"><?php echo $rowsb['BSB'];?></a></td>
							<td><a href="business_transfer.php" style="display:block; width:100%; height:100%"><?php echo $rowsb['ACCOUNT_NUMBER'];?></a></td>
							<td><a href="business_transfer.php" style="display:block; width:100%; height:100%"><?php echo $rowsb['BALANCE'];?></a></td> 
						
					
					
					</tr><?php
	
			}
			echo"</table>";	
		
	
?>		

	
</div>
<!-- Create the food-->
<div id="footer">Jinzhi hou 518845</div>

</body>
</html>