<?php
session_start();
$code = htmlentities($_REQUEST['code']);
switch($code){
	case 1 : {
			setcookie("login","",time()-3600, '/');
			session_unset();
			session_destroy();
			if(!isset($_COOKIE['login'],$_SESSION['md5nrp'],$_SESSION['uid'])){
				$status_logoff = array('status'=>'1');
				$status_logoff = json_encode($status_logoff);
				exit($status_logoff);
			}else{		
				$status_logoff = array('status'=>'0');
				$status_logoff = json_encode($status_logoff);
				exit($status_logoff);
			}
		break;
	}
}
?>
