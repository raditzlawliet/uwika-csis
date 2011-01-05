<?php
$set_height_mk_list = 250;
if(!isset($_COOKIE['set_height_mk_list'])){
	setcookie('set_height_mk_list', "250", time()+3600, "/");
}
$set_height_mk_list = $_COOKIE["set_height_mk_list"];

include 'transfer_jf.php';

$code = htmlentities($_POST['code']);
$uid = htmlentities($_POST['uid']);
$admin = htmlentities($_POST['admin']);

switch($code){
	case 'db_jf' : { //db mahasiswa
			if(!isset($_COOKIE['set_height_mk_list'])){
				$set_height_mk_list = 250;
			}
			$out = '
				<center><h1 style="letter-spacing:20px;"><b>PROGRAMS</b></h1><p>
				<div id="db_cmd"><a id="refresh_yellow" class="submit" onclick="javascript:searchR(\'db_jf\');" href="#!">Refresh</a>&nbsp;<a id="add_yellow" class="submit" onclick="javascript:edit_db_jf(1,null);" href="#!">Add New Programs</a>
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_jf\');" id="search_db_jf" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_jf\');" id="search_in_db_jf" class="select" title="Search In" dir="ltr">
				<option value="kode_jurusan">PROGRAMS CODE</option>
				<option value="nama_jurusan">PROGRAMSNAME</option>
				<option value="kode_fakultas">FACULTY CODE</option>
				<option value="kode_depan_mata_kuliah">SUBJECT CODE</option>
				</select>
				&nbsp; &nbsp;				&nbsp; &nbsp;				&nbsp; &nbsp;
				Sort <select onchange="javascript:search(\'db_jf\');" id="sort_db_jf" class="select"  title="Sort" dir="ltr">
				<option value="kode_jurusan">PROGRAMS CODE</option>
				<option value="nama_jurusan">PROGRAMSNAME</option>
				<option value="kode_fakultas">FACULTY CODE</option>
				<option value="kode_depan_mata_kuliah">SUBJECT CODE</option>
				</select>
				By <select onchange="javascript:search(\'db_jf\');" id="sort_by_db_jf" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_jf\');" id="color_db_jf" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_jft">
				'.getTabelDatabaseJurusan("","","kode_jurusan","ASC","yellow","0").'
				</div><p>
				</center>
				
				<center><h1 style="letter-spacing:20px;"><b>FACULTY</b></h1><p>
				<div id="db_cmd"><a id="refresh_yellow" class="submit" onclick="javascript:searchR(\'db_jf2\');" href="#!">Refresh</a>&nbsp;<a id="add_yellow" class="submit" onclick="javascript:edit_db_jf2(1,null);" href="#!">Add New Faculty</a>
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_jf2\');" id="search_db_jf2" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_jf2\');" id="search_in_db_jf2" class="select" title="Search In" dir="ltr">
				<option value="kode_fakultas">FACULTY CODE</option>
				<option value="nama_fakultas">FACULTY NAME</option>
				</select>
				&nbsp; &nbsp;				&nbsp; &nbsp;				&nbsp; &nbsp;
				Sort <select onchange="javascript:search(\'db_jf2\');" id="sort_db_jf2" class="select"  title="Sort" dir="ltr">
				<option value="kode_fakultas">FACULTY CODE</option>
				<option value="nama_fakultas">FACULTY NAME</option>
				</select>
				By <select onchange="javascript:search(\'db_jf2\');" id="sort_by_db_jf2" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_jf2\');" id="color_db_jf2" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_jft2">
				'.getTabelDatabaseFakultas("","","kode_fakultas","ASC","yellow","0").'
				</div><p>
				</center>
				<script>
				document.getElementById("color_db_jf").selectedIndex = 3;
				document.getElementById("color_db_jf2").selectedIndex = 3;
				
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
						if(db=="db_jf")$("#db_jft").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_jf2")$("#db_jft2").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax_jf.php",{code:db, search_text:"", search_in:"", sort_text:sort_text, sort_by:sort_by, color:color,page:page}, function(data) {
							if(db=="db_jf")$("#db_jft").html(data);
							if(db=="db_jf2")$("#db_jft2").html(data);
						}); 
					}else{
						if(db=="db_jf")$("#db_jft").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_jf2")$("#db_jft2").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax_jf.php",{code:db, search_text:search_text, search_in:search_in, sort_text:sort_text, sort_by:sort_by, color:color,page:page}, function(data) {
							if(db=="db_jf")$("#db_jft").html(data);
							if(db=="db_jf2")$("#db_jft2").html(data);
						}); 
					}	
				}
				function edit_db_jf(kd,nrp){
					if(kd!=4){
					data = "&code_edit=" + encodeURI(kd) + "&nrp=" + encodeURI(nrp);
					ShowHiddenPanel(false,"db_jf","Ajax/database_panel_hidden_jf.php",".main_panel",data);
					}else{
						var x = confirm("Are you want to delete this data ("+nrp+") ?");
						if(x){
						$.post("Ajax/database_db_jf.php",{code:kd, nrp:nrp}, function(data) {
							alert(data);
							search(\'db_jf\');
						});	}
					}
				}
				function edit_db_jf2(kd,nrp){
					if(kd!=4){
					data = "&code_edit=" + encodeURI(kd) + "&nrp=" + encodeURI(nrp);
					ShowHiddenPanel(false,"db_jf2","Ajax/database_panel_hidden_jf.php",".main_panel",data);
					}else{
						var x = confirm("Are you want to delete this data ("+nrp+") ?");
						if(x){
							kd="2"+""+kd;
						$.post("Ajax/database_db_jf.php",{code:kd, nrp:nrp}, function(data) {
							alert(data);
							search(\'db_jf2\');
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

