<?php
//starting session
    session_start();
    //if the session for username has not been set, initialise it
    if(!isset($_SESSION['session_user']))
    {
        $_SESSION['session_user']="";
    }
    if(!isset($_SESSION['mode'])){
      $_SESSION['mode']="";
    }
    if(!isset($_SESSION['access']))
    {
		$_SESSION['access']="";
    }
    if(!isset($_SESSION['id'])){
	$_SESSION['id']="";
    }
$session_user=$_SESSION['session_user'];
$session_access=$_SESSION['access'];
$session_id=$_SESSION['id'];
$mode=$_SESSION['mode'];
  ?>