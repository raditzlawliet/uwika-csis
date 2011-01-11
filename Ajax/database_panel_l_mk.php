<?php
$set_height_mk_list = 250;
if(!isset($_COOKIE['set_height_mk_list'])){
	setcookie('set_height_mk_list', "250", time()+3600, "/");
}
$set_height_mk_list = $_COOKIE["set_height_mk_list"];

include 'transfer_l_mk.php';

$code = htmlentities($_POST['code']);
$uid = htmlentities($_POST['uid']);
$admin = htmlentities($_POST['admin']);

switch($code){
	case 'db_l_mk' : { //db mahasiswa
			if(!isset($_COOKIE['set_height_mk_list'])){
				$set_height_mk_list = 250;
			}
			$out = '<br>
				<center><h1 style="letter-spacing:15px;"><b>LIST PER-MATA KULIAH</b></h1><p>
				<div id="db_cmd">
				List dr Kode MK <input id="search_db_l_mk" class="input" type="text" size="15" maxlength="50" />	&nbsp;<img src="images/q.png" width="15px" title="Hint ! Ketik NRP setelah itu tekan Lihat ! (Otomatis akan berubah jika text / pilihan ada yang berubah.">&nbsp;<a id="refresh_pink" class="submit" onclick="javascript:searchR(\'db_l_mk\');" href="#!">Lihat</a>&nbsp;
				Urut <select onchange="javascript:search(\'db_l_mk\');" id="sort_db_l_mk" class="select"  title="Sort" dir="ltr">
				<option value="nrpn">NRP</option>
				<option value="nama">Nama</option>
				<option value="kode_jurusanx">Kode Jurusan</option>
				<option value="nama_jurusan">Jurusan</option>
				<option value="semesterz">Semester [M]</option>
				<option value="ipk">IPK</option>
				<option value="semesterx">Semester Saat Registrasi [M]</option>
				<option value="masa">Masa</option>
				<option value="hari_register">Hari Registrasi</option>
				<option value="time_register">Jam Registrasi</option>
				<option value="tanggal_register">Tanggal Registrasi</option>
				<option value="nilai">Nilai</option>
				<option value="lulus">Lulus</option>
				</select>
				Dari <select onchange="javascript:search(\'db_l_mk\');" id="sort_by_db_l_mk" class="select" title="Sort By" dir="ltr">
				<option value="ASC">Awal</option>
				<option value="DESC">Akhir</option>
				</select>
				Warna <select onchange="javascript:search(\'db_l_mk\');" id="color_db_l_mk" class="select" title="Color">
				<option value="">Hijau</option>
				<option value="red">Merah</option>
				<option value="blue">Biru</option>
				<option value="yellow">Kuning</option>
				<option value="pink">Pink</option>
				<option value="bw">Black & White</option>
				</select>
				</div>
				<div id="db_cmd"><table id="show">
				<tr><td>Auto script : <a id="refresh_pink" class="submit" onclick="javascript:asKey(\'as_nilai\');" href="#!">Report Nilai [T]</a>&nbsp;<a id="refresh_pink" class="submit" onclick="javascript:asKey(\'as_krs\');" href="#!">List M Yg Daftar Sekarang [T]</a>&nbsp;<a id="refresh_pink" class="submit" onclick="javascript:asKey(\'as_lulus\');" href="#!">Sudah Lulus MK ini</a>&nbsp;<a id="refresh_pink" class="submit" onclick="javascript:asKey(\'as_absen\');" href="#!">Absen [T]</a><div id="showr"><form style="margin-top:5px;float:right;"action="Ajax/report_l_mk.php" method="post"><input style="border:1px solid #FFB0FF;background:#FFB0FF;font-size:11px;margin:3px;"; type="submit" value="Tampilkan Laporan Semua MK !"/><input name="code" type="hidden" value="db_l_mk" /><input name="search_text" type="hidden" value="\'+search_text+\'" /><input name="search_in" type="hidden" value="\'+search_in+\'" /><input name="sort_text" type="hidden" value="\'+sort_text+\'" /><input name="sort_by" type="hidden" value="\'+sort_by+\'" /><input name="color" type="hidden" value="\'+color+\'" /><input name="page" type="hidden" value="\'+page+\'" /><input name="limit" type="hidden" value="\'+limit+\'" /><input name="show" type="hidden" value="\'+show+\'" /><input name="search2" type="hidden" value="\'+search2+\'" /><input name="sx" type="hidden" value="\'+sx+\'" /><input name="ad" type="hidden" value="\'+ad+\'" /><input name="ab" type="hidden" value="\'+ab+\'" /><input name="all" type="hidden" value="all" /></form></div></td></tr></table>
				<table id="show">
				<tr><td>Cari Tabel : </td><td><input id="search_db_l_mk_2_1" class="input" type="text" size="15" maxlength="50" /></td><td>
				Di <select id="search_in_db_l_mk_2_1" class="select"  title="Sort" dir="ltr">
				<option value="tr_mata_kuliah_mahasiswa.nrp">NRP</option>
				<option value="nama">Nama</option>
				<option value="t_mahasiswa.kode_jurusan">Kode Jurusan</option>
				<option value="t_jurusan.nama_jurusan">Jurusan</option>
				<option value="t_mahasiswa.semester">Semester [M]</option>
				<option value="ipk">IPK</option>
				<option value="tr_mata_kuliah_mahasiswa.semester">Semester Saat Registrasi [M]</option>
				<option value="masa">Masa</option>
				<option value="hari_register">Hari Registrasi</option>
				<option value="time_register">Jam Registrasi</option>
				<option value="tanggal_register">Tanggal Registrasi</option>
				<option value="nilai">Nilai</option>
				<option value="lulus">Lulus</option>
				</select></td><td>
				Op <select id="operasi_db_l_mk_2_1" class="select" title="Color"><option value="=">Sama Dengan</option><option value="LIKE">Seperti</option></select></td><td>
				Penghubung <select id="penghubung_db_l_mk_2_1" class="select" title="Color"><option value="AND">Dan</option><option value="OR">Atau</option></select></td><td></td></tr>
				<tr><td><a id="refresh_pink" class="submit" onclick="javascript:searchRQ(\'db_l_mk\');" href="#!">Lihat</a>&nbsp;</td>
				</table>
				</div>
				<div id="db_cmd"><table id="show"><tr>
				<td>Show : </td>				
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_0" type="checkbox" value="" checked />NRP </td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_2" type="checkbox" value="" />KD Jurusan [M]</td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_4" type="checkbox" value="" />Semester [M]</td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_6" type="checkbox" value="" checked />Semester Wkt Regist [M]</td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_8" type="checkbox" value="" />Hari R</td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_10" type="checkbox" value="" checked />Tanggal R</td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_12" type="checkbox" value="" checked />Lulus </td></tr>
				<tr><td></td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_1" type="checkbox" value="" checked />Nama</td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_3" type="checkbox" value="" checked />Jurusan [M]</td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_5" type="checkbox" value="" checked />IPK </td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_7" type="checkbox" value="" checked />Masa M</td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_9" type="checkbox" value="" checked />Jam R</td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_11" type="checkbox" value="" checked />Nilai</td>
				<td><input onchange="javascript:search(\'db_l_mk\');" id="db_l_mk_c_limit" type="checkbox" value="" />Limit</td></tr>
				</table><div id="report_l_mk">
				MK : Mata Kuliah, M : Mahasiswa, R : Registrasi, T : Table Ditata. &nbsp;
				</div>
				</div>
				<div id="db_l_mkahasiswa">
				Isi Kode MK dengan benar, agar list bisa tertampilkan.
				</div><p>
				</center>
				<script>
				$("#search_db_l_mk").autocomplete("Ajax/transfer_mk2_inner.php?qj=mks", {
					minChars: 0,
					width: 350,
					mustMatch: true,
					matchContains: true,
					dataType: "json",
					parse: function(data) {
						return $.map(data, function(row) {
							return {
								data: row,
								value: row.nama_mata_kuliah,
								result: row.kode_mata_kuliah
							}
						});
					},formatItem: function(row, i, max) {
						return i + "/" + max + ": \"" + row.nama_mata_kuliah + "\" (" + row.kode_mata_kuliah + ")";
					},
					formatMatch: function(row, i, max) {
						return row.nama_mata_kuliah + " " + row.kode_mata_kuliah;
					},
					formatResult: function(row) {
						return row.kode_mata_kuliah;
					}
				});
				var sx = 1;
				document.getElementById("color_db_l_mk").selectedIndex = 4;
				function asKey(key){
					if(key=="as_nilai"){
						document.getElementById(\'search_db_l_mk_2_1\').value = "";
						document.getElementById(\'search_in_db_l_mk_2_1\').value = "masa";
						document.getElementById(\'operasi_db_l_mk_2_1\').value = "=";
						document.getElementById(\'penghubung_db_l_mk_2_1\').value = "AND";
						for(var i=0;i<13;i++){document.getElementById(\'db_l_mk_c_\'+i).checked=false;}
						document.getElementById(\'db_l_mk_c_1\').checked=true;
						document.getElementById(\'db_l_mk_c_3\').checked=true;
						document.getElementById(\'db_l_mk_c_6\').checked=true;
						document.getElementById(\'db_l_mk_c_5\').checked=true;
						document.getElementById(\'db_l_mk_c_0\').checked=true;
						document.getElementById(\'db_l_mk_c_12\').checked=true;
						document.getElementById(\'db_l_mk_c_11\').checked=true;
						document.getElementById(\'db_l_mk_c_7\').checked=true;
						document.getElementById(\'db_l_mk_c_4\').checked=true;
						document.getElementById(\'db_l_mk_c_10\').checked=true;
						}
					if(key=="as_lulus"){
						document.getElementById(\'search_db_l_mk_2_1\').value = "1";
						document.getElementById(\'search_in_db_l_mk_2_1\').value = "lulus";
						document.getElementById(\'operasi_db_l_mk_2_1\').value = "=";
						document.getElementById(\'penghubung_db_l_mk_2_1\').value = "AND";
						}
					if(key=="as_krs"){
						document.getElementById(\'search_db_l_mk_2_1\').value = "'.getValueSettingsOf("tahun").'/'.getValueSettingsOf("semester").'";
						document.getElementById(\'search_in_db_l_mk_2_1\').value = "masa";
						document.getElementById(\'operasi_db_l_mk_2_1\').value = "=";
						document.getElementById(\'penghubung_db_l_mk_2_1\').value = "AND";
						for(var i=0;i<13;i++){document.getElementById(\'db_l_mk_c_\'+i).checked=false;}
						document.getElementById(\'db_l_mk_c_1\').checked=true;
						document.getElementById(\'db_l_mk_c_3\').checked=true;
						document.getElementById(\'db_l_mk_c_6\').checked=true;
						document.getElementById(\'db_l_mk_c_5\').checked=true;
						document.getElementById(\'db_l_mk_c_0\').checked=true;
						}
					if(key=="as_absen"){
						document.getElementById(\'search_db_l_mk_2_1\').value = "'.getValueSettingsOf("tahun").'/'.getValueSettingsOf("semester").'";
						document.getElementById(\'search_in_db_l_mk_2_1\').value = "masa";
						document.getElementById(\'operasi_db_l_mk_2_1\').value = "=";
						document.getElementById(\'penghubung_db_l_mk_2_1\').value = "AND";
						for(var i=0;i<13;i++){document.getElementById(\'db_l_mk_c_\'+i).checked=false;}
						document.getElementById(\'db_l_mk_c_1\').checked=true;
						document.getElementById(\'db_l_mk_c_3\').checked=true;
						document.getElementById(\'db_l_mk_c_0\').checked=true;
						ab=1;
						}
					search(\'db_l_mk\');
				}
				var ab=0;
				function searchRQ(db){searchpage(db,1);}
				function searchR(db){searchpage(db,1);}
				function search(db){searchpage(db,1);}
				function searchpage(db,page){
					var search_text = document.getElementById(\'search_\'+db).value;
					var search_in = "kode_mata_kuliah"; //document.getElementById(\'search_in_\'+db).value;
					var sort_text = document.getElementById(\'sort_\'+db).value;
					var sort_by = document.getElementById(\'sort_by_\'+db).value;
					var color = document.getElementById(\'color_\'+db).value;
					var limit = document.getElementById(\'db_l_mk_c_limit\').checked;
					var show = "";for(var i=0;i<13;i++){show=show+document.getElementById(\'db_l_mk_c_\'+i).checked+"|";}
					var search2="";
					var test = document.getElementById(\'search_\'+db+\'_2_1\').value;
					var ad = "0";
					$("#showr").html(\'<form style="margin-top:5px;float:right;"action="Ajax/report_l_mk.php" method="post"><input style="border:1px solid #FFB0FF;background:#FFB0FF;font-size:11px;margin:3px;"; type="submit" value="Tampilkan Laporan Semua MK !"/><input name="code" type="hidden" value="db_l_mk" /><input name="search_text" type="hidden" value="\'+search_text+\'" /><input name="search_in" type="hidden" value="\'+search_in+\'" /><input name="sort_text" type="hidden" value="\'+sort_text+\'" /><input name="sort_by" type="hidden" value="\'+sort_by+\'" /><input name="color" type="hidden" value="\'+color+\'" /><input name="page" type="hidden" value="\'+page+\'" /><input name="limit" type="hidden" value="\'+limit+\'" /><input name="show" type="hidden" value="\'+show+\'" /><input name="search2" type="hidden" value="\'+search2+\'" /><input name="sx" type="hidden" value="\'+sx+\'" /><input name="ad" type="hidden" value="\'+ad+\'" /><input name="ab" type="hidden" value="\'+ab+\'" /><input name="all" type="hidden" value="all" /></form>\');
					if((test==null)||(test=="")||(test==" ")||(test=="  ")){ad="0";}else{
						ad = "1";
						search2 = search2+document.getElementById(\'search_\'+db+\'_2_1\').value+"|";
						search2 = search2+document.getElementById(\'search_in_\'+db+\'_2_1\').value+"|";
						search2 = search2+document.getElementById(\'operasi_\'+db+\'_2_1\').value+"|";
						search2 = search2+document.getElementById(\'penghubung_\'+db+\'_2_1\').value+"|";
					}
					if((search_text==null)||(search_text=="")||(search_text==" ")||(search_text=="  ")){
						$("#db_l_mkahasiswa").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$("#db_l_mkahasiswa").html("Isi Kode MK dengan benar, agar list bisa tertampilkan.");
						ab=0;
					}else{
						$("#db_l_mkahasiswa").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax_l_mk.php",{code:db, search_text:search_text, search_in:search_in, sort_text:sort_text, sort_by:sort_by, color:color,page:page,limit:limit, show:show,search2:search2, sx:sx, ad:ad, ab:ab}, function(data) {
							$("#db_l_mkahasiswa").html(data);
							$("#report_l_mk").html(\'<form action="Ajax/report_l_mk.php" method="post">MK : Mata Kuliah, M : Mahasiswa, R : Registrasi. &nbsp;<input style="border:1px solid #FFB0FF;background:#FFB0FF;font-size:11px;margin:3px;"; type="submit" value="Tampilkan Laporan !"/><input name="code" type="hidden" value="\'+db+\'" /><input name="search_text" type="hidden" value="\'+search_text+\'" /><input name="search_in" type="hidden" value="\'+search_in+\'" /><input name="sort_text" type="hidden" value="\'+sort_text+\'" /><input name="sort_by" type="hidden" value="\'+sort_by+\'" /><input name="color" type="hidden" value="\'+color+\'" /><input name="page" type="hidden" value="\'+page+\'" /><input name="limit" type="hidden" value="\'+limit+\'" /><input name="show" type="hidden" value="\'+show+\'" /><input name="search2" type="hidden" value="\'+search2+\'" /><input name="sx" type="hidden" value="\'+sx+\'" /><input name="ad" type="hidden" value="\'+ad+\'" /><input name="ab" type="hidden" value="\'+ab+\'" /></form>\');
							ab=0;
						}); 
					}	
				}
								search("db_l_mk");

				function edit_db_l_mk(kd,nrp){
					if(kd!=4){
					data = "&code_edit=" + encodeURI(kd) + "&nrp=" + encodeURI(nrp);
					ShowHiddenPanel(false,"db_l_mk","Ajax/database_panel_hidden_l_m.php",".main_panel",data);
					}else{
						var x = confirm("Apa kamu yakin mau menghapus data ini ("+nrp+") ?");
						if(x){
						$.post("Ajax/database_db_l_mk.php",{code:kd, nrp:nrp}, function(data) {
							alert(data);
							search(\'db_l_mk\');
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

