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
	
	<div id="title">Manager page</div>
	
	<div id="menu">
	<a href="index.html" id="homepage" >Homepage</a><a href="manager.php" id="back" >Back</a> <a href="manager_transaction.php" id="xx3" >Transactions</a>   <a href="addaccount.php" id="xx6" >Add Account</a> 
	</div> 
	
	<div id="tool">
	<a href="signout.php" onclick="logout()"id="logoutbutton" >Logout</a>
	</div>
</div>
<!-- Create the middle section-->
<div id="section">

	

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
		if($session_user==""||$session_access!=1)
		{
				echo"<script>alert('You do not have access to this page!');</script>";
				echo"<meta http-equiv='Refresh' content='0;URL=index.html'>";
		}
	
		$select = $_POST['manager_transaction']; 
	//	echo $select;
		
			// $query1 = "SELECT * FROM `TRANSACTION_RECORDS` WHERE (`CONFIRM`='1')";
			// $result1 = $mysqli->query($query1);
			// $rows1=mysqli_fetch_array($result1);
			//	echo" <form action='./saving_transfer.php' name='savingtransfer' method='POST'>
			//	<input type='hidden' name='id' value='$account_id'>
			//	<input type='submit' name='transfer' value='Transfer'>
			//	</form>";
			  
		// 		echo "<div>
		// 		<h2>Transactino history</h2>
		// 			</div>";
		
		// 		echo "<table  id='accounts'>
				
			
		// 		<tr>
		// 		<th>Transaction Code</th>
		// 	    <th>Transaction Time</th>
		// 	    <th>FROM_BSB</th>
		// 	    <th>FROM_ACCOUNT_NUMBER</th>
        //         <th>TO_BANK</th>
        //         <th>TO_BSB</th>
        //         <th>TO_ACCOUNT_NUMBER</th>
        //         <th>TRANSACTION_AMOUNT</th>
        //         <th>CURRENCY</th>
		// 			</tr>";
			
		// 		?>
		 				<?php
		
				
		// 		echo"</table>";	
		
		
		// $query2 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
			
		// 	$result2 = $mysqli->query($query2);
		// 	$rows2=mysqli_fetch_array($result2);
			
		//	$query3 = "SELECT * FROM `TRANSACTION_FLOWS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
		if($session_access==1){
		$query3="select  * from TRANSACTION_RECORDS where  (`CONFIRM`='0')";	
			$result3 = $mysqli->query($query3);
				echo "<div>
				<h2>Pending Transactions</h2>
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
                	<?php
			     	$id=$rows3['ID'];
					$fromBSB=$rows3['FROM_BSB'];
					$fromaccount=$rows3['FROM_ACCOUNT_NUMBER'];
		            ?>
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
                        </tr>
                        <tr>
   <!-- the below form is for the editing and deleting comments-->
	 
      <td id="function" colspan="4">
		<form action="after_manager_tran.php" name="aftermanagertran" method="POST">
		
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="hidden" name="fromBSB" value="<?php echo $fromBSB;?>">
			<input type="hidden" name="fromaccount" value="<?php echo $fromaccount;?>">
			<input type="submit" name="confirm" value="confirm">
		
		</form>
      </td>
   </tr>
                        
                        
                        
                        
                        
                        <?php
		
				}
				echo"</table>";	
			
			}
			else{
				echo"no access";
			}
        
		
	//	$rows1=mysqli_fetch_array($result1);
	//	echo $rows1['BSB'];
?>		

	
</div>
<!-- Create the food-->
<div id="footer">Jinzhi hou 518845</div>

</body>
</html>