<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/managerlayout.css"> 
	<script src="jquery-3.1.1.min.js">
	</script>
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
	
	<div id="title">Manager page</div>
	
	<div id="menu">
	<a href="index.html" id="homepage" >Homepage</a><a href="manager.php" id="back" >Back</a>  <a href="confirm_transaction.php" id="xx4" >Confirm Transaction</a>  <a href="addaccount.php" id="xx6" >Add Account</a> 
	</div> 
	
	<div id="tool">
	<a href="signout.php" onclick="logout()"id="logoutbutton" >Logout</a>
	</div>
</div>
<!-- Create the middle section-->
<div id="section">
<!--  -->

<?php


	//keep the status in server side
    	include("session.php");
	//Check connection
		include("db_conn.php");
		if($session_user==""||$session_access!=1)
		{
				echo"<script>alert('You do not have access to this page!');</script>";
				echo"<meta http-equiv='Refresh' content='0;URL=index.html'>";
		}
		$query = "SELECT * FROM `bankaccounts` WHERE (`username`='$session_user')";
	$result = $mysqli->query($query);
		$rows=mysqli_fetch_array($result);
		$USER_access =$rows['access'];
	 
       echo "<form method='post' action='manager_transaction.php'>

							<select name='manager_transaction'>
						    <option value=''>Choose period</option>
							<option value='one_day'>one day</option>
							<option value='one_week'>one week</option>
							<option value='one_month'>one month</option>
						    <option value='three_month'>last three months</option>
						    </select>
				

                           <input class='submit' type='submit' name='submit' value='submit'/>
</form>" ;
$select = $_POST['manager_transaction']; 
		if($select==one_day){
			
			
		 		?>
		 				<?php
		
				
		
		$query3="select  * from TRANSACTION_RECORDS where (`TRANSACTION_TIME` BETWEEN date_add(now(),interval -1 day) AND now()) AND (`CONFIRM`='1')";	
			$result3 = $mysqli->query($query3);
				echo "<div>
				<h2>Transactions</h2>
					</div>";
	
				echo "<table id='accounts'>
			
				<tr>
                <th>Transaction Code</th>
			    <th>Transaction Time</th>
			    <th>FROM_BSB</th>
			    <th>FROM_ACCOUNT_NUMBER</th>
                <th>TO_BANK</th>
                <th>TO_BSB</th>
                <th>TO_ACCOUNT_NUMBER</th>
                <th>TRANSACTION_AMOUNT</th>
                <th>CURRENCY</th>
                <th>Type</th>
					</tr>";
				while($rows3=mysqli_fetch_array($result3))
				{?>
						<tr>
								<td><?php echo $rows3['TRANSACTION_CODE'];?></td>
								<td><?php echo $rows3['TRANSACTION_TIME'];?></td>
								<td><?php echo $rows3['FROM_BSB'];?></td>
								<td><?php echo $rows3['FROM_ACCOUNT_NUMBER'];?></td> 
								<td><?php echo $rows3['TO_BANK'];?></td> 
								<td><?php echo $rows3['TO_BSB'];?></td> 
								<td><?php echo $rows3['TO_ACCOUNT_NUMBER'];?></td>
								<td><?php echo $rows3['TRANSACTION_AMOUNT'];?></td> 
								<td><?php echo $rows3['CURRENCY'];?></td> 
								<td><?php echo $rows3['TRANSACTION_TYPE'];?></td> 
						</tr><?php
		
				}
				echo"</table>";	
			
        }
        if($select==one_week){
			
			
		 		?>
						<?php
		
				
		
		$query3="select  * from TRANSACTION_RECORDS where (`TRANSACTION_TIME` BETWEEN date_add(now(),interval -1 week) AND now()) AND (`CONFIRM`='1')";	
			$result3 = $mysqli->query($query3);
				echo "<div>
				<h2>Transactions</h2>
					</div>";
	
				echo "<table id='accounts'>
			
				<tr>
                <th>Transaction Code</th>
			    <th>Transaction Time</th>
			    <th>FROM_BSB</th>
			    <th>FROM_ACCOUNT_NUMBER</th>
                <th>TO_BANK</th>
                <th>TO_BSB</th>
                <th>TO_ACCOUNT_NUMBER</th>
                <th>TRANSACTION_AMOUNT</th>
                <th>CURRENCY</th>
                <th>Type</th>
					</tr>";
				while($rows3=mysqli_fetch_array($result3))
				{?>
						<tr>
								<td><?php echo $rows3['TRANSACTION_CODE'];?></td>
								<td><?php echo $rows3['TRANSACTION_TIME'];?></td>
								<td><?php echo $rows3['FROM_BSB'];?></td>
								<td><?php echo $rows3['FROM_ACCOUNT_NUMBER'];?></td> 
								<td><?php echo $rows3['TO_BANK'];?></td> 
								<td><?php echo $rows3['TO_BSB'];?></td> 
								<td><?php echo $rows3['TO_ACCOUNT_NUMBER'];?></td>
								<td><?php echo $rows3['TRANSACTION_AMOUNT'];?></td> 
								<td><?php echo $rows3['CURRENCY'];?></td> 
								<td><?php echo $rows3['TRANSACTION_TYPE'];?></td> 
						</tr><?php
		
				}
				echo"</table>";	
			
        }
        if($select==one_month){
			
			
		 		?>
					<?php
		
				
		
		$query3="select  * from TRANSACTION_RECORDS where (`TRANSACTION_TIME` BETWEEN date_add(now(),interval -1 month) AND now()) AND (`CONFIRM`='1')";	
			$result3 = $mysqli->query($query3);
				echo "<div>
				<h2>Transactions</h2>
					</div>";
	
				echo "<table id='accounts'>
			
				<tr>
                <th>Transaction Code</th>
			    <th>Transaction Time</th>
			    <th>FROM_BSB</th>
			    <th>FROM_ACCOUNT_NUMBER</th>
                <th>TO_BANK</th>
                <th>TO_BSB</th>
                <th>TO_ACCOUNT_NUMBER</th>
                <th>TRANSACTION_AMOUNT</th>
                <th>CURRENCY</th>
                <th>Type</th>
					</tr>";
				while($rows3=mysqli_fetch_array($result3))
				{?>
						<tr>
								<td><?php echo $rows3['TRANSACTION_CODE'];?></td>
								<td><?php echo $rows3['TRANSACTION_TIME'];?></td>
								<td><?php echo $rows3['FROM_BSB'];?></td>
								<td><?php echo $rows3['FROM_ACCOUNT_NUMBER'];?></td> 
								<td><?php echo $rows3['TO_BANK'];?></td> 
								<td><?php echo $rows3['TO_BSB'];?></td> 
								<td><?php echo $rows3['TO_ACCOUNT_NUMBER'];?></td>
								<td><?php echo $rows3['TRANSACTION_AMOUNT'];?></td> 
								<td><?php echo $rows3['CURRENCY'];?></td> 
								<td><?php echo $rows3['TRANSACTION_TYPE'];?></td> 
						</tr><?php
		
				}
				echo"</table>";	
			
		}
        if($select==three_month){
		
	
			
		 		?>
					<?php
		
				
		
		$query3="select  * from TRANSACTION_RECORDS where (`TRANSACTION_TIME` BETWEEN date_add(now(),interval -3 month) AND now()) AND (`CONFIRM`='1')";	
			$result3 = $mysqli->query($query3);
				echo "<div>
				<h2>Transactions</h2>
					</div>";
	
				echo "<table id='accounts'>
			
				<tr>
                <th>Transaction Code</th>
			    <th>Transaction Time</th>
			    <th>FROM_BSB</th>
			    <th>FROM_ACCOUNT_NUMBER</th>
                <th>TO_BANK</th>
                <th>TO_BSB</th>
                <th>TO_ACCOUNT_NUMBER</th>
                <th>TRANSACTION_AMOUNT</th>
                <th>CURRENCY</th>
                <th>Type</th>
					</tr>";
				while($rows3=mysqli_fetch_array($result3))
				{?>
						<tr>
								<td><?php echo $rows3['TRANSACTION_CODE'];?></td>
								<td><?php echo $rows3['TRANSACTION_TIME'];?></td>
								<td><?php echo $rows3['FROM_BSB'];?></td>
								<td><?php echo $rows3['FROM_ACCOUNT_NUMBER'];?></td> 
								<td><?php echo $rows3['TO_BANK'];?></td> 
								<td><?php echo $rows3['TO_BSB'];?></td> 
								<td><?php echo $rows3['TO_ACCOUNT_NUMBER'];?></td>
								<td><?php echo $rows3['TRANSACTION_AMOUNT'];?></td> 
								<td><?php echo $rows3['CURRENCY'];?></td> 
								<td><?php echo $rows3['TRANSACTION_TYPE'];?></td> 
						</tr><?php
		
				}
				echo"</table>";	
			
		}


?>		

	
</div>
<!-- Create the food-->
<div id="footer">Jinzhi hou 518845</div>

</body>
</html>