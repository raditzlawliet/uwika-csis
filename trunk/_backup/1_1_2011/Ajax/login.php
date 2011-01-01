<?php
include '../auth.php';

if((isset($_POST['username']))&&(isset($_POST['password']))){
	$username = htmlentities($_POST['username']);
	$password = htmlentities($_POST['password']);

	if(empty($username)){
		if(empty($password)){
			$alert_login = array('status'=>'0', 'message'=>'Please, Write down your username as NRP / Email and your Password.');
			$alert_login = json_encode($alert_login);
			exit($alert_login);
		}
		$alert_login = array('status'=>'0', 'message'=>'Please, Write down your username as NRP / Email.');
		$alert_login = json_encode($alert_login);
		exit($alert_login);
	}
	if(empty($password)){
		$alert_login = array('status'=>'0', 'message'=>'Please, Write down your Password.');
		$alert_login = json_encode($alert_login);
		exit($alert_login);
	}
	if(!auth_first($username,$password)){
		$alert_login = array('status'=>'0', 'message'=>'Wrong NRP / Email and Password combination.');
		$alert_login = json_encode($alert_login);
		exit($alert_login);
	}else{
		$alert_login = array('status'=>'1', 'message'=>'Waiting for login. . .');
		$alert_login = json_encode($alert_login);
		exit($alert_login);
	}
}

if(isset($_POST['id'])){
	
	$delete = delete_comment($_POST['id']);
	
	if($delete == true){
		
		$alert_login = array('status'=>'1','id'=>$_POST['id']);
		$alert_login = json_encode($alert_login);
		exit($alert_login);
	}
	else{
		
		$alert_login = array('status'=>'0', 'message'=>'Error deleting comment.');
		$alert_login = json_encode($alert_login);
		exit($alert_login);
	}
}
?>
