<?php
session_start();
include 'transfer.php';

$code = htmlentities($_POST['code']);

if($code=="cancel_class"){
	$kode_mk = htmlentities($_POST['kode_mk']);
	$nrp = htmlentities($_POST['nrp']);
	$masa = htmlentities($_POST['masa']);
	$uid = getUidByNRP($nrp);
	if($_SESSION['uid']!=$uid){exit("99999");}
	removeStudentRegisteredMataKuliah($kode_mk,$nrp,$masa);
	getMataKuliahFromSyaratThenRemoveIt($kode_mk,$nrp,$masa);
	exit("1");
}

if($code=="register_class"){
	$kode_mk = htmlentities($_POST['kode_mk']);
	$nrp = htmlentities($_POST['nrp']);
	$masa = htmlentities($_POST['masa']);
	$sks_m = getSKSMahasiswa($nrp);
	$sks_mk = getSKSMataKuliah($kode_mk);
	$sks = $sks_m - $sks_mk;
	$uid = getUidByNRP($nrp);
	if($_SESSION['uid']!=$uid){exit("99999");}
	if($sks<0){
		exit("0");
	}else{
		$s_r = getStudentIsRegisteredMataKuliah($kode_mk,$nrp);
				if($s_r['ada']){
					if($s_r['lulus']=="1"){
//							$ac = "a"; //already
					}else{					
						if($s_r['masa']==$masa){
//							$ac = "v"; //sudah regist skrng
							exit("0");
						}
					}
				}
		addStudentRegisteredMataKuliah($kode_mk,$nrp,$masa,$sks);
	}
	exit("1");
}

if($code=="refresh_sks"){
	$nrp = htmlentities($_POST['nrp']);
	$sks = getSKSMahasiswa($nrp);
	exit($sks);
}

?>

