<?php
include '../session.php';
session_start();
$code = htmlentities($_REQUEST['code']);
switch($code){
	case 1 : {
		if($_COOKIE['login']==1){	
			if (check_session($_SESSION['md5nrp'],$_SESSION['uid'])){
				$status = array('status'=>'1');
				$status = json_encode($status);
				exit($status);
			}
		}
		else{
			$status = array('status'=>'0');
			$status = json_encode($status);
			exit($status);
		}
		break;
	}
}
?>