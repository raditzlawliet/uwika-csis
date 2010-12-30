<?php
$set_height_mk_list = 250;
if(!isset($_COOKIE['set_height_mk_list'])){
	setcookie('set_height_mk_list', "250", time()+3600, "/");
}
$set_height_mk_list = $_COOKIE["set_height_mk_list"];

//session_start();
include 'transfer_mk.php';

$uid = htmlentities($_POST['uid']);
$nrp = htmlentities($_POST['nrp']);
$sms = htmlentities($_POST['sms']); //bt matkul
$code = htmlentities($_POST['code']); //buat mastiin
$kode_jurusan = htmlentities($_POST['kode_jurusan']); //buat mastiin
$probis = htmlentities($_POST['probis']); //buat mastiin

$masa = htmlentities($_POST['masa']); //bt student list
$show_msg = htmlentities($_POST['show_msg']); //bt student list

if($code=="list_student_mat_kul"){exit(getListMataKuliahPerNRP($nrp,$masa,isNowKRS(getValueSettingsOf("konfigurasi_manual")),$show_msg));}

?>

<script>
</script>