<?php
include 'transfer_jf.php';

$code = htmlentities($_POST['code']);
$value = htmlentities($_POST['value']);
$value2 = htmlentities($_POST['value2']);
$nrp = htmlentities($_POST['nrp']);

switch($code){
	case 2 : {
			$data = explode("|",$value);
			$message = "Save Settings Success";
			setDataDatabaseJurusan($nrp,$data);
			exit($message);
		break;
	}
	case 1 : {
			$data = explode("|",$value);
			$message = "Add Data Success";
			addDataDatabaseJurusan($data);
			exit($message);
			break;
	}
	case 4 : {
			$message = "Remove Data Success";
			removeDataDatabaseJurusan($nrp);
			exit($message);
			break;	
	}
	case 22 : {
			$data = explode("|",$value);
			$message = "Save Settings Success";
			setDataDatabaseFakultas($nrp,$data);
			exit($message);
		break;
	}
	case 21 : {
			$data = explode("|",$value);
			$message = "Add Data Success";
			addDataDatabaseFakultas($data);
			exit($message);
			break;
	}
	case 24 : {
			$message = "Remove Data Success";
			removeDataDatabaseFakultas($nrp);
			exit($message);
			break;	
	}
	case 'refresh_sks_db_mhs' :{
		$message = "Reset Successfull";
		resetDataSKSDatabaseMahasiswa(1);
		exit($message);
		break;
	}
	
	case 'reset_semester' :{
		if($value2=="true"){
			$message = "Added 1 Semester to all students Successfull";
			setSemesterPlusToAll($v,1,true);
			exit($message);
			break;
		}else{
			$message = "Decrease 1 Semester to all students Successfull";
			setSemesterPlusToAll($v,1,false);
			exit($message);
			break;
		}
		exit($value2);
	}
	case 'semester_decrease_one' :{
		$message = "Decrease 1 Semester to all students Successfull";
		setSemesterPlusToAll($v,1,false);
		exit($message);
		break;
	}
}
?>