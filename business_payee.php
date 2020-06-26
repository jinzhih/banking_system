<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/transfer.css"> 
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
	<a href="index.html" id="homepage" >Homepage</a> <a href="business_transfer.php" id="back" >Back</a><a href="business_transaction.php" id="xx3" >Transactions</a> <a href="business_estatement.php" id="xx4" >eStatements</a>  
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
	//session justify	
		if($session_user==""||$session_access!=2)
        {
            echo"<script>alert('You do not have access to this page!');</script>";
            echo"<meta http-equiv='Refresh' content='0;URL=index.html'>";
        }
				if($_POST['id']!=""){
					$_SESSION['id']=$_POST['id'];
				}
			
    $account_id = $_POST['id'];
	//	$query = "SELECT * FROM `bankaccounts` WHERE (`username`='$username')";
	//	$result = $mysqli->query($query);
	//	$rows=mysqli_fetch_array($result);
	//	$USER_ID =$rows[0];
		$query1 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
		$result1 = $mysqli->query($query1);

		if($result1){
			echo "<table  id='accounts'>
			<h2>Business Account </h2>

			
			<tr>
			<th>BSB</th>
		<th>Account number</th>
		<th>Balance</th>
				</tr>";
			while($rows=mysqli_fetch_array($result1))
			{?>
					<tr>
							<td><?php echo $rows['BSB'];?></td>
							<td><?php echo $rows['ACCOUNT_NUMBER'];?></td>
							<td><?php echo $rows['BALANCE'];?></td>
					
					</tr><?php
	
            }
           
			
	
			echo"</table>";	
		}
	
		
	
		
?>	

<div id="myform4">
<form id="tranform" action="after_busadd_payee.php" method="post">
	<h2>Add new payee</h2>
	<table id="accounts1">
		<!--row for name field (required field).-->
		<tr>	
   			<td class="label">Account name</td>
      		<td><input type="text" name="accountname"></td>
      	</tr>
		<tr>	
   			<td class="label">BSB</td>
      		<td><input type="text" name="BSB"></td>
      	</tr>
      	
		<!--row for password field (required field). This password is for editing and deleting the comment-->
		<tr>
			<td class="label">Account number</td>
			<td><input name="accountnumber" type="text"></td>
		</tr>
	   
      
        <tr>
			<td class="label">Remark</td>
			<td><input name="remark" type="text"></td>
		</tr>
		<!--row for email field (required field).-->
		
    	<!--row for submit button.-->
    	<tr>
        	<td colspan="2" align="center"><input type="submit" id="submit"name="submit" value="Submit"></td>
    	</tr>
    	
    	
	</table>
	</form>

	</div>
	</div>
	
<!-- Create the food-->
<div id="footer">Jinzhi Hou 518845</div>

</body>
</html>
