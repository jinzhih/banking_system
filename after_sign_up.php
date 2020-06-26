<!DOCTYPE html>
<html>

<head>
	
	<link rel="stylesheet" type="text/css" href="css/signup.css"> 
	<script src="jquery-3.1.1.min.js">
	</script>
</head>

<body>
	<?php
	 
	//Check connection
	include("db_conn.php");
	//Get values from the form
	$username=$_POST["username"];
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
	$query="insert into bankaccounts (username,firstname,lastname,password,email,mobile,DOB,access) VALUES('$username','$firstname','$lastname','$encrypted_password','$email','$mobile','$DOB','2')";
	$mysqli->query($query);
	include("session.php");
	$_SESSION['session_user']=$username;
    //从bankaccounts中把ID选出来 

	$query = "SELECT * FROM `bankaccounts` WHERE (`username`='$username')";
   $result = $mysqli->query($query);
   $rows=mysqli_fetch_array($result);

   $USER_ID =$rows[0];
   //判断如果选了saving accouont那么插入一条
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
        echo "Welcome $username to Secure Bank";
		
		
	
 
        ?>
        
        </div>
	
	<div id="menu">
      <a href="index.html" id="homepage" >Home Page</a>  <a href="#" id="xx2" >About us</a>
	</div> 
	
	<div id="tool">
		<a href="login1.php" id="loginbutton" >Logon</a> <a href="register.html" id="registerbutton" >Register</a>
	</div>
</div>

<div id="section">
    
	<p> You have successfully register your account.  </p>

	<p> <a href='login1.php'>Log on Now</a>;</p>
	<?php
	//	echo $USER_ID;
	//	echo $business_account;
	//	echo $BSB1;
	//	echo $ACCOUNT_NUMBER1;
	//	echo $USER_ID;
	 ?>
	</div>

<div id="footer">Copyright@Secure Bank.com</div>
    
    
    
    
    
</body>
</html>