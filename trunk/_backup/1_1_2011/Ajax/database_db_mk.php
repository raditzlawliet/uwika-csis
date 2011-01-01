<?php
include 'transfer_mk2.php';

$code = htmlentities($_POST['code']);
$value = htmlentities($_POST['value']);
$value2 = htmlentities($_POST['value2']);
$kode_mk= htmlentities($_POST['kode_mk']);
switch($code){
	case 2 : {
			$data = explode("|",$value);
			$message = "Save Settings Success";
			setDataDatabaseMataKuliah($kode_mk,$data,$value2);
			exit($message);
		break;
	}
	case 1 : {
			$data = explode("|",$value);
			$message = "Add Data Success";
			addDataDatabaseMataKuliah($data);
			exit($message);
			break;
	}
	case 4 : {
			$message = "Remove Data Success";
			removeDataDatabaseMataKuliah($kode_mk,$value2);
			exit($message);
			break;	
	}
	case 'del_mk_m' :{
			$message = "Remove Data Success";
			delOneDataMataKuliahTRMahasiswa($kode_mk,$value);
			exit($message);
		break;
	}
	case 'del_mk_j' :{
			$message = "Remove Data Success";
			delOneDataMataKuliahTRJurusan($kode_mk,$value);
			exit($message);
		break;
	}
	case 'del_mk_s' :{
			$message = "Remove Data Success";
			delOneDataMataKuliahTRSyarat($kode_mk,$value);
			exit($message);
		break;
	}
	case 'del_mk_d' :{
			$message = "Remove Data Success";
			delOneDataMataKuliahTRDosen($kode_mk,$value);
			exit($message);
		break;
	}
	case 'getlastcode' :{
		$d = getLastCode($kode_mk);
		exit($d);
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