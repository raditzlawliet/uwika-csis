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
	$q='		
				<center><h1 style="letter-spacing:20px;"><b>LIST</b></h1><p>
				<div id="db" style="width:100%;">
					<div id="db_menu">
					<ul>
						<a id="db_l_mk" onclick="javascript:GoHELL2(\'db_l_mk\',\'Ajax/database_panel_l_mk.php\');" href="#!">LIST PER-MATA KULIAH</a>
						<a id="db_l_m" onclick="javascript:GoHELL2(\'db_l_m\',\'Ajax/database_panel_l_m.php\');" href="#!">LIST PER-MAHASISWA</a>
					</ul>
					</div>
					<h1 style="margin-bottom:27px;"></h1>
					<div id="db_main_home">
					</div>
				</div>
				</center>
				<script>
				function GoHELL2(ids,src){
					var doku = new Array("db_l_m","db_l_mk");
					for(var i = 0;i<2;i++){
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
				<div id="db_cmd"><a id="refresh" class="submit" onclick="javascript:searchR(\'db_m\');" href="#!">Refresh</a>&nbsp;<a id="add" class="submit" onclick="javascript:edit_db_m(1,null);" href="#!">Add New Account</a>&nbsp;<a id="refresh" class="submit" onclick="javascript:resetSKS();" href="#!">Refresh SKS for KRS</a>&nbsp;<a id="add" class="submit" onclick="javascript:resetSemester(1,true);" href="#!">1 Semester</a>&nbsp;<a id="del" class="submit" onclick="javascript:resetSemester(1,false);" href="#!">1 Semester</a>
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
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
					var x = confirm("Are You Sure want to Reset SKS ?\nReset Settings is 24 SKS for all Semester 1,\nif IPS last Semester (Except Semester 1) are < 3 then they get 21 SKS,\nif IPS last Semester (Except Semester 1) are < 2.5 then they get 18 SKS,\nif IPS last Semester (Except Semester 1) are < 2 then they get 15 SKS,\nif IPS last Semester (Except Semester 1) are < 1.5 then they get 12 SKS,\nif IPS last Semester (Except Semester 1) are < 1 then they get 9 SKS.\n\nTHIS USUALLY USING WHERE SEMESTER ALL OF STUDENT HAS INCREASED 1 OR CHANGE FROM GENAP TO GANJIL OR GANJIL TO GENAP.");
				if(x){
					ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
					$.post("Ajax/database_db_m.php",{code:"refresh_sks_db_mhs"}, function(data) {
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

