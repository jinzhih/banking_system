<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/loginstyle.css"> 
	<script src="jquery-3.1.1.min.js">
	</script>

</head>

<body>
	<!-- Create head part-->
<div id="header">
	<div id="logo">
		<img src="images/logo1.png" alt="logo">
    </div>
	
	<div id="title">Logon</div>
	
	<div id="menu">
       <a href="index.html" id="xx3" >Homepage</a>  <a href="information.php" id="xx2" >Information</a>
	</div> 
	
	<div id="tool">
		<a href="login1.php" id="loginbutton" >Logon</a> <a href="register.html" id="registerbutton" >Register</a>
	</div>
</div>

<div id="loginform">
	<!-- Create the login form-->
		<form id="signinform" name="signinform" method="Post" action="after_sign_in.php" onsubmit="validate()">
	
			<p>
				<label for="username">Username:</label>
				<input  class="inputW" type="text" id="username" name="username">
			</p>
			
			<p>
				<label for="password">Password:</label>
				<input  class="inputW" type="password" id="password"  name="password"/>
			</p>
		
		    <P>
				<input class="submit" type="submit" value="submit"/>
			</P>
			<P>Didn't you have account yet?    
				<a href="register.html">Register now</a>
            </P>
	
	</form>

	<!--Login form validate-->
	<script>
			function validate(){
				
				if($("#username").val()==""){
					alert("Username is required.");
				}else if($("#password").val()==""){
					alert("Password is required.");
				}
			}
	</script>

	
</div>
	<!-- Create the footer-->
<div id="footer">Jinzhi hou 518845</div>



</body>
</html>