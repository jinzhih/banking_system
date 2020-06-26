<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/accountlayout.css"> 
	<script src="jquery-3.1.1.min.js">
	</script>
	<script>
        function logout(){
	alert("<?php echo'You are logging out your account!';
	echo date('Y-m-d H:i:s',time()); 
	echo $account_id;
	// $Createuseraction="INSERT INTO `USER_ACTIONS`(`USER_ID`,  `ACTION`) VALUES ('$session_id','logout')";
	// $mysqli->query($Createuseraction);
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
	<a href="index.html" id="homepage" >Homepage</a><a href="saving_transfer.php" id="back" >Back</a> <a href="transaction.php" id="xx3" >Transactions</a> <a href="#" id="xx4" >eStatements</a>  <a href="#" id="xx6" >Manage</a> <a href="#" id="xx7" >Message</a>
	</div> 
	
	<div id="tool">
	<a href="index.html" onclick="logout()"id="logoutbutton" >Logout</a> 
	</div>
</div>
<!-- Create the middle section-->
<div id="section">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="list_required">
					
						
	
							


							<select name="estatement">
					
							<option value="one_month" >one month</option>
							<option value="three_month">three_month</option>
							<option value="six_month">six_month</option>
						
						    </select>
				
</div>
                           <input class="submit"  onclick="message()"id="submit" type="submit" value="submit"/>
</form>
	
<script>
		        function message(){
							alert("You will be charged for appling estatement!")
		     
						} 
		</script>
<?php
// if ($_SERVER["REQUEST_METHOD"] == "GET"){
// 	$bQuery = $_GET["one_month"];
// 	$query="select  * from TRANSACTION_FLOWS where (`FLOW_TIME` BETWEEN date_add(now(),interval -1 month) AND now());";
// 	$result = $mysqli->query($query);
// 	if ($result){
// 		echo "<table>
// 		<tr>
// 		<th>ID</th>
// 		<th>Author</th>
// 		<th>Title</th>
// 		<th>Type</th>
// 		<th>Year</th>
// 		</tr>";
// 		while($rows=mysqli_fetch_array($result))
	
// 		}
// 		echo"</table>";
	   
// 	}else{
// 		echo ("Registration failed");
// 	}
// 	$mysqli_free_result($result);
// 	$mysqli->close();
// 	}

	//keep the status in server side
    	include("session.php");
	//Check connection
		include("db_conn.php");
	
		$select = $_POST['estatement']; 
	//	echo $select;

		if($select==one_month){
			$TRANSACTION_CODE=random_int(10000,99999);
			$query1 = "SELECT * FROM `bankaccounts` WHERE (`ID`='$session_id')";
			$result1 = $mysqli->query($query1);
			$rows1=mysqli_fetch_array($result1);
			
			  
				echo "<div>
				<h2>Account details</h2>
					</div>";
		
				echo "<table  id='accounts'>
				
			
				<tr>
				<th>username</th>
			
			<th>mobile</th>
			
			<th>DOB</th>
					</tr>";
			
				?>
						<tr>
								<td><?php echo $rows1['username'];?></td>
								<td><?php echo $rows1['mobile'];?></td>
								<td><?php echo $rows1['DOB'];?></td>
						</tr><?php
		
				
				echo"</table>";	
		
		
		$query2 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
			
			$result2 = $mysqli->query($query2);
			$rows2=mysqli_fetch_array($result2);
			$from_BSB = $rows2['BSB'];
      $from_accountnumber = $rows2['ACCOUNT_NUMBER'];
		//	$query3 = "SELECT * FROM `TRANSACTION_FLOWS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
		$query3="select  * from TRANSACTION_FLOWS where (`FLOW_TIME` BETWEEN date_add(now(),interval -1 month) AND now()) AND (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";	
			$result3 = $mysqli->query($query3);

			$Createtransaction="INSERT INTO `TRANSACTION_RECORDS`(`TRANSACTION_CODE`,  `FROM_BSB`, `FROM_ACCOUNT_NUMBER`, `TRANSACTION_TYPE`, `TRANSACTION_AMOUNT`, `CURRENCY`, `CONFIRM`) VALUES ('$TRANSACTION_CODE','$from_BSB','$from_accountnumber','estatement fee','2.5','AUD','1')";
			$mysqli->query($Createtransaction);
			$Createtransaction1="INSERT INTO `TRANSACTION_FLOWS`( `DEBIT_AMOUNT`, `FLOW_TYPE`,  `PURPOSE`,`CURRENCY`, `TRANSACTION_CODE`, `USER_ID`, `ACCOUNT_TYPE`) VALUES ('2.5','estatement fee','estatement','AUD','$TRANSACTION_CODE','$session_id','2')";
			$mysqli->query($Createtransaction1);
			$Frombalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`-'2.5' WHERE (`BSB`='$from_BSB')AND(`ACCOUNT_NUMBER`='$from_accountnumber')";
			$resultfrom=$mysqli->query($Frombalance);
		
				echo "<div>
				<h2>Transactions</h2>
					</div>";
	
				echo "<table id='accounts'>
			
				<tr>
				<th>Date</th>
				<th>From BSB</th>
				<th>From account</th>
				<th>To BSB</th>
			<th>To Account number</th>
			<th>Debit</th>
			<th>Credit</th>
			<th>Currency</th>
			<th>Purpose</th>
			<th>Transaction ID</th>
					</tr>";
				while($rows3=mysqli_fetch_array($result3))
				{?>
						<tr>
								<td><?php echo $rows3['FLOW_TIME'];?></td>
								<td><?php echo $rows2['BSB'];?></td>
								<td><?php echo $rows2['ACCOUNT_NUMBER'];?></td>
								<td><?php echo $rows3['BSB'];?></td> 
								<td><?php echo $rows3['ACCOUNT_NUMBER'];?></td> 
								<td><?php echo $rows3['DEBIT_AMOUNT'];?></td> 
								<td><?php echo $rows3['CREDIT_AMOUNT'];?></td>
								<td><?php echo $rows3['CURRENCY'];?></td> 
								<td><?php echo $rows3['PURPOSE'];?></td> 
								<td><?php echo $rows3['TRANSACTION_CODE'];?></td> 
						</tr><?php
		
				}
				echo"</table>";	
			
		}
		
		if($select==three_month){
			$TRANSACTION_CODE=random_int(10000,99999);
			$query1 = "SELECT * FROM `bankaccounts` WHERE (`ID`='$session_id')";
			$result1 = $mysqli->query($query1);
			$rows1=mysqli_fetch_array($result1);
			
			  
				echo "<div>
				<h2>Account details</h2>
					</div>";
		
				echo "<table  id='accounts'>
				
			
				<tr>
				<th>username</th>
			
			<th>mobile</th>
			
			<th>DOB</th>
					</tr>";
			
				?>
						<tr>
								<td><?php echo $rows1['username'];?></td>
								<td><?php echo $rows1['mobile'];?></td>
								<td><?php echo $rows1['DOB'];?></td>
						</tr><?php
		
				
				echo"</table>";	
		
		
		$query2 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
			
			$result2 = $mysqli->query($query2);
			$rows2=mysqli_fetch_array($result2);
			$from_BSB = $rows2['BSB'];
      $from_accountnumber = $rows2['ACCOUNT_NUMBER'];
		//	$query3 = "SELECT * FROM `TRANSACTION_FLOWS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
		$query3="select  * from TRANSACTION_FLOWS where (`FLOW_TIME` BETWEEN date_add(now(),interval -3 month) AND now()) AND (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";	
			$result3 = $mysqli->query($query3);

			$Createtransaction="INSERT INTO `TRANSACTION_RECORDS`(`TRANSACTION_CODE`,  `FROM_BSB`, `FROM_ACCOUNT_NUMBER`, `TRANSACTION_TYPE`, `TRANSACTION_AMOUNT`, `CURRENCY`, `CONFIRM`) VALUES ('$TRANSACTION_CODE','$from_BSB','$from_accountnumber','estatement fee','5','AUD','1')";
			$mysqli->query($Createtransaction);
			$Createtransaction1="INSERT INTO `TRANSACTION_FLOWS`( `DEBIT_AMOUNT`, `FLOW_TYPE`,  `PURPOSE`,`CURRENCY`, `TRANSACTION_CODE`, `USER_ID`, `ACCOUNT_TYPE`) VALUES ('5','estatement fee','estatement','AUD','$TRANSACTION_CODE','$session_id','2')";
			$mysqli->query($Createtransaction1);
			$Frombalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`-'5' WHERE (`BSB`='$from_BSB')AND(`ACCOUNT_NUMBER`='$from_accountnumber')";
			$resultfrom=$mysqli->query($Frombalance);
		
				echo "<div>
				<h2>Transactions</h2>
					</div>";
	
				echo "<table id='accounts'>
			
				<tr>
				<th>Date</th>
				<th>From BSB</th>
				<th>From account</th>
				<th>To BSB</th>
			<th>To Account number</th>
			<th>Debit</th>
			<th>Credit</th>
			<th>Currency</th>
			<th>Purpose</th>
			<th>Transaction ID</th>
					</tr>";
				while($rows3=mysqli_fetch_array($result3))
				{?>
						<tr>
								<td><?php echo $rows3['FLOW_TIME'];?></td>
								<td><?php echo $rows2['BSB'];?></td>
								<td><?php echo $rows2['ACCOUNT_NUMBER'];?></td>
								<td><?php echo $rows3['BSB'];?></td> 
								<td><?php echo $rows3['ACCOUNT_NUMBER'];?></td> 
								<td><?php echo $rows3['DEBIT_AMOUNT'];?></td> 
								<td><?php echo $rows3['CREDIT_AMOUNT'];?></td>
								<td><?php echo $rows3['CURRENCY'];?></td> 
								<td><?php echo $rows3['PURPOSE'];?></td> 
								<td><?php echo $rows3['TRANSACTION_CODE'];?></td> 
						</tr><?php
		
				}
				echo"</table>";	
			
		}
		if($select==six_month){
			$TRANSACTION_CODE=random_int(10000,99999);
			$query1 = "SELECT * FROM `bankaccounts` WHERE (`ID`='$session_id')";
			$result1 = $mysqli->query($query1);
			$rows1=mysqli_fetch_array($result1);
			
			  
				echo "<div>
				<h2>Account details</h2>
					</div>";
		
				echo "<table  id='accounts'>
				
			
				<tr>
				<th>username</th>
			
			<th>mobile</th>
			
			<th>DOB</th>
					</tr>";
			
				?>
						<tr>
								<td><?php echo $rows1['username'];?></td>
								<td><?php echo $rows1['mobile'];?></td>
								<td><?php echo $rows1['DOB'];?></td>
						</tr><?php
		
				
				echo"</table>";	
		
		
		$query2 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
			
			$result2 = $mysqli->query($query2);
			$rows2=mysqli_fetch_array($result2);
			$from_BSB = $rows2['BSB'];
      $from_accountnumber = $rows2['ACCOUNT_NUMBER'];
		//	$query3 = "SELECT * FROM `TRANSACTION_FLOWS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
		$query3="select  * from TRANSACTION_FLOWS where (`FLOW_TIME` BETWEEN date_add(now(),interval -6 month) AND now()) AND (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";	
			$result3 = $mysqli->query($query3);

			$Createtransaction="INSERT INTO `TRANSACTION_RECORDS`(`TRANSACTION_CODE`,  `FROM_BSB`, `FROM_ACCOUNT_NUMBER`, `TRANSACTION_TYPE`, `TRANSACTION_AMOUNT`, `CURRENCY`, `CONFIRM`) VALUES ('$TRANSACTION_CODE','$from_BSB','$from_accountnumber','estatement fee','7','AUD','1')";
			$mysqli->query($Createtransaction);
			$Createtransaction1="INSERT INTO `TRANSACTION_FLOWS`( `DEBIT_AMOUNT`, `FLOW_TYPE`,  `PURPOSE`,`CURRENCY`, `TRANSACTION_CODE`, `USER_ID`, `ACCOUNT_TYPE`) VALUES ('7','estatement fee','estatement','AUD','$TRANSACTION_CODE','$session_id','2')";
			$mysqli->query($Createtransaction1);
			$Frombalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`-'7' WHERE (`BSB`='$from_BSB')AND(`ACCOUNT_NUMBER`='$from_accountnumber')";
			$resultfrom=$mysqli->query($Frombalance);
		
				echo "<div>
				<h2>Transactions</h2>
					</div>";
	
				echo "<table id='accounts'>
			
				<tr>
				<th>Date</th>
				<th>From BSB</th>
				<th>From account</th>
				<th>To BSB</th>
			<th>To Account number</th>
			<th>Debit</th>
			<th>Credit</th>
			<th>Currency</th>
			<th>Purpose</th>
			<th>Transaction ID</th>
					</tr>";
				while($rows3=mysqli_fetch_array($result3))
				{?>
						<tr>
								<td><?php echo $rows3['FLOW_TIME'];?></td>
								<td><?php echo $rows2['BSB'];?></td>
								<td><?php echo $rows2['ACCOUNT_NUMBER'];?></td>
								<td><?php echo $rows3['BSB'];?></td> 
								<td><?php echo $rows3['ACCOUNT_NUMBER'];?></td> 
								<td><?php echo $rows3['DEBIT_AMOUNT'];?></td> 
								<td><?php echo $rows3['CREDIT_AMOUNT'];?></td>
								<td><?php echo $rows3['CURRENCY'];?></td> 
								<td><?php echo $rows3['PURPOSE'];?></td> 
								<td><?php echo $rows3['TRANSACTION_CODE'];?></td> 
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