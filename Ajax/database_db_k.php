<?php
include 'transfer_k.php';

$code = htmlentities($_POST['code']);
$value = htmlentities($_POST['value']);
$value2 = htmlentities($_POST['value2']);
$set = htmlentities($_POST['setpassword']);
$nrp = htmlentities($_POST['nrp']);

switch($code){
	case 2 : {
			$data = explode("|",$value);
			$message = "Save Settings Success";
			setDataDatabaseKaryawan($nrp,$data,$set);
			exit($message);
		break;
	}
	case 1 : {
			$data = explode("|",$value);
			$message = "Add Data Success";
			addDataDatabaseKaryawan($nrp,$data,$set);
			exit($message);
			break;
	}
	case 4 : {
			$message = "Remove Data Success";
			removeDataDatabaseKaryawan($nrp);
			exit($message);
			break;	
	}
}
?>