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
<!-- Create the header-->
<div id="header">
	<div id="logo">
		<img src="images/logo1.png" alt="logo">
    </div>
	
	<div id="title">Saving Account Page</div>
	
	<div id="menu">
	<a href="index.html" id="homepage" >Homepage</a>  <a href="account.php" id="back" >Back</a><a href="saving_transfer.php" id="xx3" >Transfer</a> <a href="saving_estatement.php" id="xx4" >eStatements</a> 
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
        if($session_user==""||$session_access!=2)
        {
            echo"<script>alert('You do not have access to this page!');</script>";
            echo"<meta http-equiv='Refresh' content='0;URL=index.html'>";
        }
                    if($_POST['id']!=""){
                        $_SESSION['id']=$_POST['id'];
                    }
		
	
		$query1 = "SELECT * FROM `bankaccounts` WHERE (`ID`='$session_id')";
		$result1 = $mysqli->query($query1);
        $rows1=mysqli_fetch_array($result1);
        $query2 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='1')";
        $result2 = $mysqli->query($query2);
        $rows2=mysqli_fetch_array($result2);
		
          
			echo "<div>
			<h2>Account details</h2>
				</div>";
	
			echo "<table  id='accounts'>
			
			<tr>
			<th>username</th>
		    <th>BSB</th>
			<th>Account number</th>
			</tr>";
		
			?>
					<tr>
							<td><?php echo $rows1['username'];?></td>
					
                            <td><?php echo $rows2['BSB'];?></td>
							<td><?php echo $rows2['ACCOUNT_NUMBER'];?></td>
					</tr><?php
	
			
			echo"</table>";	
	
	
		$query2 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='1')";
        $result2 = $mysqli->query($query2);
        $rows2=mysqli_fetch_array($result2);
		
		$query3 = "SELECT * FROM `TRANSACTION_FLOWS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='1')";
		$result3 = $mysqli->query($query3);
			echo "<div>
			<h2>Transactions</h2>
				</div>";
			echo "<table id='accounts'>
		
            <tr>
            <th>Date</th>
            
			<th>To BSB</th>
			<th>To Account number</th>
			<th>Debit</th>
			<th>Credit</th>
			<th>Balance</th>
			<th>Currency</th>
			<th>Purpose</th>
			<th>Transaction ID</th>
			</tr>";
			while($rows3=mysqli_fetch_array($result3))
			{?>
					<tr>
                            <td><?php echo $rows3['FLOW_TIME'];?></td>
                           
							<td><?php echo $rows3['BSB'];?></td> 
                            <td><?php echo $rows3['ACCOUNT_NUMBER'];?></td> 
                            <td><?php echo $rows3['DEBIT_AMOUNT'];?></td> 
                            <td><?php echo $rows3['CREDIT_AMOUNT'];?></td>
                            <td><?php echo $rows3['BALANCE'];?></td>
							<td><?php echo $rows3['CURRENCY'];?></td> 
                            <td><?php echo $rows3['PURPOSE'];?></td> 
                            <td><?php echo $rows3['TRANSACTION_CODE'];?></td> 
					</tr><?php
	
			}
			echo"</table>";	
		
	
?>		

	
</div>
<!-- Create the food-->
<div id="footer">Jinzhi hou 518845</div>

</body>
</html>