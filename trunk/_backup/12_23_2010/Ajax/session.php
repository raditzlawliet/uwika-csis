<?php
include '../session.php';
session_start();
$code = htmlentities($_POST['code']);
switch($code){
	case 1 : {
		if(isset($_COOKIE['login'],$_SESSION['md5nrp'],$_SESSION['uid'],$_SESSION['turn'],$_SESSION['admin'])){
			if($_COOKIE['login']==1){
				if (check_session($_SESSION['md5nrp'],$_SESSION['uid'],$_SESSION['turn'])){
					$status = array('status'=>'1');
					$status = json_encode($status);
					exit($status);
				}else{
					$status = array('status'=>'0');
					$status = json_encode($status);
					exit($status);
				}
			}		
			else{
				$status = array('status'=>'0');
				$status = json_encode($status);
				exit($status);
			}
		}else{
			$status = array('status'=>'0');
			$status = json_encode($status);
			exit($status);
		}
		break;
	}
	case 5 : { //get giliran session
				$status = array('turn'=>$_SESSION['turn']);
				$status = json_encode($status);
				exit($status);
				break;
	}
	case 99 : {
				$a = $_COOKIE['login'];
				$b = $_SESSION['md5nrp'];
				$c = $_SESSION['uid'];
				$d = $_SESSION['turn'];
				$e = $_SESSION['admin'];
				$f = 'lgn : '.$a.'nrp : '.$b.'uid : '.$c.'turn : '.$d.'adm : '.$e;
				exit($f);
				break;
	}

}
?>
