<?php
include 'transfer_sc.php';

$code = htmlentities($_POST['code']);
$value = htmlentities($_POST['value']);
$value2 = htmlentities($_POST['value2']);
$nrp = htmlentities($_POST['nrp']);
$kode_mk= htmlentities($_POST['kode_mk']);

switch($code){
	case 2 : {
			$data = explode("|",$value);
			$message = "Save Settings Success";
			setDataDatabaseIPS($nrp,$value2,$data);
			exit($message);
		break;
	}
	case 1 : {
			$data = explode("|",$value);
			$message = "Add Data Success";
			addDataDatabaseIPS($data);
			exit($message);
			break;
	}
	case 4 : {
			$message = "Remove Data Success";
			removeDataDatabaseIPS($nrp,$value);
			exit($message);
			break;	
	}
	case 22 : {
			$data = explode("|",$value);
			$message = "Save Settings Success";
			setDataDatabaseNilai($kode_mk,$nrp,$data);
			exit($message);
		break;
	}
	case 21 : {
			$data = explode("|",$value);
			$message = "Add Data Success";
			addDataDatabaseNilai($data);
			exit($message);
			break;
	}
	case 24 : {
			$data = explode("|",$value);
			$message = "Remove Data Success";
			removeDataDatabaseNilai($kode_mk,$nrp,$data);
			exit($message);
			break;	
	}
	case 'getLastSemester' :{
		$message = getLastSemester($nrp);
		exit($message);
		break;
	}
	case 'getMasaNow' :{
		$message = getMasaNow();
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