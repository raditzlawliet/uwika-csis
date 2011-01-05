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
				<center><h1 style="letter-spacing:20px;"><b>IPS SCORE</b></h1><p>
				<div id="db_cmd"><a id="refresh_blue" class="submit" onclick="javascript:searchR(\'db_sc\');" href="#!">Refresh</a>&nbsp;<a id="add_blue" class="submit" onclick="javascript:edit_db_sc(1,null);" href="#!">Add New Students IPS</a>
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
			
			
				<center><h1 style="letter-spacing:20px;"><b>SUBJECT SCORE</b></h1><p>
				<div id="db_cmd"><a id="refresh_blue" class="submit" onclick="javascript:searchR(\'db_sc2\');" href="#!">Refresh</a>&nbsp;<a id="add_blue" class="submit" onclick="javascript:edit_db_sc2(1,null);" href="#!">Add New Subject Students Score</a>
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_sc2\');" id="search_db_sc2" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_sc2\');" id="search_in_db_sc2" class="select" title="Search In" dir="ltr">
				<option value="kode_mata_kuliah">SUBJECT CODE</option>
				<option value="nrp">NRP</option>
				<option value="masa">MOMENT</option>
				<option value="semester">SEMESTER</option>
				<option value="nilai">SCORE</option>
				</select>
				&nbsp; &nbsp;				&nbsp; &nbsp;				&nbsp; &nbsp;
				Sort <select onchange="javascript:search(\'db_sc2\');" id="sort_db_sc2" class="select"  title="Sort" dir="ltr">
				<option value="kode_mata_kuliah">SUBJECT CODE</option>
				<option value="nrp">NRP</option>
				<option value="masa">MOMENT</option>
				<option value="semester">SEMESTER</option>
				<option value="nilai">SCORE</option>
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
						var x = confirm("Are you want to delete this data ("+nrp+" - "+value+") ?");
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
						var x = confirm("Are you want to delete this data ("+nrp+" - "+value+" - "+value2+") ?");
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

