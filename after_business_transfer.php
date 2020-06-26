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
	
       ?>")

       } 
       </script>
</head>

<body>

  <div id="header">
	<div id="logo">
		<img src="images/logo1.png" alt="logo">
    </div>
	
	<div id="title">Business Account Page</div>
	
	<div id="menu">
    <a href="index.html" id="homepage" >Homepage</a>  <a href="business_transfer.php" id="back" >Back</a><a href="business_transaction.php" id="xx3" >Transation</a> <a href="business_estatement.php" id="xx4" >eStatements</a> 
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
    //get values from the form and compare with the database

    if($session_user==""||$session_access!=2)
    {
        echo"<script>alert('You do not have access to this page!');</script>";
        echo"<meta http-equiv='Refresh' content='0;URL=index.html'>";
    }
    
    if($_POST['id']!=""){
        $_SESSION['id']=$_POST['id'];
    }
    $to_bankname = $_POST['bankname'];
    $to_BSB = $_POST['BSB'];
    $to_accountnumber = $_POST['accountnumber'];
    $transfer_amount=$_POST['amount'];
    $currency=$_POST['AUD'];
    $purpose=$_POST['purpose'];
 
    $query1 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
    $result1 = $mysqli->query($query1);
    $rows=mysqli_fetch_array($result1);
    $bankname=$rows["BANK_NAME"];
    $query2="SELECT SUM(DEBIT_AMOUNT) AS TotalTransferAmount FROM TRANSACTION_FLOWS  where DATE_FORMAT(FLOW_TIME,'%m-%d-%Y')=DATE_FORMAT(NOW(),'%m-%d-%Y') AND`USER_ID`='$session_id' AND`ACCOUNT_TYPE`='2'";
    $result2 = $mysqli->query($query2);
    $rows2=mysqli_fetch_array($result2);
    $amount_before=$rows2['TotalTransferAmount'];
    $amount_after=$amount_before+$transfer_amount;
    

    $from_BSB = $rows['BSB'];
    $from_accountnumber = $rows['ACCOUNT_NUMBER'];
  
    $TRANSACTION_CODE=random_int(10000,99999);
            
                 if($rows['BALANCE']>=$transfer_amount){
                    if($amount_after<50000){
                        if($transfer_amount<25000) {
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
                   
                if($currency==AUD){
//Insert transaction record. 

                 $Createtransaction="INSERT INTO `TRANSACTION_RECORDS`(`TRANSACTION_CODE`,  `FROM_BSB`, `FROM_ACCOUNT_NUMBER`,`TO_BANK`,`TO_BSB`,`TO_ACCOUNT_NUMBER`, `TRANSACTION_TYPE`, `TRANSACTION_AMOUNT`, `CURRENCY`, `CONFIRM`) VALUES ('$TRANSACTION_CODE','$from_BSB','$from_accountnumber','$to_bankname','$to_BSB','$to_accountnumber','transfer','$transfer_amount','$currency','1')";
                 $mysqli->query($Createtransaction);
                 
//Insert transaction record.               
                 
                 $Createtransaction1="INSERT INTO `TRANSACTION_FLOWS`(`BSB`, `ACCOUNT_NUMBER`,  `DEBIT_AMOUNT`, `FLOW_TYPE`, `PURPOSE`, `CURRENCY`, `TRANSACTION_CODE`, `USER_ID`, `ACCOUNT_TYPE`) VALUES ('$to_BSB','$to_accountnumber','$transfer_amount','transfer','$purpose','$currency','$TRANSACTION_CODE','$session_id','2')";
                 $mysqli->query($Createtransaction1);

//Update current account balance
                 $Frombalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`-'$transfer_amount' WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
                 $result=$mysqli->query($Frombalance);
//Update to account balance
                 $Tobalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`+'$transfer_amount' WHERE (`BSB`='$to_BSB')AND(`ACCOUNT_NUMBER`='$to_accountnumber')";
                 $result=$mysqli->query($Tobalance);
                }
                if($currency==RMB){
//Insert transaction record. 
                    
                 $Createtransaction="INSERT INTO `TRANSACTION_RECORDS`(`TRANSACTION_CODE`,  `FROM_BSB`, `FROM_ACCOUNT_NUMBER`,`TO_BANK`,`TO_BSB`,`TO_ACCOUNT_NUMBER`, `TRANSACTION_TYPE`, `TRANSACTION_AMOUNT`, `CURRENCY`, `CONFIRM`) VALUES ('$TRANSACTION_CODE','$from_BSB','$from_accountnumber','$to_bankname','$to_BSB','$to_accountnumber','transfer','$transfer_amount','$currency','1')";
                 $mysqli->query($Createtransaction);
                                     
//Insert transaction record.               
                                     
                 $Createtransaction1="INSERT INTO `TRANSACTION_FLOWS`(`BSB`, `ACCOUNT_NUMBER`,  `DEBIT_AMOUNT`, `FLOW_TYPE`, `PURPOSE`, `CURRENCY`, `TRANSACTION_CODE`, `USER_ID`, `ACCOUNT_TYPE`) VALUES ('$to_BSB','$to_accountnumber','$transfer_amount','transfer','$purpose','$currency','$TRANSACTION_CODE','$session_id','2')";
                  $mysqli->query($Createtransaction1);
                 
                 $rate=4.8;
                 $transfer_amount=$transfer_amount/$rate;
                 $Frombalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`-'$transfer_amount' WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
                 $result=$mysqli->query($Frombalance);
//Update to account balance
                 $Tobalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`+'$transfer_amount' WHERE (`BSB`='$to_BSB')AND(`ACCOUNT_NUMBER`='$to_accountnumber')";
                 $result=$mysqli->query($Tobalance);
                  }
                if($currency==USD){
//Insert transaction record. 
                                        
                $Createtransaction="INSERT INTO `TRANSACTION_RECORDS`(`TRANSACTION_CODE`,  `FROM_BSB`, `FROM_ACCOUNT_NUMBER`,`TO_BANK`,`TO_BSB`,`TO_ACCOUNT_NUMBER`, `TRANSACTION_TYPE`, `TRANSACTION_AMOUNT`, `CURRENCY`, `CONFIRM`) VALUES ('$TRANSACTION_CODE','$from_BSB','$from_accountnumber','$to_bankname','$to_BSB','$to_accountnumber','transfer','$transfer_amount','$currency','1')";
                $mysqli->query($Createtransaction);
                                                         
 //Insert transaction record.               
                                                         
                  $Createtransaction1="INSERT INTO `TRANSACTION_FLOWS`(`BSB`, `ACCOUNT_NUMBER`,  `DEBIT_AMOUNT`, `FLOW_TYPE`, `PURPOSE`, `CURRENCY`, `TRANSACTION_CODE`, `USER_ID`, `ACCOUNT_TYPE`) VALUES ('$to_BSB','$to_accountnumber','$transfer_amount','transfer','$purpose','$currency','$TRANSACTION_CODE','$session_id','2')";
                 $mysqli->query($Createtransaction1);
                  
   //Update current account balance
                 $rate=0.69;
                 $transfer_amount=$transfer_amount/$rate;
                 $Frombalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`-'$transfer_amount' WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
                  $result=$mysqli->query($Frombalance);
   //Update to account balance
                 $Tobalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`+'$transfer_amount' WHERE (`BSB`='$to_BSB')AND(`ACCOUNT_NUMBER`='$to_accountnumber')";
                   $result=$mysqli->query($Tobalance);
                 }
                    
                 }
                 else{
                    $Createtransaction="INSERT INTO `TRANSACTION_RECORDS`(`TRANSACTION_CODE`,  `FROM_BSB`, `FROM_ACCOUNT_NUMBER`, `TO_BSB`,`TO_ACCOUNT_NUMBER`, `TRANSACTION_TYPE`, `TRANSACTION_AMOUNT`, `CURRENCY`, `CONFIRM`) VALUES ('$TRANSACTION_CODE','$from_BSB','$from_accountnumber','$to_BSB','$to_accountnumber','transfer','$transfer_amount','$currency','0')";
                    $mysqli->query($Createtransaction);
                    echo "<div id='over'> Need manager confirm<br></div>";
                    
                 }
                }
                else{
                  
                  
                    
                    echo "<div id='over'> Daily Transfer cannot over 50000<br></div>";
                }
            }
                 else {
                    echo "<div id='over'> No enough money<br></div>";
                    
                 }
    ?>       


    
    </p>
	</div>

<div id="footer">Jinzhi hou 518845</div>
    
    
    
    
    
</body>
</html>