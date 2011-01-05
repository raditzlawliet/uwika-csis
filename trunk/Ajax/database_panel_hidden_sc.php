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
			$out = '<div><b><center>I P S &nbsp; &nbsp; S C O R E</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table>
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVE('.$code_.')" class="button" href="#!"><b>&nbsp;SAVE&nbsp;</b></a></td><td><a onclick="javascript:HidePanel();" class="button" id="diff" href="#!"><b>CANCEL</b></a></td></tr></table>
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
			$status = array("q"=>'<img src="images/q.png" width="15px" title="Hint ! Type 1 word then search it">');
			$table = $table.
			'
			<tr><td>Subject Code</td><td>:</td><td><input class="input" id="set_db_sc2_1" maxlength="8" size="30" '.$view.' value="'.$data['kode_mata_kuliah'].'"\>&nbsp;'.$status["q"].'</td></tr>
			<td>Subject Name</td><td>:</td><td><input class="input" id="set_db_sc2_1a" style="background:#FFE1E2;border:none;" maxlength="49" size="30" disabled="true" value="'.$data['nama_mata_kuliah'].'"\></td></tr>
			<td>Student NRP</td><td>:</td><td><input class="input" id="set_db_sc2_2" onchange="javascript:getUpdate();" maxlength="49" size="30" '.$view.' value="'.$data['nrp'].'"\>&nbsp;'.$status["q"].'</td></tr>
			<td>Student Name</td><td>:</td><td><input class="input" id="set_db_sc2_2a" style="background:#FFE1E2;border:none;" maxlength="49" size="30" disabled="true" value="'.$data['nama'].'"\></td></tr>
			<td>Moment (YYYY/S) [2010/2]</td><td>:</td><td><input class="input" id="set_db_sc2_3" maxlength="6" size="6" '.$view.' value="'.$data['masa'].'"\></td>	<td>Moment Sekarang</td><td>:</td><td><input class="input" id="set_db_sc2_3a" maxlength="6" size="6" disabled="true" \></td></tr>
			<td>Semester</td><td>:</td><td><input class="input" id="set_db_sc2_4" maxlength="2" size="6" '.$view.' value="'.$data['semester'].'"\></td>
			<td>Semester Dia Sekarang</td><td>:</td><td><input class="input" id="set_db_sc2_4a" maxlength="2" size="6" disabled="true"\></td></tr>
			<td>Score</td><td>:</td><td><input class="input" id="set_db_sc2_5" maxlength="4" size="6" '.$view.' value="'.$data['nilai'].'"\></td></tr>
			';
			$out = '<div><b><center>S U B J E C T &nbsp; &nbsp; S C O R E</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table>
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVE('.$code_.')" class="button" href="#!"><b>&nbsp;SAVE&nbsp;</b></a></td><td><a onclick="javascript:HidePanel();" class="button" id="diff" href="#!"><b>CANCEL</b></a></td></tr></table>
			</div>
			<script>
			function getUpdate(){
					$.post("Ajax/database_db_sc.php",{nrp: document.getElementById("set_db_sc2_1").value, code:"getLastSemester"}, function(data_) {
						document.getElementById("set_db_sc2_4a").value=data_;
					}); 
					$.post("Ajax/database_db_sc.php",{code:"getMasaNow"}, function(data_) {
						document.getElementById("set_db_sc2_3a").value=data_;
					}); 
			}
			$.post("Ajax/database_db_sc.php",{nrp: "'.$value.'", code:"getLastSemester"}, function(data_) {
				document.getElementById("set_db_sc2_4a").value=data_;
			}); 
			$.post("Ajax/database_db_sc.php",{code:"getMasaNow"}, function(data_) {
				document.getElementById("set_db_sc2_3a").value=data_;
			}); 
			$(function() {
				$("#set_db_sc2_1").autocomplete("Ajax/transfer_mk2_inner.php?qj=mks", {
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
					document.getElementById("set_db_sc2_1a").value=item.nama_mata_kuliah;
				});
				$("#set_db_sc2_2").autocomplete("Ajax/transfer_mk2_inner.php?qj=mkm", {
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
					document.getElementById("set_db_sc2_2a").value=item.nama;
					$.post("Ajax/database_db_sc.php",{nrp: item.nrp, code:"getLastSemester"}, function(data_) {
						document.getElementById("set_db_sc2_4a").value=data_;
					}); 
					$.post("Ajax/database_db_sc.php",{code:"getMasaNow"}, function(data_) {
						document.getElementById("set_db_sc2_3a").value=data_;
					}); 
				});
			});
					   
			function GoSAVE(v){  //1 add, 2 modif
			if(v==3){HidePanel();return false;}
				var value = "";
				if((parseFloat(document.getElementById("set_db_sc2_4").value)>25)||(parseFloat(document.getElementById("set_db_sc2_4").value)<0)){alert("Inputan Semester 0~25");return false;}
				if((parseFloat(document.getElementById("set_db_sc2_5").value)>4)||(parseFloat(document.getElementById("set_db_sc2_5").value)<0)){alert("Inputan Score 0~4");return false;}
				
value = document.getElementById("set_db_sc2_1").value +"|"+document.getElementById("set_db_sc2_2").value +"|"+document.getElementById("set_db_sc2_3").value+"|" +document.getElementById("set_db_sc2_4").value+"|"+document.getElementById("set_db_sc2_5").value+"|"+"'.$value2.'"+"|";

				ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\'); //$kd,$nrp,$m | $nrp,$value,$value2
				$.post("Ajax/database_db_sc.php",{kode_mk: "'.$nrp.'", value:value, code:"2"+""+v, nrp:"'.$value.'"}, function(data_) {
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

