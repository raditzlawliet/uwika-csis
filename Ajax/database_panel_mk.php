<?php
$set_height_mk_list = 250;
if(!isset($_COOKIE['set_height_mk_list'])){
	setcookie('set_height_mk_list', "350", time()+3600, "/");
}
$set_height_mk_list = $_COOKIE["set_height_mk_list"];

include 'transfer_mk2.php';

$code = htmlentities($_POST['code']);
$uid = htmlentities($_POST['uid']);
$admin = htmlentities($_POST['admin']);

switch($code){
	case 'db_mk' : { //db mahasiswa
			if(!isset($_COOKIE['set_height_mk_list'])){
				$set_height_mk_list = 350;
			}
			$out = '<div style="text-align:center;width:99%;padding:5px;"><a id="refresh_blue" style="background:url(\'images/down.png\') 1% 50% no-repeat;padding:3px;padding-left:23px;" href="#subject_anchor">SUBJECT</a>&nbsp;<a id="refresh_blue" style="background:url(\'images/down.png\') 1% 50% no-repeat;padding:3px;padding-left:23px;" href="#subject_anchor_d">SUBJECT R LECTURER</a>&nbsp;<a id="refresh_blue" style="background:url(\'images/down.png\') 1% 50% no-repeat;padding:3px;padding-left:23px;" href="#subject_anchor_j">SUBJECT R PROGRAMS</a>&nbsp;<a id="refresh_blue" style="background:url(\'images/down.png\') 1% 50% no-repeat;padding:3px;padding-left:23px;" href="#subject_anchor_m">SUBJECT R STUDENTS</a>&nbsp;<a id="refresh_blue" style="background:url(\'images/down.png\') 1% 50% no-repeat;padding:3px;padding-left:23px;" href="#subject_anchor_s">SUBJECT R REQUIREMENT</a>&nbsp;
				</div><div id="subject_anchor"></div>
				<center><h1 style="letter-spacing:20px;"><b>SUBJECT</b></h1><p>
				<div id="db_cmd"><a id="refresh_blue" class="submit" onclick="javascript:searchR(\'db_mk\');" href="#!">Refresh</a>&nbsp;<a id="add_blue" class="submit" onclick="javascript:edit_db_mk(1,null);" href="#!">Add New Subject</a>&nbsp;
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_mk\');" id="search_db_mk" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_mk\');" id="search_in_db_mk" class="select" title="Search In" dir="ltr">
				<option value="kode_mata_kuliah">CODE</option>
				<option value="nama_mata_kuliah">NAME</option>
				<option value="jumlah_sks">AMOUNT SKS (1-3)</option>
				<option value="probis">PROBIS (0/1)</option>
				<option value="hari">DAY - 1[Monday] - 5[Friday]</option>
				<option value="jam_mulai">TIME BEGIN</option>
				<option value="jam_selesai">TIME END</option>
				</select>
				&nbsp;
				Sort <select onchange="javascript:search(\'db_mk\');" id="sort_db_mk" class="select"  title="Sort" dir="ltr">
				<option value="kode_mata_kuliah">CODE</option>
				<option value="nama_mata_kuliah">NAME</option>
				<option value="jumlah_sks">AMOUNT SKS (1 ~ 3)</option>
				<option value="probis">PROBIS (0 or 1)</option>
				<option value="hari">DAY - 1[Monday] - 5[Friday]</option>
				<option value="jam_mulai">TIME BEGIN</option>
				<option value="jam_selesai">TIME END</option>
				</select>
				By <select onchange="javascript:search(\'db_mk\');" id="sort_by_db_mk" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_mk\');" id="color_db_mk" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_mata_kuliah">
				'.getTabelDatabaseMataKuliah("","","kode_mata_kuliah","ASC","blue","0").'
				</div><p></center>
				<a class="submit" style="background:url(\'images/up.png\') 1% 50% no-repeat;padding:3px;padding-left:23px;" href="#container_space">TOP</a>
				<div id="subject_anchor_d"></div>
				<center><h1 style="letter-spacing:20px;"><b>SUBJECT - LECTURER</b></h1><p>
				<div id="db_cmd"><a id="refresh" class="submit" onclick="javascript:searchR(\'db_mk_d\');" href="#!">Refresh</a>&nbsp;
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_mk_d\');" id="search_db_mk_d" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_mk_d\');" id="search_in_db_mk_d" class="select" title="Search In" dir="ltr">
				<option value="kode_mata_kuliah">CODE</option>
				<option value="nrp">LECTURER NRP</option>
				</select>
				&nbsp;
				Sort <select onchange="javascript:search(\'db_mk_d\');" id="sort_db_mk_d" class="select"  title="Sort" dir="ltr">
				<option value="kode_mata_kuliah">CODE</option>
				<option value="nrp">LECTURER NRP</option>
				</select>
				By <select onchange="javascript:search(\'db_mk_d\');" id="sort_by_db_mk_d" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_mk_d\');" id="color_db_mk_d" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_mata_kuliah_dosen">
				'.getTabelDatabaseMataKuliah_Dosen("","","kode_mata_kuliah","ASC","red","0").'
				</div><p></center>
				<a class="submit" style="background:url(\'images/up.png\') 1% 50% no-repeat;padding:3px;padding-left:23px;" href="#container_space">TOP</a>
				<div id="subject_anchor_j"></div>
				<center><h1 style="letter-spacing:20px;"><b>SUBJECT - PROGRAMS</b></h1><p>
				<div id="db_cmd"><a id="refresh_yellow" class="submit" onclick="javascript:searchR(\'db_mk_j\');" href="#!">Refresh</a>&nbsp;
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_mk_j\');" id="search_db_mk_j" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_mk_j\');" id="search_in_db_mk_j" class="select" title="Search In" dir="ltr">
				<option value="kode_mata_kuliah">SUBJECT CODE</option>
				<option value="kode_jurusan">PROGRAMS CODE</option>
				<option value="semester">SEMESTER</option>
				</select>
				&nbsp;
				Sort <select onchange="javascript:search(\'db_mk_j\');" id="sort_db_mk_j" class="select"  title="Sort" dir="ltr">
				<option value="kode_mata_kuliah">SUBJECT CODE</option>
				<option value="kode_jurusan">JURUSAN CODE</option>
				<option value="semester">SEMESTER</option>
				</select>
				By <select onchange="javascript:search(\'db_mk_j\');" id="sort_by_db_mk_j" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_mk_j\');" id="color_db_mk_j" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_mata_kuliah_jurusan">
				'.getTabelDatabaseMataKuliah_Jurusan("","","kode_mata_kuliah","ASC","yellow","0").'
				</div><p></center>
				<a class="submit" style="background:url(\'images/up.png\') 1% 50% no-repeat;padding:3px;padding-left:23px;" href="#container_space">TOP</a>
				<div id="subject_anchor_m"></div>
				<center><h1 style="letter-spacing:20px;"><b>SUBJECT - STUDENTS</b></h1><p>
				<div id="db_cmd"><a id="refresh" class="submit" onclick="javascript:searchR(\'db_mk_m\');" href="#!">Refresh</a>&nbsp;
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_mk_m\');" id="search_db_mk_m" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_mk_m\');" id="search_in_db_mk_m" class="select" title="Search In" dir="ltr">
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
				&nbsp;
				Sort <select onchange="javascript:search(\'db_mk_m\');" id="sort_db_mk_m" class="select"  title="Sort" dir="ltr">
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
				By <select onchange="javascript:search(\'db_mk_m\');" id="sort_by_db_mk_m" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_mk_m\');" id="color_db_mk_m" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_mata_kuliah_mahasiswa">
				'.getTabelDatabaseMataKuliah_Mahasiswa("","","kode_mata_kuliah","ASC","red","0").'
				</div><p></center>
				<a class="submit" style="background:url(\'images/up.png\') 1% 50% no-repeat;padding:3px;padding-left:23px;" href="#container_space">TOP</a>
				<div id="subject_anchor_s"></div>
				<center><h1 style="letter-spacing:20px;"><b>SUBJECT - REQUIREMENT</b></h1><p>
				<div id="db_cmd"><a id="refresh_blue" class="submit" onclick="javascript:searchR(\'db_mk_s\');" href="#!">Refresh</a>&nbsp;
				Default Panel : <input  onchange="javascript:SetHeightMkKeyUp(this,1)" onKeyUp="javascript:SetHeightMkKeyUp(this,0)" id="set_height_mk_list" name="set_height_mk_list" type="text" style="font-size:9px;" size="2" maxlength="5" value="'.$set_height_mk_list.'"/> px 
				</div>
				<div style="text-align:left;padding-left:25px;">
				Search <input onKeyUp="javascript:search(\'db_mk_s\');" id="search_db_mk_s" class="input" type="text" size="15" maxlength="50" />
				In <select onchange="javascript:search(\'db_mk_s\');" id="search_in_db_mk_s" class="select" title="Search In" dir="ltr">
				<option value="kode_mata_kuliah">SUBJECT CODE</option>
				<option value="kode_mata_kuliah_syarat">SUBJECT REQ CODE</option>
				<option value="kode_syarat">REQUIREMENT CODE</option>
				</select>
				&nbsp;
				Sort <select onchange="javascript:search(\'db_mk_s\');" id="sort_db_mk_s" class="select"  title="Sort" dir="ltr">
				<option value="kode_mata_kuliah">SUBJECT CODE</option>
				<option value="kode_mata_kuliah_syarat">SUBJECT REQ CODE</option>
				<option value="kode_syarat">REQUIREMENT CODE</option>
				</select>
				By <select onchange="javascript:search(\'db_mk_s\');" id="sort_by_db_mk_s" class="select" title="Sort By" dir="ltr">
				<option value="ASC">ASCENDING</option>
				<option value="DESC">DESCENDING</option>
				</select>
				Color <select onchange="javascript:search(\'db_mk_s\');" id="color_db_mk_s" class="select" title="Color">
				<option value="">Green</option>
				<option value="red">Red</option>
				<option value="blue">Blue</option>
				<option value="yellow">Yellow</option>
				</select>
				</div>
				<div id="db_mata_kuliah_syarat">
				'.getTabelDatabaseMataKuliah_Syarat("","","kode_mata_kuliah","ASC","blue","0").'
				</div><p></center>
				<a class="submit" style="background:url(\'images/up.png\') 1% 50% no-repeat;padding:3px;padding-left:23px;" href="#container_space">TOP</a>
				<p>&nbsp;<p>&nbsp;
				<script>
				document.getElementById("color_db_mk").selectedIndex = 2;
				document.getElementById("color_db_mk_d").selectedIndex = 1;				
				document.getElementById("color_db_mk_j").selectedIndex = 3;				
				document.getElementById("color_db_mk_m").selectedIndex = 1;				
				document.getElementById("color_db_mk_s").selectedIndex = 2;				
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
						if(db=="db_mk")$("#db_mata_kuliah").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_mk_d")$("#db_mata_kuliah_dosen").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_mk_j")$("#db_mata_kuliah_jurusan").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_mk_m")$("#db_mata_kuliah_mahasiswa").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_mk_s")$("#db_mata_kuliah_syarat").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax_mk.php",{code:db, search_text:"", search_in:"", sort_text:sort_text, sort_by:sort_by, color:color, page:page}, function(data) {
							if(db=="db_mk")$("#db_mata_kuliah").html(data);
							if(db=="db_mk_d")$("#db_mata_kuliah_dosen").html(data);
							if(db=="db_mk_j")$("#db_mata_kuliah_jurusan").html(data);
							if(db=="db_mk_m")$("#db_mata_kuliah_mahasiswa").html(data);
							if(db=="db_mk_s")$("#db_mata_kuliah_syarat").html(data);
						}); 
					}else{
						if(db=="db_mk")$("#db_mata_kuliah").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_mk_d")$("#db_mata_kuliah_dosen").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_mk_j")$("#db_mata_kuliah_jurusan").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_mk_m")$("#db_mata_kuliah_mahasiswa").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						if(db=="db_mk_s")$("#db_mata_kuliah_syarat").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax_mk.php",{code:db, search_text:search_text, search_in:search_in, sort_text:sort_text, sort_by:sort_by, color:color, page:page}, function(data) {																								
							if(db=="db_mk")$("#db_mata_kuliah").html(data);
							if(db=="db_mk_d")$("#db_mata_kuliah_dosen").html(data);
							if(db=="db_mk_j")$("#db_mata_kuliah_jurusan").html(data);
							if(db=="db_mk_m")$("#db_mata_kuliah_mahasiswa").html(data);
							if(db=="db_mk_s")$("#db_mata_kuliah_syarat").html(data);
						}); 
					}
				}
				function edit_db_mk(kd,kd_mk){
					if(kd!=4){
					data = "&code_edit=" + encodeURI(kd) + "&kode_mk=" + encodeURI(kd_mk);
					ShowHiddenPanel(false,"db_mk","Ajax/database_panel_hidden_mk.php",".main_panel",data);
					}else{
						var x = confirm("Are you want to delete this data ("+kd_mk+") ?");
						if(x){
							var y = confirm("Are You also Want to delete data relationshio with this data ("+kd_mk+") [programs,students,lecturer,requirement] ?");
							var z;if(y){z="true";}else{z="false";}
							$.post("Ajax/database_db_mk.php",{code:kd, kode_mk:kd_mk, value2:z}, function(data) {
								alert(data);
								search(\'db_mk\');
							});	
						}
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

