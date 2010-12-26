<?php
session_start();
include 'transfer.php';

$code = htmlentities($_POST['code']);

if($code=="cancel_class"){
	$kode_mk = htmlentities($_POST['kode_mk']);
	$nrp = htmlentities($_POST['nrp']);
	$masa = htmlentities($_POST['masa']);
	removeStudentRegisteredMataKuliah($kode_mk,$nrp,$masa);
	exit("1");
}

if($code=="register_class"){
	$kode_mk = htmlentities($_POST['kode_mk']);
	$nrp = htmlentities($_POST['nrp']);
	$masa = htmlentities($_POST['masa']);
	$sks_m = getSKSMahasiswa($nrp);
	$sks_mk = getSKSMataKuliah($kode_mk);
	$sks = $sks_m - $sks_mk;
	if($sks<0){
		exit("0");
	}else{
		addStudentRegisteredMataKuliah($kode_mk,$nrp,$masa,$sks);
	}
	exit("1");
}
?>