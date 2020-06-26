<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/regstyle1.css"> 
	<script src="jquery-3.1.1.min.js">
	</script>
	<script>
        function logout(){
	alert("<?php echo'You are logging out your account!';
	echo date('Y-m-d H:i:s',time()); 

       ?>")

} 
</script>
	<script type="text/javascript">
	  $(document).ready(function() {
		  
		  // make button not submit a form (if type is not submit)
		  $('button[type!=submit]').click(function(){
			 // code to cancel changes
			 return false;
		 });
 
		 // when user clicks the check button id='check', execute the following function
		 $("#username").keyup( function () {
 
				   // get the value of username field and assign as username.
				  var username = $("#username").val();
 
				   // send the data 'username' as username to checker.php and execute the following function (if the data sending is successful)
				   $.get( "checker.php", { username: username} )
				   .done(function( data ) {
						   // print the data (output of checker.php) as a label for 'username' id='output'
						 $("#output").html(data);
				 });
		 });
 
	  });
	</script>
</head>

<body>
<!-- Create the head part of html page-->
<div id="header">
	<div id="logo">
		<img src="images/logo1.png" alt="logo">
    </div>
	
	<div id="title">Manager Page</div>
	
	<div id="menu">
	<a href="index.html" id="homepage" >Homepage</a><a href="manager.php" id="back" >Back</a>  <a href="manager_transaction.php" id="xx3" >Transactions</a> <a href="confirm_transaction.php" id="xx4" >Confirm Transaction</a>  <a href="addaccount.php" id="xx6" >Add Account</a> 
	</div> 
	
	<div id="tool">
	<a href="signout.php" onclick="logout()"id="logoutbutton" >Logout</a>
	</div>
</div>

<div id="registerform">
<!- Create a register form->	

	<form target="_blank"id="signupForm" name="signupform" method="Post" action="after_addaccount.php" onsubmit="return regvalidate();">
	
		
			<p>
				
				<input required oninvalid="setCustomValidity('Please enter your username!')" oninput="setCustomValidity('')" placeholder="username" id="username" name="username"/><br/>	
<!--		<button id="check">Check</button>-->
		<label id="output" for="username"></label><br/>	
			</p>
			
			<p>
				
				<input required oninvalid="setCustomValidity('Please enter your Firstname!')" oninput="setCustomValidity('')" placeholder="First name" id="firstname" name="firstname"/>
			</p>
			
			<p>
				
				<input required oninvalid="setCustomValidity('Please enter your Lastname!')" oninput="setCustomValidity('')" placeholder="Last name" id="lastname" name="lastname"/>
			</p>
			
			<p>
				
				<input required oninvalid="setCustomValidity('Please enter your password!')" oninput="setCustomValidity('')" placeholder="Password" id="password" name="password" type="password"/>
			</p>
			<p>
				
				<input required oninvalid="setCustomValidity('Please confirm your password!')" oninput="setCustomValidity('')" placeholder="Confirm password" id="passwordd" name="passwordd" type="password"/>
				
			</p>
			<P>
				
				<input required oninvalid="setCustomValidity('Please enter your mobile!')" oninput="setCustomValidity('')" placeholder="Mobile" id="mobile" name="mobile"/>
				
			</P>
			<P>
				
				<input required oninvalid="setCustomValidity('Please enter your Email!')" oninput="setCustomValidity('')" placeholder="Email" id="email" name="email"/>
				
			</P>
			<P>
				
				<input required oninvalid="setCustomValidity('Please enter your DOB!')" oninput="setCustomValidity('')" placeholder="DOB DD/MM/YY" id="DOB" name="DOB"/>
				
			</P>
			<div class="checkbox_group required">
					
							<input type="checkbox" name="saving_account" value="1"/><span>Saving Account</span></br>
							<input type="checkbox" name="business_account"  value="2"/><span>Business Account</span></br> 
							
					
			</div>
			
            <p>
                 <input class="inputB" required oninvalid="setCustomValidity('Please agree the terms!')" oninput="setCustomValidity('')" type="checkbox"  name="terms" value="check" id="terms">I have read and agree to the
                <a href="terms.html">Terms and Conditions.</a>
               
            </p>
		    <P>
				<input class="submit" type="submit" value="submit"/>
			</P>
	
	</form>
	<!--validation before submit-->
	<script>
			function regvalidate(){
				//define email passwrod and confirmpassword
				var email = document.getElementById("email"); 
				var passwordone = document.getElementById("password"); 
				var passwordtwo = document.getElementById("passwordd"); 
				var passwordRegexp= new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[~#$!]).{8,12}$/); 
				var emailRegexp= new RegExp(/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/); 
				var checked=$("input[name='saving_account']:checked");
				var checked2=$("input[name='business_account']:checked");
				if(document.signupform.username.value==""){
				alert("Please enter your username.");
				return false;	
		    	}
				else if(document.signupform.firstname.value==""){
				alert("Please enter your firstname.");
				return false;	
		    	}
				else if(document.signupform.lastname.value==""){
				alert("Please enter your lastname.");
				return false;	
		    	}
				else if(document.signupform.password.value==""){
				alert("Please enter your password.");
				return false;	
				}
				else if(document.signupform.passwordd.value==""){
				alert("Please enter your password(confirmation).");
				return false;	
				}
				else if(document.signupform.password.value!=document.signupform.passwordd.value){
				alert("The two passwords don't match.");
				return false;	
			    }
				
				
				else if(!passwordRegexp.test(passwordone.value)){ 
                alert("Your passowrd should include 8-12 characters in length and contains at least 1 lower case letter, 1uppercase letter, 1 number and one of the following special characters~!#$"); 
                 return false; 
                } 
				
				else if(document.signupform.mobile.value==""){
				alert("Please enter your mobile.");
				return false;	
				}
				else if(email.value==""){
					alert("Please enter your password.");
					return false;
				}
				
			
				else if(!emailRegexp.test(email.value)){ 
                alert("Your E-mail address is not correct!"); 
                 return false; 
                } 
                else if(checked.length==0 && checked2.length==0) {
                alert("Please choose at least one account type");
               
                return false;
                }
                else if(!form.terms.checked) {
                alert("Please indicate that you accept the Terms and Conditions");
                form.terms.focus();
                return false;
                }
                
				else{
				 return true;	
				}
							
			}
		
</script>
	
	
	
</div>
<!-- Create the footer-->
<div id="footer">Jinzhi hou 518845</div>



</body>
</html>