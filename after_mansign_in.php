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
		<a href="managerlogin.html" id="loginbutton" >Manager Logon</a> 
	</div>
</div>

<div id="section">
    

    
    
    
	<p> 
    
    <?php
	//keep the status in server side
    include("session.php");
	//Check connection
    include("db_conn.php");
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query="SELECT * FROM manager WHERE username='$username'";
    $result=$mysqli->query($query);
    $row=$result->fetch_array(MYSQLI_ASSOC);
    if($row['password']==$password){
        $SESSION['session_user']=$username;
        echo "WECLOME $username <a href='manage.html'>Add/remove any account</a>";
        
    }
        else{
            echo "Incorrect username or password"."<br>";
            echo "<a href='managerlogin.html'>Go back to logon page</a>";
        }
    
    
?>
    
    
    
    
    </p>
	</div>

<div id="footer">Copyright@Secure Bank.com</div>
    
    
    
    
    
</body>
</html>