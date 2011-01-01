<?php
$set_height_mk_list = 250;
if(!isset($_COOKIE['set_height_mk_list'])){
	setcookie('set_height_mk_list', "250", time()+3600, "/");
}
$set_height_mk_list = $_COOKIE["set_height_mk_list"];

session_start();
include 'transfer.php';

$uid = htmlentities($_POST['uid']);
$nrp = htmlentities($_POST['nrp']);
$data_profile = getProfile($uid,$_SESSION['turn']);
$sms = htmlentities($_POST['sms']); //bt matkul
$code = htmlentities($_POST['code']); //buat mastiin
$kode_jurusan = htmlentities($_POST['kode_jurusan']); //buat mastiin
$probis = htmlentities($_POST['probis']); //buat mastiin

$masa = htmlentities($_POST['masa']); //bt student list
$show_msg = htmlentities($_POST['show_msg']); //bt student list

if($code=="list_student_mat_kul"){exit(getListMataKuliahPerNRP($nrp,$masa,isNowKRS(getValueSettingsOf("konfigurasi_manual")),$show_msg));}

if($code=="mat_kul"){
/*	switch($sms){
		case 0: {
				exit("Please, Choose the right semester");
			break;
		}
		case 1: {
			$mk = '<ul>
			<li>md5nrp : '.$_SESSION['md5nrp'].'</li>
			<li>turn : '.$_SESSION['turn'].'</li>
			<li>admin : '.$_SESSION['admin'].'</li>
			<li>uid : '.$_SESSION['uid'].'</li>
			<li>cookies : '.$_COOKIE['login'].'</li>
			</ul>
			';
				exit($mk);
			break;
		}
		default:{exit("Wrong ?? contact administrator !!");
			break;
		}
	}*/
		if($sms>0 && $sms<=8){
			
			if(!isset($_COOKIE['set_height_mk_list'])){
				$set_height_mk_list = 250;
			}
			$mk = '<div id="red_mozilla" style="width:50%;"><b>Hint!</b> Choose the Mata Kuliah down here, by click it.<br>Default Height Scroll "description of Mata Kuliah" when you click it is <b>250px</b>,<br>
			<form action="javascript:SetHeightMkClick(this)" method="post">set your default here : 
			<input id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
			<input id="SetHeightMk" name="SetHeightMk" style="font-size:9px;font-weight:bold;border:1px solid #FFE6E7;background:#D2FFD5;"type="submit" value="SET" />				
			</form>
			</div><p>
			<div id="list_mat_kul2">
				<div id="header_krs_semester">L I S T &nbsp; &nbsp; M A T A &nbsp; &nbsp; K U L I A H &nbsp; &nbsp; S E M E S T E R &nbsp; &nbsp; '.$sms.'</div>
			';
			$mk = $mk.getListMataKuliahPerSemester($kode_jurusan,$sms,$probis,$nrp);
/*			$mk = '<ul>
			<li>md5nrp : '.$_SESSION['md5nrp'].'</li>
			<li>turn : '.$_SESSION['turn'].'</li>
			<li>admin : '.$_SESSION['admin'].'</li>
			<li>uid : '.$_SESSION['uid'].'</li>
			<li>cookies : '.$_COOKIE['login'].'</li>
			</ul>
			'; */
			$mk = $mk.'
			<p></div><p>
			<script>
			function GoDAFTARKRSMK(kode_mk,uid){
				data = "&uid=" + encodeURI(uid) + "&kode_mk=" + encodeURI(kode_mk) + "&semester=" + encodeURI("'.$sms.'");
				ShowHiddenPanel(true,\'krs_list_mk\',\'Ajax/panel.php\',\'.main_panel\',data);
			}
			function SetHeightMkClick(FormSetHeightMkClick){
				var temp = parseInt(document.getElementById("set_height_mk_list").value);
				if (isNaN(temp)){
					alert("Please, Input a Number !!");
				}else{
					if (temp>99999||temp<50){
						alert("Setting Height : Minimal 50px, Maximal 99999px");
					}else{
						setCookie("set_height_mk_list",temp,1)
					}
				}
			}
			</script>';
			exit($mk);
		}else{
			exit("Wrong ? or something you want to illegal access ?");
		}
}

?>
<input onclick=""/>