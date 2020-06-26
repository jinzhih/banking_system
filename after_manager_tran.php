<!DOCTYPE html>
<html>

<head>
	
	<link rel="stylesheet" type="text/css" href="css/signup.css"> 
	<script src="jquery-3.1.1.min.js">
	</script>
</head>

<body>

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
      
    
    
	<p> 
    
    <?php
	//keep the status in server side
    include("session.php");
	//Check connection
    include("db_conn.php");
    $fromBSB=$_POST['fromBSB'];
    $fromaccount=$_POST['fromaccount'];
    //get values from the form and compare with the database
    if(isset($_POST['confirm']))
{ 
	$_SESSION['mode']='confirm';
}
   
if($_POST['id']!="")
{
  $_SESSION['id']=$_POST['id'];
}
if($_POST['fromBSB']!="")
{
  $_SESSION['fromBSB']=$_POST['fromBSB'];

}
if($_POST['fromaccount']!="")
{
  $_SESSION['fromaccount']=$_POST['fromaccount'];
  
}
    
   

    if($_SESSION['mode']=='confirm'){
        $query = "UPDATE `TRANSACTION_RECORDS` SET `CONFIRM`='1' WHERE ID = '$_SESSION[id]'"; 
        $result=$mysqli->query($query);
        $query1 = "SELECT * FROM `TRANSACTION_RECORDS` WHERE (`ID`='$_SESSION[id]')";
        $result1 = $mysqli->query($query1);
        $rows1=mysqli_fetch_array($result1);
        $toBSB=$rows1['TO_BSB'];
        $toaccountnumber=$rows1['TO_ACCOUNT_NUMBER'];
        $transferacmount=$rows1['TRANSACTION_AMOUNT'];
        $purpose=$rows1['PURPOSE'];
        $currency=$rows1['CURRENCY'];
        $TRANSACTION_CODE=$rows1['TRANSACTION_CODE'];
        $query2 = "SELECT * FROM `ACCOUNTS` WHERE (`BSB`='$fromBSB')AND(`ACCOUNT_NUMBER`='$fromaccount')";
        $result2 = $mysqli->query($query2);
        $rows2=mysqli_fetch_array($result2);
        $userID=$rows2['USER_ID'];
         $Createtransaction1="INSERT INTO `TRANSACTION_FLOWS`(`BSB`, `ACCOUNT_NUMBER`,  `DEBIT_AMOUNT`, `FLOW_TYPE`, `PURPOSE`, `CURRENCY`, `TRANSACTION_CODE`, `USER_ID`, `ACCOUNT_TYPE`) VALUES ('$toBSB','$toaccountnumber','$transferacmount','transfer','$purpose','$currency','$TRANSACTION_CODE','$userID','2')";
         $mysqli->query($Createtransaction1);
         
         $Tobalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`+'$transferacmount' WHERE (`BSB`='$toBSB')AND(`ACCOUNT_NUMBER`='$toaccountnumber')";
         $resultto=$mysqli->query($Tobalance);
        
         $Frombalance="UPDATE `ACCOUNTS` SET `BALANCE`=`BALANCE`-'$transferacmount' WHERE (`BSB`='$fromBSB')AND(`ACCOUNT_NUMBER`='$fromaccount')";
         $resultfrom=$mysqli->query($Frombalance);


        header('Location:./confirm_transaction.php');
        }
       
    
    
    ?>
    
    
    
    
    </p>
	</div>

<div id="footer">Copyright@Secure Bank.com</div>
    
    
    
    
    
</body>
</html>