<?php
$set_height_mk_list = 250;
if(!isset($_COOKIE['set_height_mk_list'])){
	setcookie('set_height_mk_list', "250", time()+3600, "/");
}
$set_height_mk_list = $_COOKIE["set_height_mk_list"];

include 'transfer_sc.php';

$code = htmlentities($_POST['code']);
$uid = htmlentities($_POST['uid']);
$admin = htmlentities($_POST['admin']);

switch($code){
	case 'db_sc' : { //db mahasiswa
			if(!isset($_COOKIE['set_height_mk_list'])){
				$set_height_mk_list = 250;
			}
			$out = '
				<center><h1 style="letter-spacing:20px;"><b><br>IPS SCORE</b></h1><p>
				<div id="db_cmd"><a id="refresh_blue" class="submit" onclick="javascript:searchR(\'db_sc\');" href="#!">Refresh</a>&nbsp;<a id="add_blue" class="submit" onclick="javascript:edit_db_sc(1,null);" href="#!">Tambah Nilai IPS Mhs</a>&nbsp;<a id="refresh_blue" class="submit" onclick="javascript:resetIPK(\'db_sc\');" href="#!">Reset Ulang Auto IPK</a>&nbsp;<a id="refresh_blue" class="submit" onclick="javascript:resetIPS(\'db_sc\');" href="#!">Reset Ulang Auto IPS</a>&nbsp;
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_sc\');" id="search_db_sc" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_sc\');" id="search_in_db_sc" class="select" title="Search In" dir="ltr">
				<option value="nrp">NRP</option>
				<option value="semester">SEMESTER</option>
				<option value="ips">IPS</option>
				</select>
				&nbsp; &nbsp;				&nbsp; &nbsp;				&nbsp; &nbsp;
				Sort <select onchange="javascript:search(\'db_sc\');" id="sort_db_sc" class="select"  title="Sort" dir="ltr">
				<option value="nrp">NRP</option>
				<option value="semester">SEMESTER</option>
				<option value="ips">IPS</option>
				</select>
				By <select onchange="javascript:search(\'db_sc\');" id="sort_by_db_sc" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_sc\');" id="color_db_sc" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_sct">
				'.getTabelDatabaseIPS("","","nrp","ASC","blue","0").'
				</div><p>
				</center>
			
			
				<center><h1 style="letter-spacing:3px;"><b>NILAI MATA KULIAH (MATA KULIAH - MAHASISWA)</b></h1><p>
				<div id="db_cmd"><a id="refresh_blue" class="submit" onclick="javascript:searchR(\'db_sc2\');" href="#!">Refresh</a>&nbsp;<a id="add_blue" class="submit" onclick="javascript:edit_db_sc2(1,null);" href="#!">Tambah Relasi M - MK</a>&nbsp;<a id="refresh_blue" class="submit" onclick="javascript:resetIPS(\'db_sc\');" href="#!">Reset Ulang Auto IPS</a>&nbsp;<a id="refresh_blue" class="submit" onclick="javascript:resetLulus(\'db_sc\');" href="#!">Reset Ulang Auto Lulus MK</a>&nbsp;
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_sc2\');" id="search_db_sc2" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_sc2\');" id="search_in_db_sc2" class="select" title="Search In" dir="ltr">
				<option value="kode_mata_kuliah">SUBJECT CODE</option>
				<option value="nrp">STUDENT NRP</option>
				<option value="semester">SEMESTER</option>
				<option value="masa">MOMENT</option>
				<option value="hari_register">DAY 1 ~ 5</option>
				<option value="time_register">TIME (HH:MM:SS)</option>
				<option value="tanggal_register">DATE (YYYY-MM-DD)</option>
				<option value="nilai">SCORE (0~4)</option>
				<option value="lulus">GRADUATED (0/1)</option>
				</select>
				&nbsp; &nbsp;				&nbsp; &nbsp;				&nbsp; &nbsp;
				Sort <select onchange="javascript:search(\'db_sc2\');" id="sort_db_sc2" class="select"  title="Sort" dir="ltr">
				<option value="kode_mata_kuliah">SUBJECT CODE</option>
				<option value="nrp">STUDENT NRP</option>
				<option value="semester">SEMESTER</option>
				<option value="masa">MOMENT</option>
				<option value="hari_register">DAY 1 ~ 5</option>
				<option value="time_register">TIME (HH:MM:SS)</option>
				<option value="tanggal_register">DATE (YYYY-MM-DD)</option>
				<option value="nilai">SCORE (0~4)</option>
				<option value="lulus">GRADUATED (0/1)</option>
				</select>
				By <select onchange="javascript:search(\'db_sc2\');" id="sort_by_db_sc2" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_sc2\');" id="color_db_sc2" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_sct2">
				'.getTabelDatabaseNilai("","","kode_mata_kuliah","ASC","blue","0").'
				</div><p>
				</center>
				
				<script>
				document.getElementById("color_db_sc").selectedIndex = 2;
				document.getElementById("color_db_sc2").selectedIndex = 2;
				function resetLulus(){
					var x = confirm("PENYETINGGAN AUTO ULANG LULUS BERDASARKAN NILAI MK >=60 [C]/[2] MAKA LULUS DAN NILAI MK <60 [D/E]/[1/0] MAKA TIDAK LULUS \n\nApa kamu yakin mau messeting ulang IPK secara otomatis ??\n\nOK : Lanjut, \nCancel : Batal");
					if(x){
						var z = confirm("SETTING ULANG SEMUA ?\n\nOK : Setting ulang semua, \nCancel : Pilihan setting ulang semua");
						if(z){
							ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
							$.post("Ajax/database_db_sc.php",{code:"refresh_lulus_all"}, function(data) {
								alert(data);
								HidePanel();
								search(\'db_sc2\');
							});	
						}else{
							var ins = prompt("PILIH YANG AKAN DISETTING ULANG !(for IE : 1/nrp,2/mk,3/mk-masa,4/masa,5/nrp-sms,6/nrp-sms-mk) : \n\n1 / nrp : Setting Ulang semua dengan NRP X, di semua semester dan MK,\n2 / mk : Setting Ulang semua dengan MK X, di semua mahasiswa, dan masa,\n3 / mk-masa : Setting Ulang semua dengan MK X, dan MASA Y, di semua Mahasiswa,\n4 / masa : Setting Ulang semua dengan MASA X di semua mahasiswa, semester dan MKnya,\n5 / nrp-sms : Setting Ulang semua dengan NRP X dan SEMESTER Y, di semua MK,\n6 / nrp-sms-mk : Setting Ulang semua dengan NRP X, SEMESTER Y, dan MK Z.\n");
							if((ins==1)||(ins=="1")||(ins=="nrp")){
								var nrp = prompt("Inputan NRP");
								ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
								$.post("Ajax/database_db_sc.php",{code:"refresh_lulus_nrp", nrp:nrp}, function(data) {
									alert(data);HidePanel();search(\'db_sc2\');
								});	
							}else if((ins==2)||(ins=="2")||(ins=="mk")){
								var mk = prompt("Inputan KODE MK");
								ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
								$.post("Ajax/database_db_sc.php",{code:"refresh_lulus_mk", kode_mk:mk}, function(data) {
									alert(data);HidePanel();search(\'db_sc2\');
								});	
							}else if((ins==3)||(ins=="3")||(ins=="mk-masa")){
								var mk = prompt("Inputan KODE MK");
								var val = prompt("Inputan MASA contoh (2010/2)");
								ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
								$.post("Ajax/database_db_sc.php",{code:"refresh_lulus_mk_masa", kode_mk:mk, value:val}, function(data) {
									alert(data);HidePanel();search(\'db_sc2\');
								});	
							}else if((ins==4)||(ins=="4")||(ins=="masa")){
								var nrp = prompt("Inputan MASA contoh (2010/2)");
								ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
								$.post("Ajax/database_db_sc.php",{code:"refresh_lulus_masa", nrp:val}, function(data) {
									alert(data);HidePanel();search(\'db_sc2\');
								});	
							}else if((ins==5)||(ins=="5")||(ins=="nrp-sms")){
								var nrp = prompt("Inputan NRP");
								var sms = prompt("Inputan SEMESTER");
								ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
								$.post("Ajax/database_db_sc.php",{code:"refresh_lulus_nrp_sms", nrp:nrp, value:sms}, function(data) {
									alert(data);HidePanel();search(\'db_sc2\');
								});	
							}else if((ins==6)||(ins=="6")||(ins=="nrp-sms-mk")){
								var nrp = prompt("Inputan NRP");
								var sms = prompt("Inputan SEMESTER");
								var kdmk = prompt("Inputan KODE MK");
								ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
								$.post("Ajax/database_db_sc.php",{code:"refresh_lulus_nrp_sms_mk", nrp:nrp, value:sms, kode_mk:kdmk}, function(data) {
									alert(data);HidePanel();search(\'db_sc2\');
								});	
							}else{
								alert("Pilihan Salah!");
							}
						}
					}
				}
				
				function resetIPK(){
					var x = confirm("PENYETINGGAN AUTO ULANG IPK BERDASARKAN Sigma(NILAI VALUE MK*SKS MK SEMESTER AWAL ~ SEMESTER SEKARANG)/Sigma(SKS MK SEMESTER AWAL ~ SEMESTER SEKARANG)\n\nApa kamu yakin mau messeting ulang IPK secara otomatis ??(Jika YA, Pilihan selanjutnya Semua/1 Mhs)");
					if(x){
						var z = confirm("SETTING ULANG SEMUA ? ATAU 1 MAHASISWA ?");
						if(z){
							ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
							$.post("Ajax/database_db_sc.php",{code:"refresh_ipk_all"}, function(data) {
								alert(data);
								HidePanel();
								search(\'db_sc\');
							});	
						}else{
							var nrp = prompt("MASUKKAN NRP YANG AKAN DI SETTING ULANG IPSNYA");
							ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
							$.post("Ajax/database_db_sc.php",{code:"refresh_ipk", nrp:nrp}, function(data) {
								alert(data);
								HidePanel();
								search(\'db_sc\');
							});	
						}
					}
				}
				
				function resetIPS(){
					var x = confirm("PENYETINGGAN AUTO ULANG IPS BERDASARKAN Sigma(NILAI VALUE MK*SKS MK)/Sigma(SKS MK)\n\nApa kamu yakin mau mensetting ulang IPS secara otomatis ?\n (Jika YA, Pilihan selanjutnya Semua/1 Mhs)");
					if(x){
						var y = confirm("SETTING ULANG SEMUA ? ATAU 1 MAHASISWA ?");
						if(y){
							ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
							$.post("Ajax/database_db_sc.php",{code:"refresh_ips_all"}, function(data) {
								alert(data);
								HidePanel();
								search(\'db_sc\');
							});	
						}else{
							var nrp = prompt("MASUKKAN NRP YANG AKAN DI SETTING ULANG IPSNYA");
							var zz = confirm("SETTING SEMUA SEMESTER ? (DIAMBIL DARI SEMESTERNYA DIA, JIKA ADA DATA MK YANG KOSONG, MAKA AKAN DIANGGAP 0/NOL)");
							if(!zz){
								var sms = prompt("MASUKKAN SEMESTER DARI NRP "+nrp+" YANG AKAN DI SETTING ULANG IPSNYA");
								ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
								$.post("Ajax/database_db_sc.php",{code:"refresh_ips", nrp:nrp, value:sms}, function(data) {
									alert(data);
									HidePanel();
									search(\'db_sc\');
								});	
							}else{
								ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
								$.post("Ajax/database_db_sc.php",{code:"refresh_ips_", nrp:nrp}, function(data) {
									alert(data);
									HidePanel();
									search(\'db_sc\');
								});	
							}
						}
					}
				}
				
				function searchR(db){
					searchpage(db,1);
				}
				
				function search(db){
					searchpage(db,1);
				}
				function searchpage(db,page){
					var search_text = document.getElementById(\'search_\'+db).value;
					var search_in = document.getElementById(\'search_in_\'+db).value;
					var sort_text = document.getElementById(\'sort_\'+db).value;
					var sort_by = document.getElementById(\'sort_by_\'+db).value;
					var color = document.getElementById(\'color_\'+db).value;
					if((search_text==null)||(search_text=="")||(search_text==" ")||(search_text=="  ")){
						if(db=="db_sc")$("#db_sct").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_sc2")$("#db_sct2").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax_sc.php",{code:db, search_text:"", search_in:"", sort_text:sort_text, sort_by:sort_by, color:color,page:page}, function(data) {
							if(db=="db_sc")$("#db_sct").html(data);
							if(db=="db_sc2")$("#db_sct2").html(data);
						}); 
					}else{
						if(db=="db_sc")$("#db_sct").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_sc2")$("#db_sct2").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax_sc.php",{code:db, search_text:search_text, search_in:search_in, sort_text:sort_text, sort_by:sort_by, color:color,page:page}, function(data) {
							if(db=="db_sc")$("#db_sct").html(data);
							if(db=="db_sc2")$("#db_sct2").html(data);
						}); 
					}	
				}
				function edit_db_sc(kd,nrp,value){ //nrp,masa
					if(kd!=4){
					data = "&code_edit=" + encodeURI(kd) + "&nrp=" + encodeURI(nrp) + "&value=" + encodeURI(value);
					ShowHiddenPanel(false,"db_sc","Ajax/database_panel_hidden_sc.php",".main_panel",data);
					}else{
						var x = confirm("Apa kamu yakin mau menghapus data ini ("+nrp+" - "+value+") ?");
						if(x){
						$.post("Ajax/database_db_sc.php",{code:kd, nrp:nrp, value:value}, function(data) {
							alert(data);
							search(\'db_sc\');
						});	}
					}
				}
				function edit_db_sc2(kd,nrp,value,value2){ //kj,nrp,masa
					if(kd!=4){
					data = "&code_edit=" + encodeURI(kd) + "&nrp=" + encodeURI(nrp) + "&value=" + encodeURI(value) + "&value2=" + encodeURI(value2);
					ShowHiddenPanel(false,"db_sc2","Ajax/database_panel_hidden_sc.php",".main_panel",data);
					}else{
						var x = confirm("Apa kamu yakin mau menghapus data ini ("+nrp+" - "+value+" - "+value2+") ?");
						if(x){
							kd="2"+""+kd;
						$.post("Ajax/database_db_sc.php",{code:kd, kode_mk:nrp, nrp:value, value:value2}, function(data) {
							alert(data);
							search(\'db_sc2\');
						});	}
					}
				}
				function SetHeightMkKeyUp(kotak,v){
					var temp = parseInt(kotak.value);
					if (isNaN(temp)){
						if(v==1){
						alert("Please, Input a Number !!");}
					}else{
						if (temp>99999||temp<50){
							if(v==1){
							alert("Setting Height : Minimal 50px, Maximal 99999px");}
						}else{
							setCookie("set_height_mk_list",temp,1)
						}
					}
				}
				</script>
				';
			exit($out);
		break;
	}
}

?>

