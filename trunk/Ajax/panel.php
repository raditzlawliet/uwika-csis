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
//			$header_logoff = "<a id=\"header_id_account\" class=\"header_trigger\" onclick=\"javascript:header_account_click()\" href=\"#!\">ACCOUNT</a>";
			exit($header_logoff);
		break;
	}
	case 4 : { //info student panel
			$header_logoff = "<a id=\"header_id_student\" class=\"header_trigger\" onclick=\"javascript:header_student_click()\" href=\"#!\">INFORMASI<br \>MAHASISWA</a>";
			exit($header_logoff);
		break;
	}
	case 5 : { //info student panel
//			$header_logoff = "<a id=\"header_id_faculty\" class=\"header_trigger\" onclick=\"javascript:header_faculty_click()\" href=\"#!\">LECTURER<br \>INFORMATION</a>";
			exit($header_logoff);
		break;
	}
	case 6 : { //info student panel
//			$header_logoff = "<a id=\"header_id_employee\" class=\"header_trigger\" onclick=\"javascript:header_employee_click()\" href=\"#!\">EMPLOYEE<br \>INFORMATION</a>";
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
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
					$("#main").load("Ajax/profile.php?id='.$data_profile['nrp'].'");
					
				}
				function GoHOME(){
					header_account_click();
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
					ShowHiddenPanel(true,\'agreement\',\'Ajax/panel.php\',\'.main_panel\');
				}
				function GoCONFIGURATIONMENU(){
					header_account_click();
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
					ShowHiddenPanel(true,\'agreement\',\'Ajax/panel.php\',\'.main_panel\');
				}
				function GoBACKEND(){
					header_account_click();
					ShowHiddenPanel(true,\'agreement\',\'Ajax/panel.php\',\'.main_panel\');
				}
		</script>';
//		exit($header_logoff_panel);
		break;
	}
	case 4 : { //st7udent panel
		$data_profile = getProfile($_SESSION['uid'],$_SESSION['turn']);
		$f = '<div class="header_panel" id="header_id_student_panel"><ul>';
		$c = '';
		switch($_SESSION['turn']){
			case 0 : {
				$c = '	<li><a onclick="javascript:GoKRS();" href="#!krs">K R S &nbsp; </a></li>
						<li><a onclick="javascript:GoKRSx();" href="#!khs">L A P O R A N &nbsp; &nbsp; K R S &nbsp; </a></li>
						<li><a onclick="javascript:GoKHS();" href="#!khs">L A P O R A N &nbsp; &nbsp; K H S &nbsp; </a></li>';
				$x='	<li><a onclick="javascript:GoLIBRARY();" href="#!library">L I B R A R Y</a></li>
						<li><a onclick="javascript:GoELEARNING();" href="#!e-learning">E &nbsp; - &nbsp; L E A R N I N G</a></li>
				 ';
				 break;
			}
			case 1 : {
				$c = '	<li><a onclick="javascript:GoINFORMATIONSTUDENT();" href="#!information_student">I N F O R M A S I&nbsp; &nbsp; &nbsp;&nbsp;M A H A S I S W A</a></li>
				';
				 break;
			}
			case 2 : {
				$c = '	<li><a onclick="javascript:GoINFORMATIONSTUDENT();" href="#!information_student">I N F O R M A S I&nbsp; &nbsp; &nbsp;&nbsp;M A H A S I S W A</a></li>
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
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
					$.post("Ajax/krs.php",{code:"krs", uid:"'.$_SESSION["uid"].'"}, function(data) {
					  $("#main").html("");
					  $("#main").append(data);
					});
				}
				function GoKHS(){
					header_student_click();
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
					$.post("Ajax/khs.php",{code:"khs", uid:"'.$_SESSION["uid"].'"}, function(data) {
					  $("#main").html("");
					  $("#main").append(data);
					});
				}
				function GoKRSx(){
					header_student_click();
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
					$.post("Ajax/krsr.php",{code:"krs", uid:"'.$_SESSION["uid"].'"}, function(data) {
					  $("#main").html("");
					  $("#main").append(data);
					});
				}
				function GoLIBRARY(){
					header_student_click();
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
				}
				function GoELEARNING(){
					header_student_click();
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
				}
				function GoINFORMATIONSTUDENT(){
					header_student_click();
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
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
		<li><a onclick="javascript:GoFACULTYINFORMATION()" href="#!">L E C T U R E R &nbsp; &nbsp; &nbsp; I N F O R M A T I O N</a></li>
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
				$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
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
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
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
				<li><a onclick="javascript:GoDATABASE();" href="#!">D A T A B A S E &nbsp; &nbsp; &amp; &nbsp; &nbsp; L A P O R A N</a></li>
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
					header_admin_click();
					ShowHiddenPanel(true,"admin_settings","Ajax/panel.php",".main_panel");
				}
				function GoDATABASE(){
					header_admin_click();
					$("#main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
					$.post("Ajax/database.php",{code:"db_admin", uid:"'.$_SESSION["uid"].'", admin:"'.$_SESSION["admin"].'"}, function(data) {
					  $("#main").html("");
					  $("#main").append(data);
					});
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
				$("#main").load("Ajax/photo.php");
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
			$set_height = "250";
			if(isset($_COOKIE['set_height_mk_list'])){
				$set_height = $_COOKIE['set_height_mk_list'];
			}
//			$i=1;
			$i=51;
			do{
				if($i!=91){
					if(($i==52)||($i==53)){
						$table = $table.'
						<tr><td style="text-transform:capitalize;" width="15%">'.$settings[$n[$i]]['settings'].'</td><td width="2%"> : </td>
						<td><input id="set_admin_'.$i.'" value="'.$settings[$n[$i]]['value'].'" disabled="true" size="10"/></td>
						<td style="font-size:10px;">'.$settings[$n[$i]]['deskripsi'].'</td></tr>
						';
					}else{
				$table = $table.'
				<tr><td style="text-transform:capitalize;" width="15%">'.$settings[$n[$i]]['settings'].'</td><td width="2%"> : </td>
				<td><input id="set_admin_'.$i.'" value="'.$settings[$n[$i]]['value'].'" size="10" disabled="true"\></td>
				<td style="font-size:10px;">'.$settings[$n[$i]]['deskripsi'].'</td></tr>
				';}
				}else{
					
				$manual = "1"; //$settings[$n[$i]]['value'];
				$check = ' ';
				$x = false;
				if($manual=="1"){$check = ' checked ';$x = true;}
				$table = $table.'
				<tr><td style="text-transform:capitalize;" width="15%">'.$settings[$n[$i]]['settings'].'</td><td width="2%"> : </td>
				<td><input id="set_admin_'.$i.'" type="checkbox" value="'.$manual.'" '.$check.' /></td>
				<td style="font-size:10px;">'.$settings[$n[$i]]['deskripsi'].'</td></tr>
				';
				}
				$i++;
				if($i==11)$i=100;
				if($i==57)$i=91;
				if($i==94)$i=1;
			}while($i!=100);
			$panel_hidden = '<div><b><center>S E T T I N G S</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<br>Settingan hanya yang aktif saja yang masih berlaku, sisanya sudah kadaluarsa tak digunakan.<br>
			<table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table>
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVESETTINGS()" class="button" href="#!"><b>SAVE SETTINGS</b></a></td><td><a onclick="javascript:CancelClick();" class="button" id="diff" href="#!"><b>CANCEL</b></a></td></tr></table>
			</div>
			<script>
			GoClickManual('.$x.');
			function GoClickManual(x){
					var a = x;
					var i=1;
					do{
						var tmp = "set_admin_"+i;
						if(i!=91){if((i<51)||(i==53)||(i==52)||(i==91)){document.getElementById(tmp).disabled=a;}else{document.getElementById(tmp).disabled=!a;}}
						i++;
						if(i==11)i=51;
						if(i==57)i=91;
						if(i==94)i=100;
					}while(i!=100);
			}
			function CancelClick(){
				HidePanel();
			}
			function GoSAVESETTINGS(){
				var i=1;
				var value = "";
				do{
					var tmp = "set_admin_"+i;
					if(i!=91){value = value +document.getElementById(tmp).value;}
					else{if(document.getElementById(tmp).checked){value = value +"1";}else{value = value +"0"}}
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
			$set_height = "250";
			
			$uid = htmlentities($_POST['uid']);
			$kode_mk = htmlentities($_POST['kode_mk']);
			$e;
			if($_SESSION['uid']!=$uid){$uid="null";$e = $e."YOU CAN'T CHEAT THIS KRS !<br>"; $e = $e."<script>alert('Do Not Cheat this KRS !!!')</script>";}
			$data_profile = getProfile($uid,$_SESSION['turn']);
			$data_mk = getMataKuliah($kode_mk);
			
			$semester = htmlentities($_POST['semester']);
			$semester = getMKSemesterProdi($kode_mk,$data_profile['kode_jurusan']);
			if(isset($_COOKIE['set_height_mk_list'])){
				$set_height = $_COOKIE['set_height_mk_list'];
			}
//			$panel_hidden = '<div><b><center><br \>'.$uid.' <br \>'.$kode_mk.'';
			$sks_n = getSKSMahasiswa($data_profile['nrp']);
			$sks_n_mk = getSKSMataKuliah($kode_mk);
			$t_thn = getValueSettingsOf('tahun');
			$t_sms = getValueSettingsOf('semester');
			$list_mk_student = getListStudentRegisteredMataKuliah($kode_mk,$t_thn,$t_sms);
			$t1 = '<a onclick="javascript:Cancel_Class_Click();" class="button" href="#!">';
			$t2 = '<a onclick="javascript:Register_Class_Click();" class="button" href="#!">';
			$t3 = '<a class="button" id="dead">';
			$s_r = getStudentIsRegisteredMataKuliah($kode_mk,$data_profile['nrp']);
			$masa = getMasa($t_thn,$t_sms);
			$sdh = false;
			$syarat = getSyarat($kode_mk);
			$syarat_ = 0;
			if($syarat[0]['ada']){
				$e = $e.'<table id="list_mk_req">';
				$e = $e."<tr><th id=\"center\">No.</th><th>Mata Kuliah</th><th>Peringatan</th><th id=\"center\">Syarat</th><th id=\"center\">Hasil</th></tr>";
				for($i = 0; $i<=$syarat[0][k];$i++){
//					$e = $e.($i+1).". ".$syarat[$i]['kode_mk_syarat']." ".$syarat[$i]['kode_syarat']."<br>";
					//if dia lulus, maka bs ambil, jika tidak. maka g bs ambil
					if(getStudentIsLulusMataKuliah($syarat[$i]['kode_mk_syarat'],$data_profile['nrp'])){ //lulus
						if($syarat_ !=2){
							$syarat_ = 1;
						}
						if($syarat[$i]['kode_syarat']==1){
						$e = $e."<tr><td id=\"center\">".($i+1)."</td><td>".$syarat[$i]['kode_mk_syarat']."</td><td>Mata Kuliah Sudah Lulus</td><td id=\"center\">Harus Diambil</td><td id=\"center\"><b>COMPLETE</b></td></tr>";}
						else{
						$e = $e."<tr><td id=\"center\">".($i+1)."</td><td>".$syarat[$i]['kode_mk_syarat']."</td><td>Mata Kuliah Sudah Lulus</td><td id=\"center\">Harus Lulus</td><td id=\"center\"><b>COMPLETE</b></td></tr>";
						}
					}else{		//gagal / blum ambil
						if($syarat[$i]['kode_syarat']==1){
								$mk_syarat = getStudentIsRegisteredMataKuliah($syarat[$i]['kode_mk_syarat'],$data_profile['nrp']);
									if($mk_syarat['ada']){
											if($mk_syarat['masa']==$masa){
												$e = $e."<tr><td id=\"center\">".($i+1)."</td><td>".$syarat[$i]['kode_mk_syarat']."</td><td>Mata Kuliah Baru Diambil</td><td id=\"center\">Harus Diambil</td><td id=\"center\"><b>COMPLETE</b></td></tr>";
												//LOLOS SYARAT 1
											}else{
												$e = $e."<tr id=\"red\"><td id=\"center\">".($i+1)."</td><td>".$syarat[$i]['kode_mk_syarat']."</td><td>Mata Kuliah Belum Diambil. Dulu Sempat tapi Belum Lulus</td><td id=\"center\">Harus Diambil</td><td id=\"center\"><b>INCOMPLETE</b></td></tr>";
												//gagal
												$syarat_ = 2;
											}
									}else{
										$e = $e."<tr id=\"red\"><td id=\"center\">".($i+1)."</td><td>".$syarat[$i]['kode_mk_syarat']."</td><td>Mata Kuliah Belum Diambil</td><td id=\"center\">Harus Diambil</td><td id=\"center\"><b>INCOMPLETE</b></td></tr>";
										//gagal
										$syarat_ = 2;
									}
						}else{
							$syarat_ = 2;
							$e = $e."<tr id=\"red\"><td id=\"center\">".($i+1)."</td><td>".$syarat[$i]['kode_mk_syarat']."</td><td>Mata Kuliah Belum Lulus</td><td id=\"center\">Harus Lulus</td><td id=\"center\"><b>INCOMPLETE</b></td></tr>";
						}
						
					}
					//jika syaratnya = 1, dia bisa ambil walopun grong luluzzzzzzzzzzzzzzzzzzzzzzzzzz
					//lek gorong lulus, g usa ambil, pkok e ws tau ambil.
					// syarat = 0 masi inisial / no syarat, syarat = 1, maka dia lulus SYARAT. syarat = 2 maka tak lulus SYARAT
					
					if($syarat_ == 2){
						$t_c = $t3; //tak bis ambil / blom lolos
						$t_r = $t3;
					}else{						
						$t_c = $t3; //bisa ambil / sudah lolozzzz
						$t_r = $t2;
					}
				}
				$e = $e."</table>";
			}

			if($syarat_ != 2){
				if($s_r['ada']){
					if($s_r['lulus']=="1"){
							$t_c = $t3;
							$t_r = $t2;
							$set_height = $set_height-25;
							$e = $e."Kamu Pernah mengambil Mata Kuliah ini sebelumnya dan Lulus. Sekarang kamu bisa ambil lagi<br>";
					}else{					
						if($s_r['masa']==$masa){
							$t_c = $t1;
							$t_r = $t3;
							$sdh = true;
						}else{
							$set_height = $set_height-25;
							$e = $e."Kamu Pernah mengambil Mata Kuliah ini sebelumnya, tetapi belum lulus. Sekarang kamu bisa ambil lagi<br>";
							$t_c = $t3;
							$t_r = $t2;
						}
					}
				}else{
					$t_c = $t3;
					$t_r = $t2;
				}
			}
			$mk_tabrak = getMataKuliahTabrakanWaktunya($kode_mk,$data_profile['nrp'],$masa);
			if($mk_tabrak[0]['ada']){
				$sama_mk_tabrak = false;
				for($l=0;$l<=$mk_tabrak[0]['k'];$l++){
					if($mk_tabrak[0]['kode_mata_kuliah'] == $kode_mk){
						$sama_mk_tabrak = true;
						$sdh = true;
					}
				}
				if(!$sama_mk_tabrak){
					$e = $e."<div style=\"padding-top:3px;\">Kamu punya tabrakan jadwal dengan Mata Kuliah yang sudah kamu Ambil</div>";
					$t_c = $t3;
					$t_r = $t3;
				}
			}
				$sks_m = getSKSMahasiswa($data_profile['nrp']);
				$sks_mk = getSKSMataKuliah($kode_mk);
				if(!$sdh){if($sks_m < $sks_mk){
					$e = $e."<div style=\"padding-top:3px;\">SKS kamu tidak mencukupi untuk mendaftar Mata Kuliah ini</div>";
					$t_c = $t3;
					$t_r = $t3;
				}}
				
			$regist_cancel = '
			<td id="krs_cancel_class">'.$t_c.'<b>BATALKAN KELAS</b></a></td>
			<td id="krs_register_class">'.$t_r.'<b>DAFTARKAN KELAS</b></a></td>
			';
			$dosen = $data_mk['nama'].' ('.$data_mk['nrp'].')';
			if($data_mk['k']>1){
				for($i=2;$i <= $data_mk['k'];$i++){
				$dosen = $dosen.', '.$data_mk[$i]['nama'].' ('.$data_mk[$i]['nrp'].')';}
			}
			
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
			<tr><td>Dosen Pengajar </td><td>:</td><td>'.$dosen.'</td><td width="6%">Terdaftar</td><td width="2%">:</td><td>'.getListStudentRegisteredMataKuliahX($kode_mk,$t_thn,$t_sms).'</td></tr>
			</table>
			<div style="text-transform:uppercase;letter-spacing:1px;color:#A00;"><center><b>'.$e.'<br>Mahasiswa yang sudah terdaftar di mata kuliah ini</b><p></center></div>
			<div id="div_ov_list_mk_student" style="height:'.$set_height.'px;">
				<table id="list_mk_student">
					<tr id="header_table"><th>N R P</th><th width="31%">Name</th><th>Time Register</th><th>FKLTS - JRSN</th><th>SMS - THN</th></tr>
					'.$list_mk_student.'
				</table>
			</div>
			<p><table style="float:right;"><tr>
			'.$regist_cancel.'
			<td><a onclick="javascript:CancelClick();" class="button" id="diff" href="#!"><b>CANCEL</b></a></td></tr></table>
			</div>
			<script>
			var klik = 0;
			function CancelClick(){
				HidePanel();
			}
			function GoKRS_PROFILESTUDENT(nrp){
				alert(nrp);
			}
			function Cancel_Class_Click(){
				if(klik==0){klik=1;
//				HidePanel();
				ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
				$.post("Ajax/mk_.php",{code:"cancel_class", kode_mk:"'.$data_mk['kode_mata_kuliah'].'", nrp:"'.$data_profile['nrp'].'", masa:"'.$masa.'"},
					function(data) {
						if(data==1){
							$(".krs_sisa_sks").html("'.$data_profile['sks_awal'].' - '.($sks_n+$sks_n_mk).'");
							alert("Pembatalan Mata Kuliah '.$data_mk['nama_mata_kuliah'].' Sukses !");
						}else{
							alert("Pembatalan Mata Kuliah '.$data_mk['nama_mata_kuliah'].' Gagal !");
						}
						reload_isi_mat_kul("'.$semester.'");
						HidePanel();
				});
				}
			}
			function Register_Class_Click(){
				if(klik==0){klik=1;
//				HidePanel();
				ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
				$.post("Ajax/mk_.php",{code:"register_class", kode_mk:"'.$data_mk['kode_mata_kuliah'].'", nrp:"'.$data_profile['nrp'].'", masa:"'.$masa.'"},
					function(data) {
						if(data==1){
							$(".krs_sisa_sks").html("'.$data_profile['sks_awal'].' - '.($sks_n-$sks_n_mk).'");
							alert("Pendaftaran Mata Kuliah '.$data_mk['nama_mata_kuliah'].' Sukses !");
						}else if(data==0){
							alert("Pendaftaran Mata Kuliah '.$data_mk['nama_mata_kuliah'].' Gagal !, SKS Tidak Mencukupi");
						}else{
							alert("Pendaftaran Mata Kuliah '.$data_mk['nama_mata_kuliah'].' Gagal !");
						}
						reload_isi_mat_kul("'.$semester.'");
						HidePanel();
				});
				}
			}
			</script>';
			exit($panel_hidden);
		break;
	}
}


?>