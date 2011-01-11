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
	
	case 'refresh_ips_all' :{
		$message = "Reset IPS semua mahasiswa dan semua semester sukses";
		resetIPSAll();
		exit($message);
		break;
	}
	case 'refresh_ipk_all' :{
		$message = "Reset IPK semua mahasiswa sukses";
		resetIPKAll();
		exit($message);
		break;
	}
	case 'refresh_lulus_all' :{
		$message = "Reset KELULUSAN semua mahasiswa sukses";
		resetLulus(7,0,0,0,0);
		exit($message);
		break;
	}
	case 'refresh_lulus_nrp' :{
		$message = "Reset KELULUSAN mahasiswa ".$nrp." semua MK di semua SEMESTER sukses";
		resetLulus(1,$nrp,0,0,0);
		exit($message);
		break;
	}
	case 'refresh_lulus_nrp_sms' :{
		$message = "Reset KELULUSAN mahasiswa ".$nrp." semua MK di SEMESTER ".$value." sukses";
		resetLulus(5,$nrp,0,0,$value);
		exit($message);
		break;
	}
	case 'refresh_lulus_nrp_sms_mk' :{
		$message = "Reset KELULUSAN mahasiswa ".$nrp." MK ".$kode_mk." di SEMESTER ".$value." sukses";
		resetLulus(6,$nrp,$kode_mk,0,$value);
		exit($message);
		break;
	}
	case 'refresh_lulus_mk' :{
		$message = "Reset KELULUSAN MK ".$kode_mk." semua MAHASISWA di semua MASA sukses";
		resetLulus(2,0,$kode_mk,0,0);
		exit($message);
		break;
	}
	case 'refresh_lulus_mk_masa' :{
		$message = "Reset KELULUSAN MK ".$kode_mk." semua MAHASISWA di MASA ".$value." sukses";
		resetLulus(3,0,$kode_mk,$value,0);
		exit($message);
		break;
	}
	case 'refresh_lulus_masa' :{
		$message = "Reset KELULUSAN MASA ".$nrp." semua MAHASISWA di MASA ".$nrp." , dan MK DI MASA ".$nrp." sukses";
		resetLulus(4,0,0,$nrp,0);
		exit($message);
		break;
	}
	
	
	case 'refresh_ips_' :{
		$message = "Reset IPS mahasiswa ".$nrp." dan semua semester sukses";
		resetIPSnrp($nrp);
		exit($message);
		break;
	}
	case 'refresh_ips' :{
		$message = "Reset IPS mahasiswa ".$nrp." dan semester ".$value." sukses";
		resetIPSsms($nrp,$value);
		exit($message);
		break;
	}
	case 'refresh_ipk' :{
		$message = "Reset IPK mahasiswa ".$nrp." sukses";
		resetIPKnrp($nrp);
		exit($message);
		break;
	}
	case 'semester_decrease_one' :{
		$message = "Decrease 1 Semester to all students Successfull";
		setSemesterPlusToAll($v,1,false);
		exit($message);
		break;
	}
}
?>