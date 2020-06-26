<!DOCTYPE html>
<html>

<head>
	
	<link rel="stylesheet" type="text/css" href="css/signup.css"> 
	<script src="jquery-3.1.1.min.js">
    </script>
    <!-- js logout function -->
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
	
	<div id="title">
        <?php
        echo "Welcome $username to Secure Bank";
        
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
      
    
    
	<p> 
    
    <?php
	//keep the status in server side
    include("session.php");
	//Check connection
    include("db_conn.php");
    //get values from the form and compare with the database
  
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query="SELECT * FROM bankaccounts WHERE username='$username'";
    $result=$mysqli->query($query);
    $row=$result->fetch_array(MYSQLI_ASSOC);
    $id=$row['ID'];
    $encrypted_password = MD5($password);

    $query1="SELECT * FROM USER_ACTIONS WHERE ACTION='Login' AND `USER_ID`='$id' order by `ACTION_TIME`  desc limit 1";
    $result1=$mysqli->query($query1);
    $row1=$result1->fetch_array(MYSQLI_ASSOC);
    $last_login=$row1['ACTION_TIME'];
    if($row['password']==$password||$row['password']==$encrypted_password){
        $SESSION['session_user']=$username;
        $_SESSION['session_user']=$row['username'];
        $_SESSION['access']=$row['access'];
        $_SESSION['id']=$row['ID'];
        $id=$row['ID'];
        $Createuseraction="INSERT INTO `USER_ACTIONS`(`USER_ID`,  `ACTION`) VALUES ('$id','Login')";
        $mysqli->query($Createuseraction);
        if($row['access']==2){
        echo "WECLOME $username <br>Last Login time $last_login<br><a href='account.php'>Check your Account Page</a>";
      //  echo  $_SESSION['id']; 
        
       }
       if($row['access']==1){
            echo "WECLOME $username <br>Last Login time $last_login <br> <a href='manager.php'>Check your Manager Page</a>";   
            
          }
        }
        else{
            echo "Incorrect username or password"."<br>";
            echo "<a href='login1.php'>Go back to logon page</a>";
        }
    
    
    ?>
    
    
    
    
    </p>
	</div>

<div id="footer">Jinzhi hou 518845</div>
    
    
    
    
    
</body>
</html>