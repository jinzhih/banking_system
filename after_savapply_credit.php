<!DOCTYPE html>
<html>

<head>
	
	<link rel="stylesheet" type="text/css" href="css/accountlayout.css"> 
	<script src="jquery-3.1.1.min.js">
	</script>
</head>

<body>

  <div id="header">
	<div id="logo">
		<img src="images/logo1.png" alt="logo">
    </div>
	
    <div id="title">Saving Account Page</div>
	
	
	<div id="menu">
       <a href="index.html" id="homepage" >Home Page</a>  <a href="saving_transfer.php" id="xx2" >Back</a>
	</div> 
	
	<div id="tool">
  <a href="signout.php" onclick="logout()"id="logoutbutton" >Logout</a>
	</div>
</div>

<div id="section">

    
    
	<p> 
    
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
    //get values from the form and compare with the database
    if($_POST['id']!=""){
        $_SESSION['id']=$_POST['id'];
    }
    
    // $to_BSB = $_POST['BSB'];
    // $to_accountnumber = $_POST['accountnumber'];
    // $transfer_amount=$_POST['amount'];
    // $currency=$_POST['AUD'];
    // $purpose=$_POST['purpose'];
 
    $query1 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='1')";
    $result1 = $mysqli->query($query1);
    $rows=mysqli_fetch_array($result1);
    // $bankname=$rows["BANK_NAME"];
    // $query2="SELECT SUM(DEBIT_AMOUNT) AS TotalTransferAmount FROM TRANSACTION_FLOWS  where DATE_FORMAT(FLOW_TIME,'%m-%d-%Y')=DATE_FORMAT(NOW(),'%m-%d-%Y')";
    // $result2 = $mysqli->query($query2);
    // $rows2=mysqli_fetch_array($result2);
    
    

                $from_BSB = $rows['BSB'];
                $from_accountnumber = $rows['ACCOUNT_NUMBER'];
              //  $before_balance=$rows['BALANCE'];
                $TRANSACTION_CODE=random_int(10000,99999);
                $CREDIT_NUMBER=random_int(100000,999999);
               // $after_balance=select $before_balance-$transfer_amount);
               $CreateCreditcard="INSERT INTO `CREDIT_CARDS`(`CREDIT_NUMBER`,  `USER_ID`) VALUES ('$CREDIT_NUMBER','$session_id')";
               $mysqli->query($CreateCreditcard);
             



                 $Createtransaction="INSERT INTO `TRANSACTION_RECORDS`(`TRANSACTION_CODE`,  `FROM_BSB`, `FROM_ACCOUNT_NUMBER`,  `TRANSACTION_TYPE`, `TRANSACTION_AMOUNT`, `CURRENCY`, `CONFIRM`) VALUES ('$TRANSACTION_CODE','$from_BSB','$from_accountnumber','credit annual fee','50','AUD','1')";
                 $mysqli->query($Createtransaction);
                 $Createtransaction1="INSERT INTO `TRANSACTION_FLOWS`(  `DEBIT_AMOUNT`, `FLOW_TYPE`, `PURPOSE`, `CURRENCY`, `TRANSACTION_CODE`, `USER_ID`, `ACCOUNT_TYPE`) VALUES ('50','credit annual fee','credit annual fee','AUD','$TRANSACTION_CODE','$session_id','1')";
                 $mysqli->query($Createtransaction1);


                 $Tobalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`-'50' WHERE (`BSB`='$from_BSB')AND(`ACCOUNT_NUMBER`='$from_accountnumber')";
                 $result=$mysqli->query($Tobalance);
                 echo "<h2>Credit card applied succesfully</h2>";
               
    ?>       


    
    </p>
	</div>

<div id="footer">Jinzhi hou 518845</div>
    
    
    
    
    
</body>
</html>