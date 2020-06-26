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
	
	<div id="title">
        <?php
        echo "Welcome $session_user to Secure Bank";
        
        ?>
        
        </div>
	
	<div id="menu">
       <a href="index.html" id="homepage" >Home Page</a>  <a href="#" id="xx2" >About us</a>
	</div> 
	
	<div id="tool">
    <a href="signout.php" onclick="logout()"id="logoutbutton" >Logout</a>
	</div>
</div>

<div id="section">

    
    

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
            if($_POST['id']!=""){
                $_SESSION['id']=$_POST['id'];
            }
    $to_accountname = $_POST['accountname'];
    $to_BSB = $_POST['BSB'];
    $to_accountnumber = $_POST['accountnumber'];
 
    $remark=$_POST['remark'];
 
    $query1 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='2')";
    $result1 = $mysqli->query($query1);
    $rows=mysqli_fetch_array($result1);
   
    

                $from_BSB = $rows['BSB'];
                $from_accountnumber = $rows['ACCOUNT_NUMBER'];
              
                $Createpayee="INSERT INTO `PAYEES`(`USER_ID`,  `ACCOUNT_NAME`,  `BSB`, `ACCOUONT_NUMBER`, `TYPE`,`REMARK`) VALUES ('$session_id','$to_accountname','$to_BSB','$to_accountnumber','1','$remark')";
                $mysqli->query($Createpayee);
                   
                header('Location: ./business_transfer.php');
                    
    ?>       


    
    </p>
	</div>

<div id="footer">Copyright@Secure Bank.com</div>
    
    
    
    
    
</body>
</html>