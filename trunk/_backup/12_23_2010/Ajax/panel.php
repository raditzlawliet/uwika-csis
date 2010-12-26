<?php
session_start();
include 'transfer.php';

$code = htmlentities($_POST['code']);
$code_panel = htmlentities($_POST['code_panel']);
$code_hidden = htmlentities($_POST['code_hidden']);
switch($code){
	case 1 : { //login panel
			$header_login = "<a id=\"header_id_login\" class=\"header_trigger\" onclick=\"javascript:header_login_click()\" href=\"#!\">LOGIN</a>";
			exit($header_login);
		break;
	}
	case 2 : { //logoff panel
			$header_logoff = '<a id="header_id_logoff" class="header_trigger" onclick="javascript:header_logoff_click()" href="#!">LOGOFF</a>';
			exit($header_logoff);
		break;
	}
	case 3 : { //account panel
			$header_logoff = "<a id=\"header_id_account\" class=\"header_trigger\" onclick=\"javascript:header_account_click()\" href=\"#!\">ACCOUNT</a>";
			exit($header_logoff);
		break;
	}
	case 4 : { //info student panel
			$header_logoff = "<a id=\"header_id_student\" class=\"header_trigger\" onclick=\"javascript:header_student_click()\" href=\"#!\">STUDENT<br \>INFORMATION</a>";
			exit($header_logoff);
		break;
	}
	case 5 : { //info student panel
			$header_logoff = "<a id=\"header_id_faculty\" class=\"header_trigger\" onclick=\"javascript:header_faculty_click()\" href=\"#!\">FACULTY<br \>INFORMATION</a>";
			exit($header_logoff);
		break;
	}
	case 6 : { //info student panel
			$header_logoff = "<a id=\"header_id_employee\" class=\"header_trigger\" onclick=\"javascript:header_employee_click()\" href=\"#!\">EMPLOYEE<br \>INFORMATION</a>";
			exit($header_logoff);
		break;
	}
	case 7 : { //admin panel
			$header_logoff = "";
			if(isset($_SESSION['admin'])){
				if($_SESSION['admin']>=900){
					$header_logoff = "<a id=\"header_id_admin\" class=\"header_trigger\" onclick=\"javascript:header_admin_click()\" href=\"#!\">ADMIN</a>";
				}
			}else{
			}
			exit($header_logoff);
		break;
	}
}
switch($code_panel){
	case 1: { //login
			$header_login_panel = "<div class=\"header_panel\" id=\"header_id_login_panel\">
			<form action=\"javascript:PostLogin()\" method=\"post\">
			<table>
				<tr>
                	<td>USERNAME&nbsp;&nbsp;</td>
                    <td><input id=\"username\" name=\"username\" type=\"text\" size=\"20\" maxlength=\"50\" /></td>
                </tr>
            	<tr>
                	<td>PASSWORD&nbsp;&nbsp;</td>
                    <td><input id=\"password\" name=\"password\" type=\"password\" size=\"20\" maxlength=\"15\"/></td>
                </tr></table><table style=\"padding-left:50px;\">
				<tr>
					<td><a class=\"header_login_cancel\" onclick=\"javascript:header_login_cancel_click()\" href=\"#!\"></a></td>
                </tr>
            </table>
			<table style=\"position:fixed;right:30px;top:73px;\">
					<tr><td><input id=\"submit\" class=\"submit\" name=\"tombol\" type=\"submit\" value=\"SUBMIT\" /></td>
                    </tr>
            </table>
            &nbsp;<div id=\"alert_login\">&nbsp;</div>
			</form>
			</div>
			<script>$(function() {
			$(\".submit\")
					.click(function() {
						InitializeTimer();  //di html awal
						$(\"#alert_login\").html(\"Loading ... (<i>Login Require Cookies</i>)\");
					})
					.throbber();
			$(\".submit\")
				.click(function() {
					$(\"#loading\").html(\"Loading stopped!\");
					$.throbberHide();
				})
			$(\"#ajax\")
				.click(function() {
					$(\"#ajax-target\").load(\"demo_content.html\");
				})
				.throbber();
			});
			function header_login_click(){
							$(\"#header_id_login_panel\").toggle(\"fast\");
							$(\"#header_id_login\").toggleClass(\"active\");
							return false;
			}
			function header_login_cancel_click(){
							$(\"#header_id_login_panel\").toggle(\"fast\");
							$(this).toggleClass(\"active\");
							$(\"#header_id_login\").toggleClass(\"active\");
							return false;
			}
			</script>";
			exit($header_login_panel);
		break;
	}
	case 2 : { //logoff panel
		$header_logoff_panel = '<script>StopTheClock();function header_logoff_click(){PostLogoff();}</script>';
		exit($header_logoff_panel);
		break;
	}
	case 3 : { //account panel
		$data_profile = getProfile($_SESSION['uid'],$_SESSION['turn']);
		$header_logoff_panel = '
		<div class="header_panel" id="header_id_account_panel">
		<ul>
		<li id="menu_profile"><a onclick="javascript:GoPROFILE()" href="#!profile.php?id='.$data_profile['nrp'].'" id="menu_profile_pic"><table><tr><td><img id="menu_profile_pic_p" src="images/jon_image.jpg" weight="50" height="50" alt="Profile Name" /></td><td><em id="menu_profile_text">'.$data_profile['nama'].'</em></td></tr></table></a></li>
		<li><a onclick="javascript:GoHOME()" href="#!home.php">H O M E</a></li>
		<li><a onclick="javascript:GoCONFIGURATIONMENU()" href="#!configurationaccount.php">CONFIGURATION &nbsp; ACCOUNT</a></li>
		<li><a onclick="javascript:GoBACKEND()" href="#!back-end.php">BACK-END</a></li>
		</ul>
		</div>
		<script>function header_account_click(){
					InitializeTimerCekSession();
					collapseLastActivePanelHome(3);
					setActivePanelHome(3);
					$("#header_id_account_panel").toggle("fast");
					$("#header_id_account").toggleClass("active");
				}
				function GoPROFILE(){
					header_account_click();
					$("#main").load("Ajax/profile.php?id='.$data_profile['nrp'].'");
				}
				function GoHOME(){
					header_account_click();
					ShowHiddenPanel(true,\'agreement\',\'Ajax/panel.php\',\'.main_panel\');
				}
				function GoCONFIGURATIONMENU(){
					header_account_click();
					ShowHiddenPanel(true,\'agreement\',\'Ajax/panel.php\',\'.main_panel\');
				}
				function GoBACKEND(){
					header_account_click();
					ShowHiddenPanel(true,\'agreement\',\'Ajax/panel.php\',\'.main_panel\');
				}
		</script>';
		exit($header_logoff_panel);
		break;
	}
	case 4 : { //st7udent panel
		$data_profile = getProfile($_SESSION['uid'],$_SESSION['turn']);
		$f = '<div class="header_panel" id="header_id_student_panel"><ul>';
		$c = '';
		switch($_SESSION['turn']){
			case 0 : {
				$c = '	<li><a onclick="javascript:GoKRS();" href="#!krs">K R S</a></li>
						<li><a onclick="javascript:GoLIBRARY();" href="#!krs">L I B R A R Y</a></li>
						<li><a onclick="javascript:GoELEARNING();" href="#!krs">E &nbsp; - &nbsp; L E A R N I N G</a></li>
				 ';
				 break;
			}
			case 1 : {
				$c = '	<li><a onclick="javascript:GoINFORMATIONSTUDENT();" href="#!krs">I N F O R M A T I O N&nbsp; &nbsp; &nbsp;&nbsp;S T U D E N T</a></li>
				';
				 break;
			}
			case 2 : {
				$c = '	<li><a onclick="javascript:GoINFORMATIONSTUDENT();"href="#!krs">I N F O R M A T I O N&nbsp; &nbsp; &nbsp;&nbsp;S T U D E N T</a></li>
				';
				 break;
			}
		}
		$b = '</ul></div>
		<script>function header_student_click(){
					InitializeTimerCekSession();
					collapseLastActivePanelHome(4);
					setActivePanelHome(4);
					$("#header_id_student_panel").toggle("fast");
					$("#header_id_student").toggleClass("active");
				}
				function GoKRS(){
					header_student_click();
					$.post("Ajax/krs.php",{code:"krs", uid:"'.$_SESSION["uid"].'"}, function(data) {
					  $("#main").html("");
					  $("#main").append(data);
					});
				}
				function GoLIBRARY(){
					header_student_click();
				}
				function GoELEARNING(){
					header_student_click();
				}
				function GoINFORMATIONSTUDENT(){
					header_student_click();
				}
		</script>';
		$header_logoff_panel = $f.$c.$b;
		exit($header_logoff_panel);
		break;
	}
	case 5 : { //faculty panel
		$data_profile = getProfile($_SESSION['uid'],$_SESSION['turn']);
		$header_logoff_panel = '
		<div class="header_panel" id="header_id_faculty_panel">
		<ul>
		<li><a onclick="javascript:GoFACULTYINFORMATION()" href="#!">F A C U L T Y &nbsp; &nbsp; &nbsp; I N F O R M A T I O N</a></li>
		</ul>
		</div>
		<script>function header_faculty_click(){
			InitializeTimerCekSession();
			collapseLastActivePanelHome(5);
			setActivePanelHome(5);
			$("#header_id_faculty_panel").toggle("fast");
			$("#header_id_faculty").toggleClass("active");
		}
			function GoFACULTYINFORMATION(){
				header_faculty_click();
			}
		</script>';
		exit($header_logoff_panel);
		break;
	}
	case 6 : { //employee panel
		$data_profile = getProfile($_SESSION['uid'],$_SESSION['turn']);
		$header_logoff_panel = '
		<div class="header_panel" id="header_id_employee_panel">
		<ul>
		<li><a onclick="javascript:GoEMPLOYEEINFORMATION()" href="#!">E M P L O Y E E &nbsp; &nbsp; &nbsp; I N F O R M A T I O N</a></li>
		</ul>
		</div>
		<script>function header_employee_click(){
			InitializeTimerCekSession();
			collapseLastActivePanelHome(6);
			setActivePanelHome(6);
			$("#header_id_employee_panel").toggle("fast");
			$("#header_id_employee").toggleClass("active");
		}
			function GoEMPLOYEEINFORMATION(){
				header_employee_click();
			}
		</script>';
		exit($header_logoff_panel);
		break;
	}
	case 7 : { //admin panel
		$data_profile = getProfile($_SESSION['uid'],$_SESSION['turn']);
		$header_logoff_panel = "";
		if(isset($_SESSION['admin'])){
			if($_SESSION['admin']>=900){
				$header_logoff_panel = '
				<div class="header_panel" id="header_id_admin_panel">
				<ul>
				<li><a onclick="javascript:GoSETTINGS();" href="#!">S E T T I N G S</a></li>
				</ul>
				</div>
				<script>function header_admin_click(){
					InitializeTimerCekSession();
					collapseLastActivePanelHome(7);
					setActivePanelHome(7);
					$("#header_id_admin_panel").toggle("fast");
					$("#header_id_admin").toggleClass("active");
				}
				function GoSETTINGS(){
					header_admin_click()
					ShowHiddenPanel(true,"admin_settings","Ajax/panel.php",".main_panel");
				}
				</script>';
			}
		}
		exit($header_logoff_panel);
		break;
	}
	
}

switch($code_hidden){
	case 'agreement' : { //login panel
			$panel_hidden = '<div id="main_id_agreement_panel"><b><center>Agreement You Have to Read Before Using This Web</center></b>
			<p>1. Everything you do in this website, and something wrong. You will be the fault.<br \>
			<p>2. Whatever if you try to skip this messages using another bug, I claim you have read this messages.
			<br \>
			Thank you.
			<p><table style="text-align:center;" width=100%><tr><td><a onclick="javascript:Agreeclick();" class="button" id="diff_blue" href=#!><b>AGREE</b></a></td><td><a onclick="javascript:DisAgreeclick();" class="button" href=#!><b>DISAGREE</b></a></td></tr></table>
			</div>
			<script>
			function Agreeclick(){
				$("#main").load("Ajax/profile.php");
				HidePanel();
				InitializeTimer();
				InitializeTimerCekSession();
				resetActiveCollapsePanelHome();
			}
			function DisAgreeclick(){HidePanel();PostLogoff();}
			</script>';
			exit($panel_hidden);
		break;
	}
	case 'admin_settings' : { //admin
			$n = array(1=>'semester_ganjil_mulai',
					   2=>'semester_ganjil_selesai',
					   3=>'semester_genap_mulai',
					   4=>'semester_genap_selesai',
					   
					   5=>'tanggal_krs_semester_ganjil_mulai',
					   6=>'tanggal_krs_semester_ganjil_selesai',
					   7=>'tanggal_krs_semester_genap_mulai',
					   8=>'tanggal_krs_semester_genap_selesai',
					   9=>'jatah_hari_krs',
					   10=>'jatah_bulan_semester',
					   
					   51=>'semester',
					   52=>'semester_awal',
					   53=>'semester_akhir',
					   54=>'tanggal_krs_mulai',
					   55=>'tanggal_krs_selesai',
					   56=>'tahun',

					   91=>'konfigurasi_manual',
					   92=>'semester_ganjil',
					   93=>'semester_genap'
					 );
			$settings = getSettings();
			$set_height = "350";
			if(isset($_COOKIE['set_height_mk_list'])){
				$set_height = $_COOKIE['set_height_mk_list'];
			}
			$i=1;
			do{
				$table = $table.'
				<tr><td style="text-transform:capitalize;" width="15%">'.$settings[$n[$i]]['settings'].'</td><td width="2%"> : </td><td><input id="set_admin_'.$i.'" value="'.$settings[$n[$i]]['value'].'" size="10"\></td><td>'.$settings[$n[$i]]['deskripsi'].' '/*.$settings[$n[$i]]['manual'].*/.'</td></tr>
				';
				$i++;
				if($i==11)$i=51;
				if($i==57)$i=91;
				if($i==94)$i=100;
			}while($i!=100);
			$panel_hidden = '<div><b><center>S E T T I N G S</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table>
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVESETTINGS()" class="button" href="#!"><b>SAVE SETTINGS</b></a></td><td><a onclick="javascript:CancelClick();" class="button" id="diff" href="#!"><b>CANCEL</b></a></td></tr></table>
			</div>
			<script>
			function CancelClick(){
				HidePanel();
			}
			function GoSAVESETTINGS(){
				var i=1;
				var value = "";
				do{
					var tmp = "set_admin_"+i;
					value = value +document.getElementById(tmp).value;
					i++;
					if(i==11)i=51;
					if(i==57)i=91;
					if(i==94)i=100;
					if(i!=100)value = value+"|";
				}while(i!=100);
				//alert(value);
				$.post("Ajax/settings.php",{value : value, code:"save_settings_admin"}, function(data) {
					alert(data);
					if(data=="Save Settings Sukses"){
						HidePanel();
					}else{
					}
				}); 			
			}
			</script>';
			exit($panel_hidden);
		break;
	}
	case 'krs_list_mk' : { //list mk
			$set_height = "350";
			$uid = htmlentities($_POST['uid']);
			$kode_mk = htmlentities($_POST['kode_mk']);
			$data_profile = getProfile($uid,$_SESSION['turn']);
			$data_mk = getMataKuliah($kode_mk);
			if(isset($_COOKIE['set_height_mk_list'])){
				$set_height = $_COOKIE['set_height_mk_list'];
			}
//			$panel_hidden = '<div><b><center><br \>'.$uid.' <br \>'.$kode_mk.'';
			$sks_n = getSKSMahasiswa($data_profile['nrp']);
			$sks_n_mk = getSKSMataKuliah($kode_mk);
			$t_thn = getValueSettingsOf('tahun');
			$t_sms = getValueSettingsOf('semester');
			$list_mk_student = getListStudentRegisteredMataKuliah($kode_mk,$t_thn,$t_sms);
			$t1 = '<a onclick="javascript:Cancel_Class_Click();" class="button" href="#!krs.php?mk=T2012?go=cancel">';
			$t2 = '<a onclick="javascript:Register_Class_Click();" class="button" href="#!"krs.php?mk=T2012?go=regist">';
			$t3 = '<a class="button" id="dead">';
			$s_r = getStudentIsRegisteredMataKuliah($kode_mk,$data_profile['nrp']);
			$masa = getMasa($t_thn,$t_sms);
			if($s_r['ada']){
				if($s_r['masa']==$masa){
					$t_c = $t1;
				}else{
					$t_c = $t3;
					$set_height =$set_height-25;
					$e = "You Already Take this Mata Kuliah before<p>";
				}
				$t_r = $t3;
			}else{
				$t_c = $t3;
				$t_r = $t2;
			}
			$regist_cancel = '
			<td id="krs_cancel_class">'.$t_c.'<b>CANCEL THIS CLASS</b></a></td>
			<td id="krs_register_class">'.$t_r.'<b>REGISTER THIS CLASS</b></a></td>
			';
			$panel_hidden = '<div><b>
			<table style="background:#FFE1E2;font-weight:bold;padding-top:5px;padding-right:5px;padding-left:5px;text-transform:uppercase;letter-spacing:1px;width:100%;border:1px solid #ccc;border-bottom:none;">
			<tr><td style="width:6%;">NRP </td><td style="width:2%;">:</td><td style="width:30%;">'.$data_profile['nrp'].'</td>
			<td style="width:20%;">Fakultas - Jurusan </td><td style="width:2%;">:</td><td style="width:23%;">'.$data_profile['nama_fakultas'].' - '.$data_profile['nama_jurusan'].'</td></tr>
			<tr><td>Nama </td><td>:</td><td>'.$data_profile['nama'].'</td>
			<td>Semester - Angkatan </td><td>:</td><td>'.$data_profile['semester'].' - '.$data_profile['angkatan'].'</td></tr>
			</table>
			<table style="background:#D2FFD5;font-weight:bold;padding-bottom:5px;padding-right:5px;padding-left:5px;text-transform:uppercase;letter-spacing:1px;width:100%;border:1px solid #ccc;border-bottom:none;border-top:none;">
			<tr><td style="width:21%;">Kode Mata Kuliah </td><td style="width:2%;">:</td><td>'.$data_mk['kode_mata_kuliah'].'</td><td width="6%">S K S</td><td width="2%">:</td><td>'.$data_mk['jumlah_sks'].'</td></tr>
			<tr><td>Nama Mata Kuliah </td><td>:</td><td>'.$data_mk['nama_mata_kuliah'].'</td></tr>
			<tr><td>Jadwal </td><td>:</td><td>'.getHari($data_mk['hari']).', '.$data_mk['jam_mulai'].' - '.$data_mk['jam_selesai'].'</td><td width="6%">Quota</td><td width="2%">:</td><td>'.$data_mk['quota'].'</td></tr>
			<tr><td>Dosen Pengajar </td><td>:</td><td>'.$data_mk['nama'].' ('.$data_mk['nrp'].')</td><td width="6%">Registered</td><td width="2%">:</td><td>'.$data_mk['registered'].'</td></tr>
			</table>
			<div style="text-transform:uppercase;letter-spacing:1px;color:#A00;"><p><center><b>'.$e.'registered list of this mata kuliah</b><p></center></div>
			<div id="div_ov_list_mk_student" style="height:'.$set_height.'px;">
				<table id="list_mk_student">
					<tr id="header_table"><th>N R P</th><th>Name</th><th>Time Register</th><th>Fakultas - Jurusan</th><th>SMS - THN</th></tr>
					'.$list_mk_student.'
				</table>
			</div>
			<p><table style="float:right;"><tr>
			'.$regist_cancel.'
			<td><a onclick="javascript:CancelClick();" class="button" id="diff" href="#!"><b>CANCEL</b></a></td></tr></table>
			</div>
			<script>
			function CancelClick(){
				HidePanel();
			}
			function GoKRS_PROFILESTUDENT(nrp){
				alert(nrp);
			}
			function Cancel_Class_Click(){
				$.post("Ajax/mk_.php",{code:"cancel_class", kode_mk:"'.$data_mk['kode_mata_kuliah'].'", nrp:"'.$data_profile['nrp'].'", masa:"'.$masa.'"},
					function(data) {
						HidePanel();
						if(data==1){
							$(".krs_sisa_sks").html("'.($sks_n+$sks_n_mk).'");
							alert("Pembatalan Mata Kuliah '.$data_mk['nama_mata_kuliah'].' Sukses !");
						}else{
							alert("Pembatalan Mata Kuliah '.$data_mk['nama_mata_kuliah'].' Gagal !");
						}
						GoDAFTARKRSMK("'.$kode_mk.'","'.$_SESSION["uid"].'");
				});
			}
			function Register_Class_Click(){
				$.post("Ajax/mk_.php",{code:"register_class", kode_mk:"'.$data_mk['kode_mata_kuliah'].'", nrp:"'.$data_profile['nrp'].'", masa:"'.$masa.'"},
					function(data) {
						HidePanel();
						if(data==1){
							$(".krs_sisa_sks").html("'.($sks_n-$sks_n_mk).'");
							alert("Pendaftaran Mata Kuliah '.$data_mk['nama_mata_kuliah'].' Sukses !");
						}else if(data==0){
							alert("Pendaftaran Mata Kuliah '.$data_mk['nama_mata_kuliah'].' Gagal !, SKS Tidak Mencukupi");
						}else{
							alert("Pendaftaran Mata Kuliah '.$data_mk['nama_mata_kuliah'].' Gagal !");
						}
						GoDAFTARKRSMK("'.$kode_mk.'","'.$_SESSION["uid"].'");
				});
			}
			</script>';
			exit($panel_hidden);
		break;
	}
}


?>