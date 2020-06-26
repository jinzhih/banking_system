<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/manager.css"> 
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
	<a href="index.html" id="homepage" >Homepage</a> <a href="manager_transaction.php" id="manager_transaction" >Transactions</a> <a href="confirm_transaction.php" id="xx4" >Confirm Transaction</a>  <a href="addaccount.php" id="addaccount" >Add Account</a> 
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
		if($session_user==""||$session_access!=1)
		{
				echo"<script>alert('You do not have access to this page!');</script>";
				echo"<meta http-equiv='Refresh' content='0;URL=index.html'>";
		}
		
	//	if($_POST['id']!="")
//{
 // $_SESSION['id']=$_POST['id'];
//}
   // $account_id = $_POST['id'];
		$query = "SELECT * FROM `bankaccounts` WHERE (`username`='$session_user')";
	$result = $mysqli->query($query);
		$rows=mysqli_fetch_array($result);
		$USER_access =$rows['access'];
		$query1 = "SELECT * FROM `bankaccounts`";
		$result1 = $mysqli->query($query1);
		
		 if($USER_access==1){
        //  $query2 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
        //  $result2 = $mysqli->query($query2);
        //  $rows2=mysqli_fetch_array($result2);
		//	echo" <form action='./saving_transfer.php' name='savingtransfer' method='POST'>
		//	<input type='hidden' name='id' value='$account_id'>
		//	<input type='submit' name='transfer' value='Transfer'>
		//	</form>";
          
			// echo "<div>
			// <h2>Account management table</h2>
			// 	</div>";
	
			// echo "<table  id='accounts'>
			
		
			// <tr>
			// <th>ID</th>
			// <th>Username</th>
			// <th>Firstname</th>
      // <th>Lastname</th>
			// <th>Mobile</th>
			// <th>Email</th>
			// <th>Account type</th>
			// <th>Access</th>
			// </tr>";
		
			//
	
			
			// echo"</table>";	
	
	
		// $query2 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
    //     $result2 = $mysqli->query($query2);
    //     $rows2=mysqli_fetch_array($result2);
		
		// $query3 = "SELECT * FROM `TRANSACTION_FLOWS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
		// $result3 = $mysqli->query($query3);
			echo "<div>
			<h2>Account management table </h2>
				</div>";
		
			echo "<table id='accounts'>
		
            <tr>
    
						<th>ID</th>
						<th>Username</th>
						<th>Firstname</th>
						<th>Lastname</th>
					
						<th>Email</th>
				    <th>DOB</th>
						<th>Access</th>
						<th>Edit</th>
						<th>Delete</th>
				    </tr>";
			while($rows1=mysqli_fetch_array($result1))
			{?>
			<?php
			     	$id=$rows1['ID'];
		       if($rows1['access']=='2'){
						 $my_access='Account Holder';
					 }
					 else{
						$my_access='Bank Manager'; 
					 }
		?>
					<tr>
                            <td><?php echo $rows1['ID'];?></td>
                           
						              	<td><?php echo $rows1['username'];?></td> 
                            <td><?php echo $rows1['firstname'];?></td> 
                            <td><?php echo $rows1['lastname'];?></td> 
                            
                            <td><?php echo $rows1['email'];?></td>
						              	<td><?php echo $rows1['DOB'];?></td> 
                            <td><?php echo $my_access;?></td> 
                            
				
   <!-- the below form is for the editing and deleting comments-->
	 
      <td >
		<form action="after_manager.php" name="aftermanager" method="POST">
		<select name="chooseaccess">
	      	<option value="0" >Change Access</option>
					<option value="1" >Bank Manager</option>
					<option value="2">Accouont Holder</option>
					
						</select>
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="submit" name="edit" value="edit access"><br>
			</td>
			<td >
			<form action="after_manager.php" name="aftermanager" method="POST">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="submit" name="delete" value="delete account">
		</form>
      </td>
   </tr>
					
					
					
					
					<?php
	
			}
			echo"</table>";	
		}	
		else{
			echo"No access";
		}
	//	$rows1=mysqli_fetch_array($result1);
	//	echo $rows1['BSB'];
?>		

	
</div>
	
	

<!-- Create the food-->
<div id="footer">Jinzhi hou 518845</div>

</body>
</html>