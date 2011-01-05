<?php
session_start();
include 'transfer.php';

$code = htmlentities($_POST['code']); //buat mastiin
$uid = htmlentities($_POST['uid']); //buat mastiin

if (!$code=="krs"){
	echo("You have login first.");
}else{
		$data_profile = getProfile($uid,$_SESSION['turn']);
		$opt_sms = '<option value="0">Choose it</option>';
		if(getValueSettingsOf("konfigurasi_manual")==1){
//			$a = "manua";
			$sms;
			if(getValueSettingsOf("semester")%2==0){
				$sms = explode(",",getValueSettingsOf("semester_genap"));
			}else{
				$sms = explode(",",getValueSettingsOf("semester_ganjil"));
			}
			for($i = 0;$i<sizeof($sms);$i++){
				$opt_sms = $opt_sms.'<option value="'.$sms[$i].'">Semester '.$sms[$i].'</option>';
			}
		}else{
//			$a = "auto";
		}
		$out = '
		<center><h1><b>K &nbsp; R &nbsp; S</b></h1>
		<p>
		<div id="krs_profile_student"><table id="krs_profile_student">
			<tr>
					<td width="20%" id="ERbold">N R P </td><td width="4%" id="EL"> : </td><td>'.$data_profile["nrp"].'</td>
			</tr>
			<tr>
				<td id="ERbold">Nama </td><td id="EL"> : </td><td>'.$data_profile["nama"].'</td>
			</tr>
			<tr>
				<td id="ERbold">Fakultas </td><td id="EL"> : </td><td >'.$data_profile["nama_fakultas"].'</td>
			</tr>
			<tr>
				<td id="ERbold">Jurusan </td><td id="EL"> : </td><td >'.$data_profile["nama_jurusan"].'</td>
			</tr>
			<tr>
				<td id="ERbold">Semester </td><td id="EL"> : </td><td>'.$data_profile["semester"].'</td>
			</tr>
			<tr>
				<td id="ERbold">SKS </td><td id="EL"> : </td><td class="krs_sisa_sks">'.$data_profile["sisa_sks"].'</td>
			</tr>
		</table>
		</div>
			<div id="red_mozilla"> <b>Hint!</b> For Mozzila Browser, Please using Mouse to select or "<b>Enter</b>" key.</div>
			<p>Select your Semester that you want see list of Mata Kuliah : 
			<select onchange="javascript:isi_mat_kul(this);" name="semester_combobox" title="Semester" dir="ltr">
			'.$opt_sms.'
            </select>
			<div id="list_mat_kul">

			</div>
            
            </center>
			<script>
					function test(msg){
						$("#krs_profile_student").append(msg+"<br>");
					}
					function isi_mat_kul(semester){
						var pil_semester = semester.value;
						$("#list_mat_kul").html("");
						if(pil_semester==0){
							$("#list_mat_kul").html("");
						}else{
							$.post("Ajax/mk.php",{code:"mat_kul", sms:pil_semester, probis:"'.$data_profile["probis"].'",kode_jurusan:"'.$data_profile["kode_jurusan"].'",uid:"'.$_SESSION["uid"].'"}, function(data) {
 							 $("#list_mat_kul").html("");
							 $("#list_mat_kul").html(data);
							});
						}
					}
			</script>
			
		';
		exit($out);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
		847a3654ac83afc8878c21550977b1a2 (Do not remove this code)
        This website has created by Radityo Hernanda, Bobby Handoko, Evan Sutrisno and Ferry Naga. Copyright 2010.
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Campus System Information Student</title>
<link href="../index.css" rel="stylesheet" type="text/css" />
<link href="../main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.4.3.min.js"></script></head>
<body id="main">

		<center><h1><b>K &nbsp; R &nbsp; S</b></h1>
		<p>
		<div id="krs_profile_student"><table id="krs_profile_student">
			<tr>
					<td width="20%" id="ERbold">N R P </td><td width="4%" id="EL"> : </td><td>'.$data_profile["nrp"].'</td>
			</tr>
			<tr>
				<td id="ERbold">Nama </td><td id="EL"> : </td><td>'.$data_profile["nama"].'</td>
			</tr>
			<tr>
				<td id="ERbold">Fakultas </td><td id="EL"> : </td><td >'.$data_jurusan["nama_fakultas"].'</td>
			</tr>
			<tr>
				<td id="ERbold">Teknik </td><td id="EL"> : </td><td >'.$data_jurusan["nama_jurusan"].'</td>
			</tr>
			<tr>
				<td id="ERbold">Semester </td><td id="EL"> : </td><td>'.$data_profile["semester"].'</td>
			</tr>
			<tr>
				<td id="ERbold">SKS </td><td id="EL"> : </td><td>'.$data_profile["sisa_sks"].'</td>
			</tr>
		</table>
		</div>
			<div id="red_mozilla"> &nbsp; For Mozzila Browser, Please using Mouse to select or "<b>Enter</b>" key.</div>
			<p>Select your Semester that you want see list of Mata Kuliah : 
			<select onchange="javascript:isi_mat_kul(this);" name="semester_combobox" title="Semester" dir="ltr">
              <option value="0"> </option>
              <option value="1">Semester 1</option>
              <option value="2">Semester 2</option>
              <option value="3">Semester 3</option>
              <option value="4">Semester 4</option>
              <option value="5">Semester 5</option>
              <option value="6">Semester 6</option>
              <option value="7">Semester 7</option>
              <option value="8">Semester 8</option>
            </select>
			<div id="list_mat_kul">
            <div style="overflow:scroll; height:100px; width:300px;">

<p>

Pay attention to my coding style - you may learn something

about formatting code so that it's easier to read!

</p>

<p>

In your actual page you should have much more text to see the

scrolling action do its thing - I kept it short for the article ...

</p>

</div>
			</div>
            
            </center>	
			<script>
					function test(msg){
						$("#krs_profile_student").append(msg+"<br>");
					}
					/*function isi_mat_kul(semester){
						var pil_semester = semester.value;
						$("#list_mat_kul").html("");
						if(pil_semester==0){
							$("#list_mat_kul").html("");
						}else{
							$.post("Ajax/mkx.php",{code:"mat_kul", sms:pil_semester}, function(data) {
							 $("#list_mat_kul").html(data);
							});
						}
					}*/
			</script>
            </center>
		
		
</body></html>