<!DOCTYPE html>
<html>

<head>
	
	<link rel="stylesheet" type="text/css" href="css/signup.css"> 
	<script src="jquery-3.1.1.min.js">
	</script>
</head>

<body>
	<?php
	//keep the status in server side
	include("session.php");
	//Check connection
	include("db_conn.php");
	//Get values from the form
	$username1=$_POST["username"];
	$firstname=$_POST["firstname"];
	$lastname=$_POST["lastname"];
	$password=$_POST["password"];
	$email=$_POST["email"];
	$mobile=$_POST["mobile"];
	$DOB=$_POST["DOB"];
    $encrypted_password = MD5($password);
	$saving_account=$_POST["saving_account"];
    $business_account=$_POST["business_account"];
	//Insert data into the table
	$query="insert into bankaccounts (username,firstname,lastname,password,email,mobile,DOB,access) VALUES('$username1','$firstname','$lastname','$encrypted_password','$email','$mobile','$DOB','2')";
	$mysqli->query($query);

    //select ID from bankaccounts

	$query = "SELECT * FROM `bankaccounts` WHERE (`username`='$username1')";
   $result = $mysqli->query($query);
   $rows=mysqli_fetch_array($result);

   $USER_ID =$rows[0];
   //justify if choose saving or business
    if($saving_account){
		$BSB1=random_int(100000,999999);
		$ACCOUNT_NUMBER1=random_int(100000000,999999999);
		$CreateSaccount="insert into ACCOUNTS (BSB,ACCOUNT_NUMBER,ACCOUNT_TYPE,BANK_NAME,USER_ID,BALANCE) VALUES('$BSB1','$ACCOUNT_NUMBER1','1','Secure Bank','$USER_ID','0')";
		$mysqli->query($CreateSaccount);
		}
	if($business_account){
		$BSB2=random_int(100000,999999);
		$ACCOUNT_NUMBER2=random_int(100000000,999999999);
		$CreateBaccount="insert into ACCOUNTS (BSB,ACCOUNT_NUMBER,ACCOUNT_TYPE,BANK_NAME,USER_ID,BALANCE) VALUES('$BSB2','$ACCOUNT_NUMBER2','2','Secure Bank','$USER_ID','0')";
	    $mysqli->query($CreateBaccount);
	}
	?>
	
    <div id="header">
	<div id="logo">
		<img src="images/logo1.png" alt="logo">
    </div>
	
	<div id="title">
        <?php
        echo " $username Added";
	    ?>
        
    </div>
	
	<div id="menu">
	<a href="index.html" id="homepage" >Homepage</a> <a href="manager_transaction.php" id="manager_transaction" >Transactions</a> <a href="confirm_transaction.php" id="xx4" >Confirm Transaction</a>  <a href="addaccount.php" id="addaccount" >Add Account</a> 
	</div> 
	
	<div id="tool">
	<a href="signout.php" onclick="logout()"id="logoutbutton" >Logout</a>
	</div>
    </div>

	<div id="section">
		
		<p> You have successfully register  account.  </p>

		<p> <a href='manager.php'>Manager portal</a>;</p>

		</div>

	<div id="footer">Jinzhi hou 518845</div>
    
    
    
    
    
</body>
</html>