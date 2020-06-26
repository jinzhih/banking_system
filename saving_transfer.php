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
       ?>")
       } 
</script>
	  <script>
                $(document).ready(function(){
                  $("#hide").click(function(){
                    $("p").hide();
                  });
                  $("#show").click(function(){
                    $("p").show();
                  });
                });
                </script>
	<script type="text/javascript">
	function payee_select(){
		//var x=document.getElementById("myHeader")
//alert(x.innerHTML)
		
  var x=document.getElementById("payee_list").value;
 

		
 	if(x!=""){
		var valueshuzu=x.split("_");
        document.getElementById('BSB').value=valueshuzu[0];
		document.getElementById('accountnumber').value=valueshuzu[1];
		document.getElementById('purpose').value=valueshuzu[2];
	}
	else{
		document.getElementById('BSB').value="";
		document.getElementById('accountnumber').value="";
		document.getElementById('purpose').value="";

	}
	}


function myFunction() {
  var x = document.getElementById("banklable");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
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
	<a href="index.html" id="homepage" >Homepage</a> <a href="account.php" id="back" >Back</a><a href="saving_transaction.php" id="xx3" >Transactions</a> <a href="saving_estatement.php" id="xx4" >eStatements</a>  
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
			
    $account_id = $_POST['id'];

		$query1 = "SELECT * FROM `ACCOUNTS` WHERE (`USER_ID`='$session_id')AND(`ACCOUNT_TYPE`='1')";
		$result1 = $mysqli->query($query1);
		if($result1){
			echo "<table  id='accounts'>
			<h2>Saving Account </h2>

			
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

<div id="myform">
<h2>Transfer </h2>
<button id="hide">Intra-bank</button>
            <button id="show">Inter-bank</button>
<form id="tranform" action="after_saving_transfer.php" method="post">
<p> 
	
<tr>
<td class="label">Bank name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input type="text" name="bankname"></td>
		</tr>


	</p>
  	
	
		
	<table id="accounts1">
		<!--row for name field (required field).-->
	
		<tr>	
   			<td class="label">BSB</td>
      		<td><input required oninvalid="setCustomValidity('Please enter your BSB!')" oninput="setCustomValidity('')"  type="text" name="BSB"></td>
		  </tr>
		    
      		
      	
      	
		<!--row for password field (required field). This password is for editing and deleting the comment-->
		<tr>
			<td class="label">Account number</td>
			<td><input  required oninvalid="setCustomValidity('Please enter your account name!')" oninput="setCustomValidity('')"  name="accountnumber" type="text"></td>
		</tr>
	    <tr>
			<td class="label">Amount</td>
			<td><input  required oninvalid="setCustomValidity('Please enter amount!')" oninput="setCustomValidity('')" name="amount" type="text"></td>
        </tr>
        <tr>
			<td class="label">Currency</td>
			<td>
		    	<select name="AUD">
                    <option value="AUD" >AUD</option>	
                  	
					</select></td>
        </tr>
        <tr>
			<td class="label">purpose</td>
			<td><input required oninvalid="setCustomValidity('Please enter purpose!')" oninput="setCustomValidity('')" name="purpose" type="text"></td>
		</tr>
		<!--row for email field (required field).-->
		
    	<!--row for submit button.-->
    	<tr>
        	<td colspan="2" align="center"><input type="submit" id="submit"name="submit" value="Submit"></td>
    	</tr>
    	
    	
	</table>
	</form>
	
	</div>
	<div id="myform2">	
	<h2>Pay bill </h2>
	<div id="tool1">
		<a href="saving_payee.php" id="payee" >Add a new organisation</a> 
	</div>
	<form id="tranform" action="after_saving_transfer.php" method="post">
	
	<?php
	$business_name=array();
	$business_bsb=array();
	$business_account=array();
	$business_remark=array();
	$querypayee="SELECT ACCOUNT_NAME, BSB,ACCOUONT_NUMBER,REMARK FROM `PAYEES` WHERE (`USER_ID`='$session_id'AND`TYPE`='1' )";
    $resultpayee = $mysqli->query($querypayee);
	
	while($rowpayee=mysqli_fetch_array($resultpayee))
			{
				$business_name[]=$rowpayee['ACCOUNT_NAME'];
				$business_bsb[]=$rowpayee['BSB'];
				$business_account[]=$rowpayee['ACCOUONT_NUMBER'];
				$business_remark[]=$rowpayee['REMARK'];
	
			}
			
			$count=count($business_name);
		
			echo'<select id="payee_list" name="payee_list" onchange="payee_select()">';
			echo'<option value="">Select Bill Account</option>';
			for($i=0;$i<$count;$i++){
				$value=$business_bsb[$i]."_".$business_account[$i]."_".$business_remark[$i];
				echo '<option value="'.$value.'">'.$business_name[$i].'</option>';
			}
			echo '</select>';
			
	?>	
	
	
	<table id="accounts1">
		<!--row for name field (required field).-->
		<tr>	
   			<td class="label">BSB</td>
      		<td><input id="BSB"type="text" name="BSB"></td>
      	</tr>
      	
		<!--row for password field (required field). This password is for editing and deleting the comment-->
		<tr>
			<td class="label">Account number</td>
			<td><input id="accountnumber" name="accountnumber" type="text"></td>
		</tr>
	    <tr>
			<td class="label">Amount</td>
			<td><input name="amount" type="text"></td>
        </tr>
        <tr>
			<td class="label">Currency</td>
			<td>
		    	<select name="AUD">
                    <option value="AUD" >AUD</option>	
               	
					</select></td>
        </tr>
        <tr>
			<td class="label">purpose</td>
			<td><input id="purpose" name="purpose" type="text"></td>
		</tr>
		<!--row for email field (required field).-->
		
    	<!--row for submit button.-->
    	<tr>
        	<td colspan="2" align="center"><input type="submit" id="submit"name="submit" value="Submit"></td>
    	</tr>
    	
    	
	</table>
	</form>
		</div>
		<div id=myform3>
	<form id="tranform" action="after_savapply_credit.php" method="post">
	<h2>Apply Credit Card </h2>
	<table id="accounts1">
		<!--row for name field (required field).-->
	
		<!--row for email field (required field).-->
		
    	<!--row for submit button.-->
    	<tr>
					<td colspan="2" align="center"><input type="submit" id="submit"name="submit" value="Submit"></td>
					<input type="hidden" name="id" value="<?php echo $id;?>">
    	</tr>
    	
    	
	</table>
	</form>
	</div>
	</div>
	
<!-- Create the food-->
<div id="footer">Jinzhi hou 518845</div>

</body>
</html>
