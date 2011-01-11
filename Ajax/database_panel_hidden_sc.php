<?php
include 'transfer_sc.php';

$code = htmlentities($_POST['code_hidden']);
$code_ = htmlentities($_POST['code_edit']);
$nrp = htmlentities($_POST['nrp']);
$value = htmlentities($_POST['value']);
$value2 = htmlentities($_POST['value2']);

switch($code){
	case 'db_sc' : { //db awal
		switch($code_){
			case 1:{ //add
				$view = '';
				$addd = '<div style="background:red;">Usually 0 for new students.</div>';
				break;}
			case 2:{ //modify
				$view= '';
				break;}
			case 3:{ //view
				$view = 'disabled="true"';
				break;}
			case 4:{ //delete
				break;}
		}
			$set_height = "250";
			if(isset($_COOKIE['set_height_mk_list'])){
				$set_height = $_COOKIE['set_height_mk_list'];
			}
			$data = getDataDatabaseIPS($nrp,$value);
			
			$status = array("q"=>'<img src="images/q.png" width="15px" title="Hint ! Type 1 word then search it">');
			$table = $table.
			'
			<tr><td>Students NRP</td><td>:</td><td><input class="input" id="set_db_sc_1" onchange="javascript:getUpdate();" maxlength="8" size="30" '.$view.' value="'.$data['nrp'].'"\>&nbsp;'.$status["q"].'</td></tr>
			<td>Students Name</td><td>:</td><td><input class="input" id="set_db_sc_1a" style="background:#FFE1E2;border:none;" maxlength="49" size="30" disabled="true" value="'.$data['nama'].'"\></td></tr>
			<td>Semester</td><td>:</td><td><input class="input" id="set_db_sc_2" maxlength="2" size="30" '.$view.' value="'.$data['semester'].'"\></td>
			<td>Semester Dia Sekarang</td><td>:</td><td><input class="input" id="set_db_sc_2a" maxlength="2" size="30" disabled="true"\></td></tr>
			<td>IPS</td><td>:</td><td><input class="input" id="set_db_sc_3" maxlength="4" size="30" '.$view.' value="'.$data['ips'].'"\></td></tr>
			';
			$out = '<div><b><center>N I L A I &nbsp; &nbsp; I P S</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table>
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVE('.$code_.')" class="button" href="#!"><b>&nbsp;SIMPAN&nbsp;</b></a></td><td><a onclick="javascript:HidePanel();" class="button" id="diff" href="#!"><b>BATAL</b></a></td></tr></table>
			</div>
			<script>
			
				$.post("Ajax/database_db_sc.php",{nrp: "'.$nrp.'", code:"getLastSemester"}, function(data_) {
					document.getElementById("set_db_sc_2a").value=data_;
				}); 
			$(function() {
				$("#set_db_sc_1").autocomplete("Ajax/transfer_mk2_inner.php?qj=mkm", {
					minChars: 0,
					width: 310,
					mustMatch: true,
					matchContains: true,
					autoFill: false,
					dataType: "json",
					parse: function(data) {
						return $.map(data, function(row) {
							return {
								data: row,
								value: row.nama,
								result: row.nrp
							}
						});
					},formatItem: function(row, i, max) {
						return i + "/" + max + ": \"" + row.nama + "\" (" + row.nrp + ")";
					},
					formatMatch: function(row, i, max) {
						return row.nama + " " + row.nrp;
					},
					formatResult: function(row) {
						return row.nrp;
					}
				}).result(function(e, item) {
					document.getElementById("set_db_sc_1a").value=item.nama;
					$.post("Ajax/database_db_sc.php",{nrp: item.nrp, code:"getLastSemester"}, function(data_) {
						document.getElementById("set_db_sc_2a").value=data_;
					}); 
				});
			});
		 	function getUpdate(){
					$.post("Ajax/database_db_sc.php",{nrp: document.getElementById("set_db_sc_1").value, code:"getLastSemester"}, function(data_) {
						document.getElementById("set_db_sc_2a").value=data_;
					}); 
			}
			function GoSAVE(v){  //1 add, 2 modif
			if(v==3){HidePanel();return false;}
				if((parseFloat(document.getElementById("set_db_sc_3").value)>4)||(parseFloat(document.getElementById("set_db_sc_3").value)<0)){alert("Inputan IPS 0~4");return false;}
				if((parseFloat(document.getElementById("set_db_sc_2").value)>25)||(parseFloat(document.getElementById("set_db_sc_3").value)<0)){alert("Inputan Semester 0~25");return false;}
				var value = "";
				value = document.getElementById("set_db_sc_1").value +"|"+document.getElementById("set_db_sc_2").value +"|"+document.getElementById("set_db_sc_3").value+"|";
				ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
				$.post("Ajax/database_db_sc.php",{nrp: "'.$nrp.'", value:value, code:v, value2:"'.$value.'"}, function(data_) {
					alert(data_);
					search(\'db_sc\');
					HidePanel();
				}); 
			}

			if("'.$code_.'"=="1"){alert("Fill the Blank !");}
			</script>
			';
			exit($out);
		break;
	}
case 'db_sc2' : { //db awal
		switch($code_){
			case 1:{ //add
				$view = '';
				$addd = '<div style="background:red;">Usually 0 for new students.</div>';
				break;}
			case 2:{ //modify
				$view= '';
				break;}
			case 3:{ //view
				$view = 'disabled="true"';
				break;}
			case 4:{ //delete
				break;}
		}
			$set_height = "250";
			if(isset($_COOKIE['set_height_mk_list'])){
				$set_height = $_COOKIE['set_height_mk_list'];
			}
			$data = getDataDatabaseNilai($nrp,$value,$value2); //$kd,$nrp,$m | $nrp,$value,$value2
			for($i=11;$i!=999;$i--){
				if($i<10)$thn = "0";
				else $thn = "";
				$opt_angkatan= $opt_angkatan.'<option value="'.$thn.$i.'">';
				if($i>=45)$thn = "19".$thn.$i;
				else $thn = "20".$thn.$i;
				$opt_angkatan = $opt_angkatan.$thn.'</option>';
				if($i==0)$i=100;
				if($i==75)$i=1000;
			}			
			$thn_;$bln_;$hri_;
			for($i=2050;$i>=1960;$i--){$thn_ = $thn_.'<option value="'.$i.'">'.$i.'</option>';}
			for($i=1;$i<=31;$i++){if($i<10)$x = "0";else $x = "";if($i<=12)$bln_ = $bln_.'<option value="'.$x.$i.'">'.$x.$i.'</option>';$hri_ = $hri_.'<option value="'.$x.$i.'">'.$x.$i.'</option>';}
			$jam_;$mnt_;
			for($i=0;$i<=59;$i++){if($i<10)$x = "0";else $x = "";if($i<=24)$jam_ = $jam_.'<option value="'.$x.$i.'">'.$x.$i.'</option>';$mnt_ = $mnt_.'<option value="'.$x.$i.'">'.$x.$i.'</option>';}
			$status = array("q"=>'<img src="images/q.png" width="15px" title="Hint ! Type 1 word then search it">');
			$table = $table.
			'
			<tr>
				<tr><td>Kode MK</td><td>:</td><td><input class="input" id="set_db_mk_m_0" maxlength="8" size="30" '.$view.' value="'.$data['kode_mata_kuliah'].'"\>&nbsp;'.$status["q"].'</td></tr>
				<tr><td>Nama MK</td><td>:</td><td><input class="input" id="set_db_mk_m_0a" style="background:#FFE1E2;border:none;" maxlength="49" size="30" disabled="true" value="'.$data['nama'].'"\></td></tr>
				<tr><td>Students NRP</td><td>:</td><td><input class="input" id="set_db_mk_m_1" maxlength="8" size="30" '.$view.' value="'.$data['nrp'].'"\>&nbsp;'.$status["q"].'</td></tr>
				<tr><td>Students Name</td><td>:</td><td><input class="input" id="set_db_mk_m_1a" style="background:#FFE1E2;border:none;" maxlength="49" size="30" disabled="true" value="'.$data['nama'].'"\></td></tr>
				<tr><td>Semester</td><td>:</td><td><input class="input" id="set_db_mk_m_2" maxlength="2" size="2" '.$view.'\>&nbsp;Masa&nbsp;:&nbsp;<select class="input" id="set_db_mk_m_3a" title="fakultas" dir="ltr" '.$view.'>'.$thn_.'</select><select class="input" id="set_db_mk_m_3b" dir="ltr"  '.$view.'><option value="1">1 (Ganjil)</option><option value="2">2 (Genap)</option></select>&nbsp;<a class="submit" onclick="javascript:getUpdate('.$code_.');" href="#!">Cri SMS dr NRP & MASA skrng</a></td></tr>
				
				<tr><td>Day Registered</td><td>:</td><td><select class="input" id="set_db_mk_m_4" dir="ltr" '.$view.'><option value="0">Sunday</option><option value="1">Senin</option><option value="2">Selasa</option><option value="3">Rabu</option><option value="4">Kamis</option><option value="5">Jumat</option><option value="6">Sabtu</option></select></td></tr>
				
				<tr><td>Time Registered</td><td>:</td><td><select class="input" id="set_db_mk_m_5_jam" dir="ltr" '.$view.'>'.$jam_.'</select> : <select class="input" id="set_db_mk_m_5_mnt" dir="ltr" '.$view.'>'.$mnt_.'</select> : <select class="input" id="set_db_mk_m_5_dtk" dir="ltr" '.$view.'>'.$mnt_.'</select></td></tr>
				
				<tr><td>Date Registered</td><td>:</td><td><select class="input" id="set_db_mk_m_6_thn" title="fakultas" dir="ltr" '.$view.'>'.$thn_.'</select> - <select class="input" id="set_db_mk_m_6_bln" title="fakultas" dir="ltr" '.$view.'>'.$bln_.'</select> - <select class="input" id="set_db_mk_m_6_hri" title="fakultas" dir="ltr" '.$view.'>'.$hri_.'</select>&nbsp;<label style="color:red"> (YYYY-MM-DD)</label></td></tr>
				
				<tr><td>Nilai</td><td>:</td><td><input class="input" id="set_db_mk_m_7" maxlength="6" size="2" '.$view.' value="'.$data['nilai'].'"\>&nbsp;Is Complete ?&nbsp;:&nbsp;<select class="input" id="set_db_mk_m_8" dir="ltr" '.$view.'><option value="0">0 (Not Complete)</option><option value="1">1 (Complete)</option></select>&nbsp;<a class="submit" onclick="javascript:setlulus('.$code_.');" href="#!">Cri KELULUSAN dr NILAI</a></td></tr>
			</td></tr>
			';
			$out = '<div><b><center>S U B J E C T &nbsp; &nbsp; S C O R E</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table>
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVE('.$code_.')" class="button" href="#!"><b>&nbsp;SIMPAN&nbsp;</b></a></td><td><a onclick="javascript:HidePanel();" class="button" id="diff" href="#!"><b>BATAL</b></a></td></tr></table>
			</div>
			<script>
				document.getElementById("set_db_mk_m_0").value="'.$data['kode_mata_kuliah'].'";
				document.getElementById("set_db_mk_m_0a").value="'.$data['nama_mata_kuliah'].'";
				document.getElementById("set_db_mk_m_1").value="'.$data['nrp'].'";
				document.getElementById("set_db_mk_m_1a").value="'.$data['nama'].'";
				document.getElementById("set_db_mk_m_2").value="'.$data['semester'].'";
				document.getElementById("set_db_mk_m_3a").value="'.substr($data['masa'],0,4).'";
				document.getElementById("set_db_mk_m_3b").value="'.substr($data['masa'],5,1).'";
				document.getElementById("set_db_mk_m_4").value="'.$data['hari_register'].'";
				document.getElementById("set_db_mk_m_5_jam").value="'.substr($data['time_register'],0,2).'";
				document.getElementById("set_db_mk_m_5_mnt").value="'.substr($data['time_register'],3,2).'";
				document.getElementById("set_db_mk_m_5_dtk").value="'.substr($data['time_register'],6,2).'";
				document.getElementById("set_db_mk_m_6_thn").value="'.substr($data['tanggal_register'],0,4).'";
				document.getElementById("set_db_mk_m_6_bln").value="'.substr($data['tanggal_register'],5,2).'";
				document.getElementById("set_db_mk_m_6_hri").value="'.substr($data['tanggal_register'],8,2).'";
				document.getElementById("set_db_mk_m_7").value= "'.$data['nilai'].'";
				document.getElementById("set_db_mk_m_8").value= "'.$data['lulus'].'";			
			
			function setlulus(v){
				if(v!=3){
				var p = parseFloat(document.getElementById("set_db_mk_m_7").value);
				var l = 0;
				if(p>=60)l=1;
				document.getElementById("set_db_mk_m_8").value = l;
				}
			}
			function getUpdate(){
					$.post("Ajax/database_db_sc.php",{nrp: document.getElementById("set_db_mk_m_1").value, code:"getLastSemester"}, function(data_) {
						document.getElementById("set_db_mk_m_2").value=data_;
					}); 
					$.post("Ajax/database_db_sc.php",{code:"getMasaNow"}, function(data_) {
						document.getElementById("set_db_mk_m_3a").value=data_.substring(0,4);
						document.getElementById("set_db_mk_m_3b").value=data_.substring(5,7);;
					}); 
			} 
			$(function() {
				$("#set_db_mk_m_0").autocomplete("Ajax/transfer_mk2_inner.php?qj=mks", {
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
				}).result(function(e, item) {
					document.getElementById("set_db_mk_m_0a").value=item.nama_mata_kuliah;
				});
				$("#set_db_mk_m_1").autocomplete("Ajax/transfer_mk2_inner.php?qj=mkm", {
					minChars: 0,
					width: 310,
					mustMatch: true,
					matchContains: true,	
					autoFill: false,
					dataType: "json",
					parse: function(data) {
						return $.map(data, function(row) {
							return {
								data: row,
								value: row.nama,
								result: row.nrp
							}
						});
					},formatItem: function(row, i, max) {
						return i + "/" + max + ": \"" + row.nama + "\" (" + row.nrp + ")";
					},
					formatMatch: function(row, i, max) {
						return row.nama + " " + row.nrp;
					},
					formatResult: function(row) {
						return row.nrp;
					}
				}).result(function(e, item) {
					document.getElementById("set_db_mk_m_1a").value=item.nama;
				});
			});
					   
			function GoSAVE(v){  //1 add, 2 modif
			if(v==3){HidePanel();return false;}
				var value = "";
				if((parseFloat(document.getElementById("set_db_mk_m_7").value)>100)||(parseFloat(document.getElementById("set_db_mk_m_7").value)<0)){alert("Inputan Score 0~100");return false;}
				value = document.getElementById("set_db_mk_m_0").value +"|"+document.getElementById("set_db_mk_m_1").value  +"|"+document.getElementById("set_db_mk_m_2").value+"|" +document.getElementById("set_db_mk_m_3a").value +"/"+document.getElementById("set_db_mk_m_3b").value+"|"+document.getElementById("set_db_mk_m_4").value +"|"+ document.getElementById("set_db_mk_m_5_jam").value +":"+document.getElementById("set_db_mk_m_5_mnt").value +":"+ document.getElementById("set_db_mk_m_5_dtk").value +"|"+document.getElementById("set_db_mk_m_6_thn").value +"-"+ document.getElementById("set_db_mk_m_6_bln").value +"-"+document.getElementById("set_db_mk_m_6_hri").value +"|"+ document.getElementById("set_db_mk_m_7").value +"|"+document.getElementById("set_db_mk_m_8").value +"|"+"'.$value2.'";
				ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\'); //$kd,$nrp,$m | $nrp,$value,$value2
				$.post("Ajax/database_db_sc.php",{kode_mk: "'.$nrp.'", value:value, code:"2"+""+v, nrp:"'.$value.'" }, function(data_) {
					alert(data_);
					search(\'db_sc2\');
					HidePanel();
				}); 
			}

			if("'.$code_.'"=="1"){alert("Fill the Blank !");}
			</script>
			';
			exit($out);
		break;
	}
}

?>

