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

  <div id="header">
	<div id="logo">
		<img src="images/logo1.png" alt="logo">
    </div>
	
	<div id="title">Saving Account Page</div>
	
	<div id="menu">
    <a href="index.html" id="homepage" >Homepage</a>  <a href="saving_transfer.php" id="back" >Back</a><a href="saving_transaction.php" id="xx3" >Transation</a> <a href="saving_estatement.php" id="xx4" >eStatements</a> 
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
    if($session_user==""||$session_access!=2)
    {
        echo"<script>alert('You do not have access to this page!');</script>";
        echo"<meta http-equiv='Refresh' content='0;URL=index.html'>";
    }
    //get values from the form and compare with the database
    if($_POST['id']!=""){
        $_SESSION['id']=$_POST['id'];
    }
    
    $to_BSB = $_POST['BSB'];
    $to_accountnumber = $_POST['accountnumber'];
    $transfer_amount=$_POST['amount'];
    $currency=$_POST['AUD'];
    $purpose=$_POST['purpose'];
 
    $query1 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='1')";
    $result1 = $mysqli->query($query1);
    $rows=mysqli_fetch_array($result1);
    $bankname=$rows["BANK_NAME"];
    $query2="SELECT SUM(DEBIT_AMOUNT) AS TotalTransferAmount FROM TRANSACTION_FLOWS  where DATE_FORMAT(FLOW_TIME,'%m-%d-%Y')=DATE_FORMAT(NOW(),'%m-%d-%Y') AND`USER_ID`='$session_id' AND`ACCOUNT_TYPE`='1'";
    $result2 = $mysqli->query($query2);
    $rows2=mysqli_fetch_array($result2);
    $amount_before=$rows2['TotalTransferAmount'];
    $amount_after=$amount_before+$transfer_amount;
    
    

                $from_BSB = $rows['BSB'];
                $from_accountnumber = $rows['ACCOUNT_NUMBER'];
              //  $before_balance=$rows['BALANCE'];
                $TRANSACTION_CODE=random_int(10000,99999);
               // $after_balance=select $before_balance-$transfer_amount);
         
                 if($rows['BALANCE']>=$transfer_amount){
                     if($amount_after<10000){
                    echo "<div>
                    <h2>Your Transaction Confirmed</h2>
                        </div>";
            
                    echo "<table  id='accounts'>
                    
                
                    <tr>
                    <th>From BSB</th>
                    <th>From Account</th>
                    <th>To BSB</th>
                    <th>To Account</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    </tr>";
                    ?>
                        <tr>
                                <td><?php echo $rows['BSB'];?></td>
                                <td><?php echo $rows['ACCOUNT_NUMBER'];?></td>
                                <td><?php echo $to_BSB;?></td>
                                <td><?php echo $to_accountnumber;?></td>
                                <td><?php echo $transfer_amount;?></td>
                                <td><?php echo $currency;?></td>
                        
                        </tr><?php
                
                    
                    echo"</table>";	




                 $Createtransaction="INSERT INTO `TRANSACTION_RECORDS`(`TRANSACTION_CODE`,  `FROM_BSB`, `FROM_ACCOUNT_NUMBER`, `TO_BSB`,`TO_ACCOUNT_NUMBER`, `TRANSACTION_TYPE`, `TRANSACTION_AMOUNT`, `CURRENCY`, `CONFIRM`) VALUES ('$TRANSACTION_CODE','$from_BSB','$from_accountnumber','$to_BSB','$to_accountnumber','transfer','$transfer_amount','$currency','1')";
                 $mysqli->query($Createtransaction);
                 $Createtransaction1="INSERT INTO `TRANSACTION_FLOWS`(`BSB`, `ACCOUNT_NUMBER`,  `DEBIT_AMOUNT`, `FLOW_TYPE`, `PURPOSE`, `CURRENCY`, `TRANSACTION_CODE`, `USER_ID`, `ACCOUNT_TYPE`) VALUES ('$to_BSB','$to_accountnumber','$transfer_amount','transfer','$purpose','$currency','$TRANSACTION_CODE','$session_id','1')";
                 $mysqli->query($Createtransaction1);

                //  $query_balance = "SELECT (SUM(DEBIT_AMOUNT)*-1 + SUM(CREDIT_AMOUNT)) AS BALANCE FROM `TRANSACTION_FLOWS`  WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='1')";
                //  $result_balance = $mysqli->query($query_balance);
                //  $rows_balance=mysqli_fetch_array($result_balance);
                //  $sum=$rows_balance['BALANCE'];
             
                
                //  $Changebalance="UPDATE `ACCOUNTS` SET `BALANCE`='$sum' WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='1')";
                //  $result=$mysqli->query($Changebalance);
                //Update current account balance
                $Frombalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`-'$transfer_amount' WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='1')";
                $result=$mysqli->query($Frombalance);
//Update to account balance
                 $Tobalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`+'$transfer_amount' WHERE (`BSB`='$to_BSB')AND(`ACCOUNT_NUMBER`='$to_accountnumber')";
                 $result=$mysqli->query($Tobalance);
                 }
                 else{
                    echo "Transfer over 10000";
                 }
                }
                 else {
                     echo "No enough money";
                 }
    ?>       


    
    </p>
	</div>

<div id="footer">Jinzhi hou 518845</div>
    
    
    
    
    
</body>
</html>