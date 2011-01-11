<?php
$set_height_mk_list = 250;
if(!isset($_COOKIE['set_height_mk_list'])){
	setcookie('set_height_mk_list', "250", time()+3600, "/");
}
$set_height_mk_list = $_COOKIE["set_height_mk_list"];

include 'transfer_dosen.php';

$code = htmlentities($_POST['code']);
$uid = htmlentities($_POST['uid']);
$admin = htmlentities($_POST['admin']);

switch($code){
	case 'db_d' : { //db mahasiswa
			if(!isset($_COOKIE['set_height_mk_list'])){
				$set_height_mk_list = 250;
			}
			$out = '
				<center><h1 style="letter-spacing:20px;"><b>DOSEN</b></h1><p>
				<div id="db_cmd"><a id="refresh" class="submit" onclick="javascript:searchR(\'db_d\');" href="#!">Refresh</a>&nbsp;<a id="add" class="submit" onclick="javascript:edit_db_d(1,null);" href="#!">Add New Account</a>
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_d\');" id="search_db_d" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_d\');" id="search_in_db_d" class="select" title="Search In" dir="ltr">
				<option value="nrp">NRP</option>
				<option value="nama">NAME</option>
				<option value="aka">ALIAS NAME</option>
				<option value="jenis_kelamin">GENDER</option>
				<option value="kode_jurusan_prioritas">PRIORITY JURUSAN</option>
				<option value="uid">UID</option>
				<option value="admin">ADMIN</option>
				</select>
				&nbsp; &nbsp;				&nbsp; &nbsp;				&nbsp; &nbsp;
				Sort <select onchange="javascript:search(\'db_d\');" id="sort_db_d" class="select"  title="Sort" dir="ltr">
				<option value="nrp">NRP</option>
				<option value="nama">NAME</option>
				<option value="aka">ALIAS NAME</option>
				<option value="jenis_kelamin">GENDER</option>
				<option value="kode_jurusan_prioritas">PRIORITY JURUSAN</option>
				<option value="uid">UID</option>
				<option value="admin">ADMIN</option>
				</select>
				By <select onchange="javascript:search(\'db_d\');" id="sort_by_db_d" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_d\');" id="color_db_d" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_dosen">
				'.getTabelDatabaseDosen("","","nrp","ASC","red","0").'
				</div><p>
				</center>
				<script>
				document.getElementById("color_db_d").selectedIndex = 1;
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
						$("#db_dosen").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax_dosen.php",{code:db, search_text:"", search_in:"", sort_text:sort_text, sort_by:sort_by, color:color,page:page}, function(data) {
							$("#db_dosen").html(data);
						}); 
					}else{
						$("#db_dosen").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax_dosen.php",{code:db, search_text:search_text, search_in:search_in, sort_text:sort_text, sort_by:sort_by, color:color,page:page}, function(data) {
							$("#db_dosen").html(data);
						}); 
					}	
				}
				function edit_db_d(kd,nrp){
					if(kd!=4){
					data = "&code_edit=" + encodeURI(kd) + "&nrp=" + encodeURI(nrp);
					ShowHiddenPanel(false,"db_d","Ajax/database_panel_hidden_dosen.php",".main_panel",data);
					}else{
						var x = confirm("Apa kamu yakin mau menghapus data ini ("+nrp+") ?");
						if(x){
						$.post("Ajax/database_db_d.php",{code:kd, nrp:nrp}, function(data) {
							alert(data);
							search(\'db_d\');
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

