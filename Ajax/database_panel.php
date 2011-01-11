<?php
$set_height_mk_list = 250;
if(!isset($_COOKIE['set_height_mk_list'])){
	setcookie('set_height_mk_list', "250", time()+3600, "/");
}
$set_height_mk_list = $_COOKIE["set_height_mk_list"];

include 'transfer_.php';

$code = htmlentities($_POST['code']);
$uid = htmlentities($_POST['uid']);
$admin = htmlentities($_POST['admin']);

switch($code){
	case 'db_h' : { //db awal
	$q='		<center><h1 style="letter-spacing:20px;"><b>PENDATAAN & LAPORAN</b></h1><p>
				<div id="db" style="width:100%;">
					<div id="db_menu">
					<ul>
						<a id="db_l_mk" style="letter-spacing:0px;" onclick="javascript:GoHELL2(\'db_l_mk\',\'Ajax/database_panel_l_mk.php\');" href="#!">LIST MAHASISWA PER-MATKUL</a>
						<a id="db_l_m" style="letter-spacing:0px;"onclick="javascript:GoHELL2(\'db_l_m\',\'Ajax/database_panel_l_m.php\');" href="#!">LIST MATKUL PER-MAHASISWA (KHS&KRS)</a>
						<a id="db_i_m" style="letter-spacing:0px;"onclick="javascript:GoHELL2(\'db_i_m\',\'Ajax/database_panel_i_m.php\');" href="#!">INPUT NILAI PER MAHASISWA</a>
						<a id="db_i_ips" style="letter-spacing:0px;"onclick="javascript:GoHELL2(\'db_i_ips\',\'Ajax/database_panel_i_ips.php\');" href="#!">INPUT NILAI PER MATKUL</a>
					</ul>
					</div>
					<h1 style="margin-bottom:27px;"></h1>
					<div id="db_main_home">
					</div>
				</div>
				</center>
				<script>
				function GoHELL2(ids,src){
					var doku = new Array("db_l_m","db_l_mk","db_i_m","db_i_ips");
					for(var i = 0;i<4;i++){
						document.getElementById(doku[i]).className = "";
					}
					document.getElementById(ids).className = "active";
					$("#db_main_home").html("");
					$("#db_main_home").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
					$.post(src,{code:ids, uid:"'.$uid.'", admin:"'.$admin.'"}, function(data) {
						$("#db_main_home").html(data);
					}); 
					
				}
				</script>';
			exit($q);
		break;
	}
	case 'db_m' : { //db mahasiswa
			if(!isset($_COOKIE['set_height_mk_list'])){
				$set_height_mk_list = 250;
			}
			$out = '
				<center><h1 style="letter-spacing:20px;"><b>STUDENT</b></h1><p>
				<div id="db_cmd"><a id="refresh" class="submit" onclick="javascript:searchR(\'db_m\');" href="#!">Tampilkan Ulang</a>&nbsp;<a id="add" class="submit" onclick="javascript:edit_db_m(1,null);" href="#!">Tambah MHS</a>&nbsp;<a id="refresh" class="submit" onclick="javascript:resetSMS();" href="#!">Penyetingan Auto Ulang SMS</a>&nbsp;<a id="refresh" class="submit" onclick="javascript:resetSKS();" href="#!">Penyetingan Auto Ulang SKS</a>&nbsp;<p><a id="add" class="submit" onclick="javascript:resetSemester(1,true);" href="#!">1 SMS [E]</a>&nbsp;<a id="del" class="submit" onclick="javascript:resetSemester(1,false);" href="#!">1 SMS [E]</a>
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px
				</div><div id="db_cmd">E : Error Only (Untuk Berjaga2 jika ada kesalahan) &nbsp;</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_m\');" id="search_db_m" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_m\');" id="search_in_db_m" class="select" title="Search In" dir="ltr">
				<option value="nrp">NRP</option>
				<option value="nama">NAME</option>
				<option value="aka">ALIAS NAME</option>
				<option value="jenis_kelamin">GENDER</option>
				<option value="tanggal_lahir">BIRTHDAY</option>
				<option value="alamat">ADDRESS</option>
				<option value="asal_sekolah">SCHOOL FROM</option>
				<option value="kode_jurusan">CODE JURUSAN</option>
				<option value="probis">CLASS</option>
				<option value="tanggal_masuk">DATE REGISTRATION</option>
				<option value="semester">SEMESTER</option>
				<option value="ipk">IPK</option>
				<option value="sks_awal">SKS</option>
				<option value="sisa_sks">REMAINING SKS</option>
				</select>
				&nbsp; &nbsp;				&nbsp; &nbsp;				&nbsp; &nbsp;
				Sort <select onchange="javascript:search(\'db_m\');" id="sort_db_m" class="select"  title="Sort" dir="ltr">
				<option value="nrp">NRP</option>
				<option value="nama">NAME</option>
				<option value="aka">ALIAS NAME</option>
				<option value="jenis_kelamin">GENDER</option>
				<option value="tanggal_lahir">BIRTHDAY</option>
				<option value="alamat">ADDRESS</option>
				<option value="asal_sekolah">SCHOOL FROM</option>
				<option value="kode_jurusan">CODE JURUSAN</option>
				<option value="probis">CLASS</option>
				<option value="tanggal_masuk">DATE REGISTRATION</option>
				<option value="semester">SEMESTER</option>
				<option value="ipk">IPK</option>
				<option value="sks_awal">SKS</option>
				<option value="sisa_sks">REMAINING SKS</option>
				</select>
				By <select onchange="javascript:search(\'db_m\');" id="sort_by_db_m" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_m\');" id="color_db_m" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_mahasiswa">
				'.getTabelDatabaseMahasiswa("","","nrp","ASC","red","0").'
				</div><p>
				</center>
				
				<script>
				
				function resetSemester(val,o){
					var t;
					if(o)t="Adder";
					else t="Decrease";
					var x = confirm("Are you want to reset semester to "+t+" "+val+" point to all students ?\nTHIS FUNCTION MUST BE FIRST TURN ON BEFORE RESET SKS, AND AFTER INPUT NEW ACCOUNT STUDENTS (WITH 0 SEMESTER)");
					if(x){
						ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
						$.post("Ajax/database_db_m.php",{code:"reset_semester", value2:o, value:val}, function(data) {
							alert(data);
							HidePanel();
							search(\'db_m\');
						});	
						}
				}

				function resetSKS(){
					var x = confirm("PENYETINGGAN AUTO ULANG LIMIT SKS BERDASARKAN IPK TERAKHIR (SEMESTER-1)\n\nApa kamu yakin mau mensetting ulang SKS Limit menjadi default ?\n Default SKS Limit adalah 24 untuk semua semester 1 dan 0, \nJika IPK Semester terakhir < 3 (Kecuali Semester 1 dan 0) maka mereka mendapatkan 21 SKS, \nJika IPK Semester terakhir < 2.5 (Kecuali Semester 1 dan 0) maka mereka mendapatkan 18 SKS, \nJika IPK Semester terakhir < 2 (Kecuali Semester 1 dan 0) maka mereka mendapatkan 15 SKS, \nJika IPK Semester terakhir < 1.5 (Kecuali Semester 1 dan 0) maka mereka mendapatkan 12 SKS, \nJika IPK Semester terakhir < 1 (Kecuali Semester 1 dan 0) maka mereka mendapatkan 9 SKS, \nJika IPK Semester terakhir Tidak ada/Data belum terinput (Kecuali Semester 1 dan 0) maka mereka mendapatkan 9 SKS (dianggap 0).\n\nINI BIASANYA DIGUNAKAN DIMANA SEMESTER SUDAH BERGANTI MENJADI SEMESTER BARU (AWAL SEBELUM KRS MULAI, BERGANTINYA SEMESTER GENAP MENJADI GANJIL ATAU SEBALIKNYA). \n\nSEBAIKNYA KAMU MEREFRESH MENSETTING TAHUN DAN SEMESTER PADA MENU DATABASE -> SETTING, \n\nSETELAH ITU MEREFRESH ULANG SEMESTER MEREKA, BARULAH RESET LIMIT SKS INI DIGUNAKAN.");
				if(x){
					ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
					$.post("Ajax/database_db_m.php",{code:"refresh_sks_db_mhs"}, function(data) {
						alert(data);
						HidePanel();
						search(\'db_m\');
					});	
					}
				}
				function resetSMS(){
					var x = confirm("PENYETTINGAN AUTO ULANG SEMESTER BERDASARKAN NRP DAN MASA(SETTINGS TAHUN DAN SETTINGS SEMESTER DI MENU SETTINGS) KRS SEKARANG\n\nApa kamu yakin mau mensetting ulang Semester Mahasiswa menjadi Default awal ? \nyaitu, 2 Angka Digit NRP yaitu ANGKATAN (3 Digit dari depan NRP) sebagai Tahun Awal masuk, dan MASA sebagai tahun Semester berlangsung.\n\nContoh : \n\nNRP - 31109036, Angkatan 2009 (Arti : pertengahan tahun tersebut dia masuk), \nMASA - 2010/1, tahun 2010-2011 Semester Ganjil (perkiraan bulan Agustust - Januari Tahun berikutnya).\nJadi dihitung ((2010 - 2009) * 2) + (Jika masa/1 maka + 1, masa/2 maka +2) = 3\n\nNRP - 31108001, Angkatan 2008, Masa - 2010/2\nJadi, ((2010-2008)*2)+(2)=6");
				if(x){
					ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
					$.post("Ajax/database_db_m.php",{code:"refresh_sms_db_mhs"}, function(data) {
						alert(data);
						HidePanel();
						search(\'db_m\');
					});	
					}
				}
				document.getElementById("color_db_m").selectedIndex = 1;
				function GoDB_MAHASISWA_EDIT(nrp,code){
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
						$("#db_mahasiswa").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax.php",{code:db, search_text:"", search_in:"", sort_text:sort_text, sort_by:sort_by, color:color,page:page}, function(data) {
							$("#db_mahasiswa").html(data);
						}); 
					}else{
						$("#db_mahasiswa").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax.php",{code:db, search_text:search_text, search_in:search_in, sort_text:sort_text, sort_by:sort_by, color:color,page:page}, function(data) {
							$("#db_mahasiswa").html(data);
						}); 
					}
				}
				function edit_db_m(kd,nrp){
					if(kd!=4){
					data = "&code_edit=" + encodeURI(kd) + "&nrp=" + encodeURI(nrp);
					ShowHiddenPanel(false,"db_m","Ajax/database_panel_hidden.php",".main_panel",data);
					}else{
						var x = confirm("Are you want to delete this data ("+nrp+") ?");
						if(x){
						$.post("Ajax/database_db_m.php",{code:kd, nrp:nrp}, function(data) {
							alert(data);
							search(\'db_m\');
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

