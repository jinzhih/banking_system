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
    //get values from the form and compare with the database
    if(isset($_POST['edit']))
{ 
	$_SESSION['mode']='edit';
}
else if (isset($_POST['delete']))
{
	$_SESSION['mode']='delete';
}    
if($_POST['id']!="")
{
  $_SESSION['id']=$_POST['id'];
}
$select = $_POST['chooseaccess']; 
   
    $query="SELECT * FROM bankaccounts WHERE username='$username'";
    $result=$mysqli->query($query);
    $row=$result->fetch_array(MYSQLI_ASSOC);
    if($_SESSION['mode']=='edit'){
        $query = "UPDATE `bankaccounts` SET `access`='$select' WHERE ID = '$_SESSION[id]'"; 
        $result=$mysqli->query($query);
        header('Location:./manager.php');
        }
        else{
            $query = "DELETE FROM bankaccounts WHERE ID = '$_SESSION[id]'";
            $mysqli->query($query);
            header('Location:./manager.php');
        }
    
    
    ?>
    
    
    
    
    </p>
	</div>

<div id="footer">Copyright@Secure Bank.com</div>
    
    
    
    
    
</body>
</html>