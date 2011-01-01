<?php

include 'transfer_mk2.php';

$code = htmlentities($_POST['code_hidden']);
$code_ = htmlentities($_POST['code_edit']);
$kode_mk = htmlentities($_POST['kode_mk']);

switch($code){
	case 'db_mk' : { //db awal
		switch($code_){
			case 1:{ //add
				$view = '';
				$addd= '001';
				$kunci='&nbsp; &nbsp; A D D';
				break;}
			case 2:{ //modify
				$view= '';
				$kunci='&nbsp; &nbsp; E D I T';
				break;}
			case 3:{ //view
				$view = 'disabled="true"';
				$kunci='&nbsp; &nbsp; V I E W';
				break;}
			case 4:{ //delete
				break;}
		}
			$set_height = "350";
			if(isset($_COOKIE['set_height_mk_list'])){
				$set_height = $_COOKIE['set_height_mk_list'];
			}
			$status = array("q"=>'<img src="images/q.png" width="15px" title="Hint ! Type 1 word then search it">');
			$data = getDataDatabaseMataKuliah($kode_mk);
			$data_j = getDataMataKuliahTRJurusan($kode_mk);
			$data_d = getDataMataKuliahTRDosen($kode_mk);
			$data_s = getDataMataKuliahTRSyarat($kode_mk);
			$data_m = getDataMataKuliahTRMahasiswa($kode_mk);
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
			
			$jurusan = getDatabaseJurusanALL();
			for($j=0;$j<=$jurusan['k'];$j++){
				$opt_jurusan=$opt_jurusan.'<option value="'.$jurusan[$j]['kode_depan_mata_kuliah'].'">'.$jurusan[$j]['nama_jurusan'].' / '.$jurusan[$j]['kode_depan_mata_kuliah'].'</option>';
				if($jurusan[$j]['kode_jurusan']!="101")$opt_jurusanJ=$opt_jurusanJ.'<option value="'.$jurusan[$j]['kode_jurusan'].'">'.$jurusan[$j]['nama_jurusan'].' / '.$jurusan[$j]['kode_jurusan'].'</option>';
			}
			
			$table = $table.
			'<tr><td>1<small>st</small> Course</td><td> : </td>
			<td><select class="input" onchange="javascript:GoChangeLabelKodeJurusanV(this)" id="set_db_mk_jurusan" title="jurusan" dir="ltr" '.$view.'>'.$opt_jurusan.'</select>&nbsp;&frasl;&nbsp;<label id="set_db_mk_kode_jurusan">'.substr($data['kode_mata_kuliah'],0,2).'</label></td>
			
			<td>Type</td><td> : </td><td><select onchange="javascript:GoChangeLabelKodeJenisV(this)" class="input" id="set_db_mk_jenis" title="jenis" dir="ltr" '.$view.'><option value="0">Study</option><option value="5">Practice (Specialist, T)</option><option value="1">Religius (General, PU)</option><option value="2">Language (General, PU)</option></select>&nbsp;&frasl;&nbsp;<label id="set_db_mk_kode_jenis">'.substr($data['kode_mata_kuliah'],2,1).'</label></td></tr>
			
			<tr><td width="15%">Code <a class="submit" style="padding:0px;background:none;color:red;border:none;border-bottom:solid 1px;" onclick="javascript:getLastCode();" href="#!">Get Last Code</a></td><td width="2%"> : </td>
			<td><label id="set_db_mk_1_a" title="'.substr($data['kode_mata_kuliah'],0,3).'">'.substr($data['kode_mata_kuliah'],0,3).'</label><input onchange="javascript:cekKODEMK(this);" class="input" id="set_db_mk_1_b" value="'.$addd.substr($data['kode_mata_kuliah'],3,4).'" size="1" maxlength="3" '.$view.'\> <label style="color:red;">-> </label>A<select onchange="javascript:changeKDr();" class="input" id="set_db_mk_kode_akhir" '.$view.' ><option value="1">1</option><option value="6">6</option></select><label> r.</label><select onchange="javascript:changeKDr();" class="input" id="set_db_mk_kode_akhir_revisi" '.$view.' ><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select><label style="color:red;"> -> </label></td><td><label style="color:red">A - Last Code 1/6 + r.</label></td><td></td><td><label style="color:red">r. Revision Next Study</label></td></tr>
			
			<tr><td>Name</td><td> : </td>
			<td><input class="input" id="set_db_mk_2" value="'.$data['nama_mata_kuliah'].'"maxlength="49" size="30" '.$view.'\></td>
			<td><label style="color:red">ex. Kalkulus I (A=1,r=0) = 1</label></td><td></td><td><label style="color:red">Kalkulus II (A=1, r=1) = 2</label></td></tr>
			
			<tr><td>SKS</td><td> : </td>
			<td><select onchange="changeSKSV(this);" class="input" id="set_db_mk_3" dir="ltr" '.$view.'><option value="1">1 SKS</option><option value="2">2 SKS</option><option value="3">3 SKS</option><option value="4">4 SKS</option><option value="5">5 SKS</option><option value="6">6 SKS</option><option value="7">7 SKS</option><option value="8">8 SKS</option><option value="9">9 SKS</option><option value="10">10 SKS</option></select>&nbsp;<label id="time_sks">60m</label>&nbsp;<label style="color:red;">(1SKS = 50m)&nbsp;</label><a onclick="javascript:changeTimeEnd();" class="submit" href="#!">Calc</a></td>
			
			<td><label style="color:red">Calc to Calculate it from TB in TE</label></td><td></td><td><label style="color:red">Down Here</label></td></tr>
									
			<tr><td>Probis</td><td> : </td>
			<td><select class="input" id="set_db_mk_4" dir="ltr" '.$view.'><option value="0">No / Morning Class</option><option value="1">Yes / Probis Class</option></select></td>
			<td>Time Begin (hh:mm:ss)</td><td> : </td>
			<td><select class="input" id="set_db_mk_6_jam" dir="ltr" '.$view.'>'.$jam_.'</select> : <select class="input" id="set_db_mk_6_mnt" dir="ltr" '.$view.'>'.$mnt_.'</select> : <select class="input" id="set_db_mk_6_dtk" dir="ltr" '.$view.'>'.$mnt_.'</select></td></tr>

			<tr><td>Day</td><td> : </td>
			<td><select class="input" id="set_db_mk_5" dir="ltr" '.$view.'><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thrusday</option><option value="5">Friday</option><option value="6">Saturday</option></select></td>

			<td>Time End (hh:mm:ss)</td><td> : </td>
			<td><select class="input" id="set_db_mk_7_jam" dir="ltr" '.$view.'>'.$jam_.'</select> : <select class="input" id="set_db_mk_7_mnt" dir="ltr" '.$view.'>'.$mnt_.'</select> : <select class="input" id="set_db_mk_7_dtk" dir="ltr" '.$view.'>'.$mnt_.'</select></td></tr>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			
			';
			for($i=0;$i<$data_j['k'];$i++){
				$data_j_op = $data_j_op.'<option value="'.$data_j[$i]['kode_jurusan'].'">'.$data_j[$i]['nama_jurusan'].' ( '.$data_j[$i]['kode_jurusan'].' ) at Semester '.$data_j[$i]['semester'].'</option>'; 
			}
			for($i=0;$i<$data_d['k'];$i++){
				$data_d_op = $data_d_op.'<option value="'.$data_d[$i]['nrp'].'">'.$data_d[$i]['nama'].' ( '.$data_d[$i]['nrp'].' ) </option>'; 
			}
			for($i=0;$i<$data_m['k'];$i++){
				$data_m_op = $data_m_op.'<option value="'.$data_m[$i]['nrp'].'">'.$data_m[$i]['nama'].' ( '.$data_m[$i]['nrp'].' ) at '.$data_m[$i]['masa'].' &amp; Semester '.$data_m[$i]['semester'].' ['.$data_m[$i]['lulus'].']</option>';
			}
			for($i=0;$i<$data_s['k'];$i++){
				$data_s_op = $data_s_op.'<option value="'.$data_s[$i]['kode_mata_kuliah_syarat'].'">'.$data_s[$i]['nama_mata_kuliah'].' ( '.$data_s[$i]['kode_mata_kuliah_syarat'].' ) - '.$data_s[$i]['kode_syarat'].'</option>'; 
			}
			
			$table2 = $table2.
			'<tr><td width="50%">List of Course that Registered this Subject</td><td><a id="submitdb" onclick="javascript:goAddMK_J();" class="submit" href="#!">Add</a>&nbsp;<a id="submitdb" onclick="javascript:goDelMK_J();" class="submit" href="#!">Del</a>&nbsp;<a id="submitdb" onclick="javascript:goEditMK_J();" class="submit" href="#!">Edit</a></td></tr>
			<tr><td id="mk_j_list" width="50%"><select class="input" style="width:95%;" id="list_set_db_mk_j" onchange="javascript:goViewMK_J();" size="5">'.$data_j_op.'</select></td>
			<td>
				<table>
				<tr><td>Course Name</td><td>:</td><td><select class="input" onchange="javascript:GoChangeLabelKodeJurusanJV(this)" id="set_db_mk_j_1" title="jurusan" dir="ltr" disabled>'.$opt_jurusanJ.'</select>&nbsp;&frasl;&nbsp;<label id="set_db_mk_j_kode_jurusan"></label></td></tr>
				<tr><td>Semester</td><td>:</td><td><select class="input" id="set_db_mk_j_2" dir="ltr" disabled><option value="0">0 (if u want to hide it)</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select></td></tr>
				<tr><td><a id="submitdb" onclick="javascript:goSaveMK_J();" class="submit" href="#!">Save</a><a id="submitdb" onclick="javascript:goCancelMK_J();" class="submit" href="#!">Cancel</a></td><td></td></tr>
				</table>
			</td></tr>
			';
			
			$table3 = $table3.
			'<tr><td width="50%">List of Faculty that Registered this Subject</td><td><a id="submitdb" onclick="javascript:goAddMK_D();" class="submit" href="#!">Add</a>&nbsp;<a id="submitdb" onclick="javascript:goDelMK_D();" class="submit" href="#!">Del</a>&nbsp;<a id="submitdb" onclick="javascript:goEditMK_D();" class="submit" href="#!">Edit</a></td></tr><tr><td id="mk_d_list" width="50%"><select class="input" style="width:95%;" id="list_set_db_mk_d" onchange="javascript:goViewMK_D();" size="5">'.$data_d_op.'</select></td>
			<td>
				<table>
				<tr><td>Faculty NRP</td><td>:</td><td><input class="input" id="set_db_mk_d_1" maxlength="11" size="30" disabled="true"\>&nbsp;'.$status["q"].'</td></tr>
				<tr><td>Faculty Name</td><td>:</td><td><input class="input" id="set_db_mk_d_2" style="background:#FFE1E2;border:none;" maxlength="49" size="30" disabled="true"\></td></tr>
				<tr><td><a id="submitdb" onclick="javascript:goSaveMK_D();" class="submit" href="#!">Save</a><a id="submitdb" onclick="javascript:goCancelMK_D();" class="submit" href="#!">Cancel</a></td><td></td></tr>
				</table>
			</td></tr>
			';
			
			$table4 = $table4.
			'<tr><td width="50%">List of Requirement Subject that Registered this Subject</td><td><a id="submitdb" onclick="javascript:goAddMK_S();" class="submit" href="#!">Add</a>&nbsp;<a id="submitdb" onclick="javascript:goDelMK_S();" class="submit" href="#!">Del</a>&nbsp;<a id="submitdb" onclick="javascript:goEditMK_S();" class="submit" href="#!">Edit</a></td></tr><tr><td id="mk_s_list" width="50%"><select class="input" style="width:95%;" id="list_set_db_mk_s" onchange="javascript:goViewMK_S();" size="5">'.$data_s_op.'</select><p>&nbsp;<br></td>
			<td>
				<table>
				<tr><td>Subject Code</td><td>:</td><td><input class="input" id="set_db_mk_s_1" maxlength="7" size="30" disabled="true"\>&nbsp;'.$status["q"].'</td></tr>
				<tr><td>Subject Name</td><td>:</td><td><input class="input" id="set_db_mk_s_1a" style="background:#FFE1E2;border:none;" maxlength="49" size="30" disabled="true"\></td></tr>
				<tr><td>Requirement Code</td><td>:</td><td><select class="input" id="set_db_mk_s_2" dir="ltr" disabled><option value="0">0 (Must Complete this Subject)</option><option value="1">1 (Must Take this Subject)</option></select></td></tr>
				<tr><td><a id="submitdb" onclick="javascript:goSaveMK_S();" class="submit" href="#!">Save</a><a id="submitdb" onclick="javascript:goCancelMK_S();" class="submit" href="#!">Cancel</a></td><td></td></tr>
				</table>
			</td></tr>
			';
			for($i=2050;$i>=1960;$i--){$c_m = $c_m.'<option value="'.$i.'/2">'.$i.'/2</option>';$c_m = $c_m.'<option value="'.$i.'/1">'.$i.'/1</option>';}
			$table5 = $table5.
			'<tr><td width="50%">List of Students Subject that Registered this Subject <select onchange="javascript:reloadMK_M()" class="input" id="slct_list_set_db_mk_m" dir="ltr"><option value="g">All</option>'.$c_m.'</select></td><td><a id="submitdb" onclick="javascript:goAddMK_M();" class="submit" href="#!">Add</a>&nbsp;<a id="submitdb" onclick="javascript:goDelMK_M();" class="submit" href="#!">Del</a>&nbsp;<a id="submitdb" onclick="javascript:goEditMK_M();" class="submit" href="#!">Edit</a></td></tr><tr><td id="mk_m_list" width="50%"><select class="input" style="width:95%;" id="list_set_db_mk_m" onchange="javascript:goViewMK_M();" size="11">'.$data_m_op.'</select><p>&nbsp;<br></td>
			<td>
				<table>
				<tr><td>Students NRP</td><td>:</td><td><input class="input" id="set_db_mk_m_1" maxlength="8" size="30" disabled="true"\>&nbsp;'.$status["q"].'</td></tr>
				<tr><td>Students Name</td><td>:</td><td><input class="input" id="set_db_mk_m_1a" style="background:#FFE1E2;border:none;" maxlength="49" size="30" disabled="true"\></td></tr>
				<tr><td>Semester</td><td>:</td><td><input class="input" id="set_db_mk_m_2" maxlength="2" size="2" disabled="true"\>&nbsp;Masa&nbsp;:&nbsp;<select class="input" id="set_db_mk_m_3a" title="fakultas" dir="ltr" disabled>'.$thn_.'</select><select class="input" id="set_db_mk_m_3b" dir="ltr" disabled><option value="1">1 (Ganjil)</option><option value="2">2 (Genap)</option></select></td></tr>
				
				<tr><td>Day Registered</td><td>:</td><td><select class="input" id="set_db_mk_m_4" dir="ltr" disabled><option value="0">Sunday</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thrusday</option><option value="5">Friday</option><option value="6">Saturday</option></select></td></tr>
				
				<tr><td>Time Registered</td><td>:</td><td><select class="input" id="set_db_mk_m_5_jam" dir="ltr" disabled>'.$jam_.'</select> : <select class="input" id="set_db_mk_m_5_mnt" dir="ltr" disabled>'.$mnt_.'</select> : <select class="input" id="set_db_mk_m_5_dtk" dir="ltr" disabled>'.$mnt_.'</select></td></tr>
				
				<tr><td>Date Registered</td><td>:</td><td><select class="input" id="set_db_mk_m_6_thn" title="fakultas" dir="ltr" disabled>'.$thn_.'</select> - <select class="input" id="set_db_mk_m_6_bln" title="fakultas" dir="ltr" disabled>'.$bln_.'</select> - <select class="input" id="set_db_mk_m_6_hri" title="fakultas" dir="ltr" disabled>'.$hri_.'</select>&nbsp;<label style="color:red"> (YYYY-MM-DD)</label></td></tr>
				
				<tr><td>Score</td><td>:</td><td><input class="input" id="set_db_mk_m_7" maxlength="4" size="2" disabled="true"\>&nbsp;Is Complete ?&nbsp;:&nbsp;<select class="input" id="set_db_mk_m_8" dir="ltr" disabled><option value="0">0 (Not Complete)</option><option value="1">1 (Complete)</option></select></td></tr>
				
				<tr><td><a id="submitdb" onclick="javascript:goSaveMK_M();" class="submit" href="#!">Save</a><a id="submitdb" onclick="javascript:goCancelMK_M();" class="submit" href="#!">Cancel</a></td><td></td></tr>
				</table>
				</table>
			</td></tr>
			';			
			
			$outb='<b><center>S U B J E C T &nbsp; - &nbsp; C O U R S E</center></b>
			<div id="mk_sc"><table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table2.'
			</table><b><center>S U B J E C T &nbsp; - &nbsp; F A C U L T Y</center></b>
			</div><div id="mk_sf"><table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table3.'
			</table><b><center>S U B J E C T &nbsp; - &nbsp; R E Q U I R E M E N T</center></b>
			</div><div id="mk_sr"><table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table4.'
			</table><b><center>S U B J E C T &nbsp; - &nbsp; S T U D E N T S</center></b>
			</div><div id="mk_ss"><table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table5.'
			</table></div>';
			if($code_==1)$outb='';
			
			$out = '<div><b><center>S U B J E C T '.$kunci.'</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<div id="mk_"><table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table></div>
			'.$outb.'
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVE('.$code_.')" class="button" href="#!"><b>&nbsp;SAVE&nbsp;</b></a></td><td><a onclick="javascript:HidePanel();" class="button" id="diff" href="#!"><b>CANCEL</b></a></td></tr></table>
			</div>
			<script>
			$(function() {
				$("#set_db_mk_d_1").autocomplete("Ajax/transfer_mk2_inner.php?qj=fc", {
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
					document.getElementById("set_db_mk_d_2").value=item.nama;
				});
				$("#set_db_mk_s_1").autocomplete("Ajax/transfer_mk2_inner.php?qj=mks", {
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
					document.getElementById("set_db_mk_s_1a").value=item.nama_mata_kuliah;
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
			
			document.getElementById("set_db_mk_6_jam").value = "'.substr($data['jam_mulai'],0,2).'";
			document.getElementById("set_db_mk_6_mnt").value = "'.substr($data['jam_mulai'],3,2).'";
			document.getElementById("set_db_mk_6_dtk").value = "'.substr($data['jam_mulai'],6,2).'";
			document.getElementById("set_db_mk_7_jam").value = "'.substr($data['jam_selesai'],0,2).'";
			document.getElementById("set_db_mk_7_mnt").value = "'.substr($data['jam_selesai'],3,2).'";
			document.getElementById("set_db_mk_7_dtk").value = "'.substr($data['jam_selesai'],6,2).'";
			document.getElementById("set_db_mk_jurusan").value = "'.substr($data['kode_mata_kuliah'],0,2).'";
			document.getElementById("set_db_mk_jenis").value = "'.substr($data['kode_mata_kuliah'],2,1).'";
			document.getElementById("set_db_mk_3").value = "'.$data['jumlah_sks'].'";
			document.getElementById("set_db_mk_4").value = "'.$data['probis'].'";
			document.getElementById("set_db_mk_5").value = "'.$data['hari'].'";
			
			
			GoChangeLabelKodeJurusan("'.substr($data['kode_mata_kuliah'],0,2).'");
			GoChangeLabelKodeJenis("'.substr($data['kode_mata_kuliah'],2,1).'");
			GoChangeLabelKodeJurusanJ(document.getElementById("set_db_mk_j_1").value);
			changeSKS('.$data['jumlah_sks'].');
			calcKDR('.substr($data['kode_mata_kuliah'],5,1).');
			
			//0 normal can selected (add,del,list,edit aktif)/(save,cancel dead)
			//1 edit can selected (save,cancel aktif)/(add,del,edit,list dead)
			//2 add can selected (save,cancel aktif)/(add,del,edit,list dead)
			//3 load, all dead.
			var s_mk_j = 0;	var s_mk_d = 0;
			var s_mk_m = 0;	var s_mk_s = 0;
			function reloadMK_J(){
				$("#mk_j_list").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
				$.post("Ajax/transfer_mk2_inner.php",{code:"mk_j", code_in:"getall",kode_mk:"'.$kode_mk.'"}, function(data_) {
						var d;
						if(data_==null||data_==""||data_=="null"){d="";}else{
							respons = eval(\'(\' + data_ + \')\');
							for(var i=0;i<respons[\'k\'];i++){
								d=d+\'<option value="\'+respons[i].kode_jurusan+\'">\'+respons[i].nama_jurusan+\' ( \'+respons[i].kode_jurusan+\' ) at Semester \'+respons[i].semester+\'</option>\'; 
							}
						}
						var t = \'<select class="input" style="width:95%;" id="list_set_db_mk_j" onchange="javascript:goViewMK_J();" size="5">\'+d+\'</select>\';
						$("#mk_j_list").html(t);
				});
			}
			function goViewMK_J(){
				var a=document.getElementById("list_set_db_mk_j").value;
				$.post("Ajax/transfer_mk2_inner.php",{code:"mk_j", code_in:"get",kode_mk:"'.$kode_mk.'",kode_jurusan:a}, function(data_) {
						respons = eval(\'(\' + data_ + \')\');
						document.getElementById("set_db_mk_j_1").value=respons.kode_jurusan;
						document.getElementById("set_db_mk_j_2").value=respons.semester;
						GoChangeLabelKodeJurusanJ(respons.kode_jurusan);
				});
			}
			function goAddMK_J(){
				if('.$code_.'==3){return false};
				if(s_mk_j==0){
					mk_j_lock();
					s_mk_j=2;
					document.getElementById("list_set_db_mk_j").disabled=true;
					document.getElementById("set_db_mk_j_1").disabled=false;
					document.getElementById("set_db_mk_j_2").disabled=false;
					document.getElementById("set_db_mk_j_1").selectedIndex=0;
					document.getElementById("set_db_mk_j_2").selectedIndex=0;
				}
			}
			function goSaveMK_J(){
				if('.$code_.'==3){return false};
				if((s_mk_j==1)||(s_mk_j==2)){
					mk_j_lock();
					var v = document.getElementById("set_db_mk_j_1").value+"|"+document.getElementById("set_db_mk_j_2").value;
					if(s_mk_j==1){				//1-edit 2-add
						var a=document.getElementById("list_set_db_mk_j").value;
						$.post("Ajax/transfer_mk2_inner.php",{code:"mk_j", code_in:"set",kode_mk:"'.$kode_mk.'",kode_jurusan:a,data:v}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_j").disabled=false;
							document.getElementById("set_db_mk_j_1").disabled=true;
							document.getElementById("set_db_mk_j_2").disabled=true;
							reloadMK_J();
						});
					}else{
						$.post("Ajax/transfer_mk2_inner.php",{code:"mk_j", code_in:"add",kode_mk:"'.$kode_mk.'",kode_jurusan:a,data:v}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_j").disabled=false;
							document.getElementById("set_db_mk_j_1").disabled=true;
							document.getElementById("set_db_mk_j_2").disabled=true;
							reloadMK_J();
						});
					}
					s_mk_j=0;
				}
			}
			function goDelMK_J(){
				if('.$code_.'==3){return false};
				if((s_mk_j==0)&&(document.getElementById("list_set_db_mk_j").selectedIndex!=-1)){
					mk_j_lock();
					var a=document.getElementById("list_set_db_mk_j").value;
					$.post("Ajax/transfer_mk2_inner.php",{code:"mk_j", code_in:"del",kode_mk:"'.$kode_mk.'",kode_jurusan:a}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_j").disabled=false;
							document.getElementById("set_db_mk_j_1").disabled=true;
							document.getElementById("set_db_mk_j_2").disabled=true;
							reloadMK_J();
					});
				}
			}
			function goEditMK_J(){
				if('.$code_.'==3){return false};
				if((s_mk_j==0)&&(document.getElementById("list_set_db_mk_j").selectedIndex!=-1)){
					mk_j_lock();
					s_mk_j=1;
					var a=document.getElementById("list_set_db_mk_j").value;
					$.post("Ajax/transfer_mk2_inner.php",{code:"mk_j", code_in:"get",kode_mk:"'.$kode_mk.'",kode_jurusan:a}, function(data_) {
							respons = eval(\'(\' + data_ + \')\');
							document.getElementById("set_db_mk_j_1").value=respons.kode_jurusan;
							document.getElementById("set_db_mk_j_2").value=respons.semester;
							GoChangeLabelKodeJurusanJ(respons.kode_jurusan);
							document.getElementById("list_set_db_mk_j").disabled=true;
							document.getElementById("set_db_mk_j_1").disabled=false;
							document.getElementById("set_db_mk_j_2").disabled=false;
					});
				}
			}
			function goCancelMK_J(){
				if('.$code_.'==3){return false};
				if((s_mk_j==1)||(s_mk_j==2)){
					mk_j_lock();
					s_mk_j=0;
					document.getElementById("list_set_db_mk_j").disabled=false;
					document.getElementById("set_db_mk_j_1").disabled=true;
					document.getElementById("set_db_mk_j_2").disabled=true;
				}
			}
			
			function reloadMK_D(){
				$("#mk_d_list").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
				$.post("Ajax/transfer_mk2_inner.php",{code:"mk_d", code_in:"getall",kode_mk:"'.$kode_mk.'"}, function(data_) {
						var d;
						if(data_==null||data_==""||data_=="null"){d="";}else{
							respons = eval(\'(\' + data_ + \')\');
							for(var i=0;i<respons[\'k\'];i++){
								d=d+\'<option value="\'+respons[i].nrp+\'">\'+respons[i].nama+\' ( \'+respons[i].nrp+\' )</option>\'; 
							}
						}
						var t = \'<select class="input" style="width:95%;" id="list_set_db_mk_d" onchange="javascript:goViewMK_D();" size="5">\'+d+\'</select>\';
						$("#mk_d_list").html(t);
				});
			}
			function goViewMK_D(){
				var a=document.getElementById("list_set_db_mk_d").value;
				$.post("Ajax/transfer_mk2_inner.php",{code:"mk_d", code_in:"get",kode_mk:"'.$kode_mk.'",nrp:a}, function(data_) {
						respons = eval(\'(\' + data_ + \')\');
						document.getElementById("set_db_mk_d_1").value=respons.nrp;
						document.getElementById("set_db_mk_d_2").value=respons.nama;
				});
			}
			function goAddMK_D(){
				if('.$code_.'==3){return false};
				if(s_mk_d==0){
					mk_d_lock();
					s_mk_d=2;
					document.getElementById("list_set_db_mk_d").disabled=true;
					document.getElementById("set_db_mk_d_1").disabled=false;
					document.getElementById("set_db_mk_d_1").value="";
					document.getElementById("set_db_mk_d_2").value="";
				}
			}
			function goSaveMK_D(){
				if('.$code_.'==3){return false};
				if((s_mk_d==1)||(s_mk_d==2)){
					mk_d_lock();
					var v = document.getElementById("set_db_mk_d_1").value
					if(s_mk_d==1){				//1-edit 2-add
						v=v+"|";
						var a=document.getElementById("list_set_db_mk_d").value;
						$.post("Ajax/transfer_mk2_inner.php",{code:"mk_d", code_in:"set",kode_mk:"'.$kode_mk.'",nrp:a,data:v}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_d").disabled=false;
							document.getElementById("set_db_mk_d_1").disabled=true;
							document.getElementById("set_db_mk_d_2").disabled=true;
							reloadMK_D();
						});
					}else{
						$.post("Ajax/transfer_mk2_inner.php",{code:"mk_d", code_in:"add",kode_mk:"'.$kode_mk.'",nrp:v}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_d").disabled=false;
							document.getElementById("set_db_mk_d_1").disabled=true;
							document.getElementById("set_db_mk_d_2").disabled=true;
							reloadMK_D();
						});
					}
					s_mk_d=0;
				}
			}
			function goDelMK_D(){
				if('.$code_.'==3){return false};
				if((s_mk_d==0)&&(document.getElementById("list_set_db_mk_d").selectedIndex!=-1)){
					mk_d_lock();
					var a=document.getElementById("list_set_db_mk_d").value;
					$.post("Ajax/transfer_mk2_inner.php",{code:"mk_d", code_in:"del",kode_mk:"'.$kode_mk.'",nrp:a}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_d").disabled=false;
							document.getElementById("set_db_mk_d_1").disabled=true;
							document.getElementById("set_db_mk_d_2").disabled=true;
							reloadMK_D();
					});
				}
			}
			function goEditMK_D(){
				if('.$code_.'==3){return false};
				if((s_mk_d==0)&&(document.getElementById("list_set_db_mk_d").selectedIndex!=-1)){
					mk_d_lock();
					s_mk_d=1;
					var a=document.getElementById("list_set_db_mk_d").value;
					$.post("Ajax/transfer_mk2_inner.php",{code:"mk_d", code_in:"get",kode_mk:"'.$kode_mk.'",nrp:a}, function(data_) {
							respons = eval(\'(\' + data_ + \')\');
							document.getElementById("set_db_mk_d_1").value=respons.nrp;
							document.getElementById("set_db_mk_d_2").value=respons.nama;
							document.getElementById("list_set_db_mk_d").disabled=true;
							document.getElementById("set_db_mk_d_1").disabled=false;
					});
				}
			}
			function goCancelMK_D(){
				if('.$code_.'==3){return false};
				if((s_mk_d==1)||(s_mk_d==2)){
					mk_d_lock();
					s_mk_d=0;
					document.getElementById("list_set_db_mk_d").disabled=false;
					document.getElementById("set_db_mk_d_1").disabled=true;
					document.getElementById("set_db_mk_d_2").disabled=true;
				}
			}
			
			function reloadMK_S(){
				$("#mk_s_list").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
				$.post("Ajax/transfer_mk2_inner.php",{code:"mk_s", code_in:"getall",kode_mk:"'.$kode_mk.'"}, function(data_) {
						var d;
						if(data_==null||data_==""||data_=="null"){d="";}else{
							respons = eval(\'(\' + data_ + \')\');					
							for(var i=0;i<respons[\'k\'];i++){
								d=d+\'<option value="\'+respons[i].kode_mata_kuliah_syarat+\'">\'+respons[i].nama_mata_kuliah+\' ( \'+respons[i].kode_mata_kuliah_syarat+\' ) - \'+respons[i].kode_syarat+\'</option>\'; 
							}
						}
						var t = \'<select class="input" style="width:95%;" id="list_set_db_mk_s" onchange="javascript:goViewMK_S();" size="5">\'+d+\'</select><p>&nbsp;<br>\';					$("#mk_s_list").html(t);
				});
			}
			function goViewMK_S(){
				var a=document.getElementById("list_set_db_mk_s").value;
				$.post("Ajax/transfer_mk2_inner.php",{code:"mk_s", code_in:"get",kode_mk:"'.$kode_mk.'",nrp:a}, function(data_) {
						respons = eval(\'(\' + data_ + \')\');
						document.getElementById("set_db_mk_s_1").value=respons.kode_mata_kuliah_syarat;
						document.getElementById("set_db_mk_s_1a").value=respons.nama_mata_kuliah;
						document.getElementById("set_db_mk_s_2").value=respons.kode_syarat;
				});
			}
			function goAddMK_S(){
				if('.$code_.'==3){return false};
				if(s_mk_s==0){
					mk_s_lock();
					s_mk_s=2;
					document.getElementById("list_set_db_mk_s").disabled=true;
					document.getElementById("set_db_mk_s_1").disabled=false;
					document.getElementById("set_db_mk_s_2").disabled=false;
					document.getElementById("set_db_mk_s_1").value="";
					document.getElementById("set_db_mk_s_1a").value="";
					document.getElementById("set_db_mk_s_2").value="";
				}
			}
			function goSaveMK_S(){
				if('.$code_.'==3){return false};
				if((s_mk_s==1)||(s_mk_s==2)){
					mk_s_lock();
					var v = document.getElementById("set_db_mk_s_1").value+"|"+document.getElementById("set_db_mk_s_2").value
					if(s_mk_s==1){				//1-edit 2-add
						v=v+"|";
						var a=document.getElementById("list_set_db_mk_s").value;
						$.post("Ajax/transfer_mk2_inner.php",{code:"mk_s", code_in:"set",kode_mk:"'.$kode_mk.'",nrp:a,data:v}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_s").disabled=false;
							document.getElementById("set_db_mk_s_1").disabled=true;
							document.getElementById("set_db_mk_s_2").disabled=true;
							document.getElementById("set_db_mk_s_1a").disabled=true;
							reloadMK_S();
						});
					}else{
						$.post("Ajax/transfer_mk2_inner.php",{code:"mk_s", code_in:"add",kode_mk:"'.$kode_mk.'",data:v}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_s").disabled=false;
							document.getElementById("set_db_mk_s_1").disabled=true;
							document.getElementById("set_db_mk_s_2").disabled=true;
							document.getElementById("set_db_mk_s_1a").disabled=true;
							reloadMK_S();
						});
					}
					s_mk_s=0;
				}
			}
			function goDelMK_S(){
				if('.$code_.'==3){return false};
				if((s_mk_s==0)&&(document.getElementById("list_set_db_mk_s").selectedIndex!=-1)){
					mk_s_lock();
					var a=document.getElementById("list_set_db_mk_s").value;
					$.post("Ajax/transfer_mk2_inner.php",{code:"mk_s", code_in:"del",kode_mk:"'.$kode_mk.'",nrp:a}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_s").disabled=false;
							document.getElementById("set_db_mk_s_1").disabled=true;
							document.getElementById("set_db_mk_s_2").disabled=true;
							reloadMK_S();
					});
				}
			}
			function goEditMK_S(){
				if('.$code_.'==3){return false};
				if((s_mk_s==0)&&(document.getElementById("list_set_db_mk_s").selectedIndex!=-1)){
					mk_s_lock();
					s_mk_s=1;
					var a=document.getElementById("list_set_db_mk_s").value;
					$.post("Ajax/transfer_mk2_inner.php",{code:"mk_s", code_in:"get",kode_mk:"'.$kode_mk.'",nrp:a}, function(data_) {
							respons = eval(\'(\' + data_ + \')\');
							document.getElementById("set_db_mk_s_1").value=respons.kode_mata_kuliah_syarat;
							document.getElementById("set_db_mk_s_1a").value=respons.nama_mata_kuliah;
							document.getElementById("set_db_mk_s_2").value=respons.kode_syarat;
							document.getElementById("list_set_db_mk_s").disabled=true;
							document.getElementById("set_db_mk_s_1").disabled=false;
							document.getElementById("set_db_mk_s_2").disabled=false;
					});
				}
			}
			function goCancelMK_S(){
				if('.$code_.'==3){return false};
				if((s_mk_s==1)||(s_mk_s==2)){
					mk_s_lock();
					s_mk_s=0;
					document.getElementById("list_set_db_mk_s").disabled=false;
					document.getElementById("set_db_mk_s_1").disabled=true;
					document.getElementById("set_db_mk_s_2").disabled=true;
				}
			}
			
			function reloadMK_M(){
				$("#mk_m_list").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
				var b = document.getElementById("slct_list_set_db_mk_m").value;
				$.post("Ajax/transfer_mk2_inner.php",{code:"mk_m", code_in:"getall",kode_mk:"'.$kode_mk.'",nrp:b}, function(data_) {
						var d;
						if(data_==null||data_==""||data_=="null"){d="";}else{
							respons = eval(\'(\' + data_ + \')\');
							for(var i=0;i<respons[\'k\'];i++){
								d=d+\'<option value="\'+respons[i].nrp+\'">\'+respons[i].nama+\' ( \'+respons[i].nrp+\' ) at \'+respons[i].masa+\' &amp; Semester \'+respons[i].semester+\' [\'+respons[i].lulus+\']</option>\'; 
							}
						}
						var t = \'<select class="input" style="width:95%;" id="list_set_db_mk_m" onchange="javascript:goViewMK_M();" size="11">\'+d+\'</select><p>&nbsp;<br>\';			$("#mk_m_list").html(t);
				});
			}
			function goViewMK_M(){
				var a=document.getElementById("list_set_db_mk_m").value;
				$.post("Ajax/transfer_mk2_inner.php",{code:"mk_m", code_in:"get",kode_mk:"'.$kode_mk.'",nrp:a}, function(data_) {
						respons = eval(\'(\' + data_ + \')\');
						document.getElementById("set_db_mk_m_1").value=respons.nrp;
						document.getElementById("set_db_mk_m_1a").value=respons.nama;
						document.getElementById("set_db_mk_m_2").value=respons.semester;
						document.getElementById("set_db_mk_m_3a").value=respons.masa.substring(0,4);
						document.getElementById("set_db_mk_m_3b").value=respons.masa.substring(5,7);
						document.getElementById("set_db_mk_m_4").value=respons.hari_register;
						document.getElementById("set_db_mk_m_5_jam").value=respons.time_register.substring(0,2);
						document.getElementById("set_db_mk_m_5_mnt").value=respons.time_register.substring(3,5);
						document.getElementById("set_db_mk_m_5_dtk").value=respons.time_register.substring(6,8);
						document.getElementById("set_db_mk_m_6_thn").value=respons.tanggal_register.substring(0,4);
						document.getElementById("set_db_mk_m_6_bln").value=respons.tanggal_register.substring(5,7);
						document.getElementById("set_db_mk_m_6_hri").value=respons.tanggal_register.substring(8,10);
						document.getElementById("set_db_mk_m_7").value=respons.nilai;
						document.getElementById("set_db_mk_m_8").value=respons.lulus;
				});
			}
			function goAddMK_M(){
				if('.$code_.'==3){return false};
				if(s_mk_m==0){
					mk_m_lock();
					s_mk_m=2;
					document.getElementById("list_set_db_mk_m").disabled=true;
					document.getElementById("set_db_mk_m_1").disabled=false;
					document.getElementById("set_db_mk_m_2").disabled=false;
					document.getElementById("set_db_mk_m_3a").disabled=false;
					document.getElementById("set_db_mk_m_3b").disabled=false;
					document.getElementById("set_db_mk_m_4").disabled=false;
					document.getElementById("set_db_mk_m_5_jam").disabled=false;
					document.getElementById("set_db_mk_m_5_mnt").disabled=false;
					document.getElementById("set_db_mk_m_5_dtk").disabled=false;
					document.getElementById("set_db_mk_m_6_thn").disabled=false;
					document.getElementById("set_db_mk_m_6_bln").disabled=false;
					document.getElementById("set_db_mk_m_6_hri").disabled=false;
					document.getElementById("set_db_mk_m_7").disabled=false;
					document.getElementById("set_db_mk_m_8").disabled=false;
					document.getElementById("set_db_mk_m_1").value="";
					document.getElementById("set_db_mk_m_1a").value="";
					document.getElementById("set_db_mk_m_2").value="";
					document.getElementById("set_db_mk_m_3a").value="2011";
					document.getElementById("set_db_mk_m_3b").value="2";
					document.getElementById("set_db_mk_m_4").value="1";
					document.getElementById("set_db_mk_m_5_jam").value="08";
					document.getElementById("set_db_mk_m_5_mnt").value="00";
					document.getElementById("set_db_mk_m_5_dtk").value="00";
					document.getElementById("set_db_mk_m_6_thn").value="2011";
					document.getElementById("set_db_mk_m_6_bln").value="01";
					document.getElementById("set_db_mk_m_6_hri").value="01";
					document.getElementById("set_db_mk_m_7").value="";
					document.getElementById("set_db_mk_m_8").value="0";
				}
			}
			function goSaveMK_M(){
				if('.$code_.'==3){return false};
				if((s_mk_m==1)||(s_mk_m==2)){
					mk_m_lock();
					var v = document.getElementById("set_db_mk_m_1").value+"|"+document.getElementById("set_db_mk_m_2").value+"|"+document.getElementById("set_db_mk_m_3a").value+"/"+document.getElementById("set_db_mk_m_3b").value+"|"+document.getElementById("set_db_mk_m_4").value+"|"+document.getElementById("set_db_mk_m_5_jam").value+":"+document.getElementById("set_db_mk_m_5_mnt").value+":"+document.getElementById("set_db_mk_m_5_dtk").value+"|"+document.getElementById("set_db_mk_m_6_thn").value+"-"+document.getElementById("set_db_mk_m_6_bln").value+"-"+document.getElementById("set_db_mk_m_6_hri").value+"|"+document.getElementById("set_db_mk_m_7").value+"|"+document.getElementById("set_db_mk_m_8").value;
					if(s_mk_m==1){				//1-edit 2-add
						v=v+"|";
						var a=document.getElementById("list_set_db_mk_m").value;
						$.post("Ajax/transfer_mk2_inner.php",{code:"mk_m", code_in:"set",kode_mk:"'.$kode_mk.'",nrp:a,data:v}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_m").disabled=false;
							reloadMK_M();
						});
					}else{
						$.post("Ajax/transfer_mk2_inner.php",{code:"mk_m", code_in:"add",kode_mk:"'.$kode_mk.'",data:v}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_m").disabled=false;
							reloadMK_M();
						});
					}
					s_mk_m=0;
				}
			}
			function goDelMK_M(){
				if('.$code_.'==3){return false};
				if((s_mk_m==0)&&(document.getElementById("list_set_db_mk_m").selectedIndex!=-1)){
					mk_m_lock();
					var a=document.getElementById("list_set_db_mk_m").value;
					$.post("Ajax/transfer_mk2_inner.php",{code:"mk_m", code_in:"del",kode_mk:"'.$kode_mk.'",nrp:a}, function(data_) {
							alert(data_);
							document.getElementById("list_set_db_mk_m").disabled=false;
							reloadMK_M();
					});
				}
			}
			function goEditMK_M(){
				if('.$code_.'==3){return false};
				if((s_mk_m==0)&&(document.getElementById("list_set_db_mk_m").selectedIndex!=-1)){
					mk_m_lock();
					s_mk_m=1;
					var a=document.getElementById("list_set_db_mk_m").value;
					$.post("Ajax/transfer_mk2_inner.php",{code:"mk_m", code_in:"get",kode_mk:"'.$kode_mk.'",nrp:a}, function(data_) {
							respons = eval(\'(\' + data_ + \')\');
							document.getElementById("set_db_mk_m_1").value=respons.nrp;
							document.getElementById("set_db_mk_m_1a").value=respons.nama;
							document.getElementById("set_db_mk_m_2").value=respons.semester;
							document.getElementById("set_db_mk_m_3a").value=respons.masa.substring(0,4);
							document.getElementById("set_db_mk_m_3b").value=respons.masa.substring(5,7);
							document.getElementById("set_db_mk_m_4").value=respons.hari_register;
							document.getElementById("set_db_mk_m_5_jam").value=respons.time_register.substring(0,2);
							document.getElementById("set_db_mk_m_5_mnt").value=respons.time_register.substring(3,5);
							document.getElementById("set_db_mk_m_5_dtk").value=respons.time_register.substring(6,8);
							document.getElementById("set_db_mk_m_6_thn").value=respons.tanggal_register.substring(0,4);
							document.getElementById("set_db_mk_m_6_bln").value=respons.tanggal_register.substring(5,7);
							document.getElementById("set_db_mk_m_6_hri").value=respons.tanggal_register.substring(8,10);
							document.getElementById("set_db_mk_m_7").value=respons.nilai;
							document.getElementById("set_db_mk_m_8").value=respons.lulus;
							document.getElementById("list_set_db_mk_m").disabled=true;
							document.getElementById("set_db_mk_m_1").disabled=false;
							document.getElementById("set_db_mk_m_2").disabled=false;
							document.getElementById("set_db_mk_m_3a").disabled=false;
							document.getElementById("set_db_mk_m_3b").disabled=false;
							document.getElementById("set_db_mk_m_4").disabled=false;
							document.getElementById("set_db_mk_m_5_jam").disabled=false;
							document.getElementById("set_db_mk_m_5_mnt").disabled=false;
							document.getElementById("set_db_mk_m_5_dtk").disabled=false;
							document.getElementById("set_db_mk_m_6_thn").disabled=false;
							document.getElementById("set_db_mk_m_6_bln").disabled=false;
							document.getElementById("set_db_mk_m_6_hri").disabled=false;
							document.getElementById("set_db_mk_m_7").disabled=false;
							document.getElementById("set_db_mk_m_8").disabled=false;
					});
				}
			}
			function goCancelMK_M(){
				if('.$code_.'==3){return false};
				if((s_mk_m==1)||(s_mk_m==2)){
					mk_m_lock();
					s_mk_m=0;
					document.getElementById("list_set_db_mk_m").disabled=false;
				}
			}
			
function mk_m_lock(){document.getElementById("list_set_db_mk_m").disabled=true;document.getElementById("set_db_mk_m_1").disabled=true;document.getElementById("set_db_mk_m_2").disabled=true;document.getElementById("set_db_mk_m_1a").disabled=true;document.getElementById("set_db_mk_m_3a").disabled=true;document.getElementById("set_db_mk_m_3b").disabled=true;document.getElementById("set_db_mk_m_4").disabled=true;document.getElementById("set_db_mk_m_5_jam").disabled=true;document.getElementById("set_db_mk_m_5_mnt").disabled=true;document.getElementById("set_db_mk_m_5_dtk").disabled=true;document.getElementById("set_db_mk_m_6_thn").disabled=true;document.getElementById("set_db_mk_m_6_bln").disabled=true;document.getElementById("set_db_mk_m_6_hri").disabled=true;document.getElementById("set_db_mk_m_7").disabled=true;document.getElementById("set_db_mk_m_8").disabled=true;}

function mk_s_lock(){document.getElementById("list_set_db_mk_s").disabled=true;document.getElementById("set_db_mk_s_1").disabled=true;document.getElementById("set_db_mk_s_2").disabled=true;document.getElementById("set_db_mk_s_1a").disabled=true;}
			
function mk_d_lock(){document.getElementById("list_set_db_mk_d").disabled=true;document.getElementById("set_db_mk_d_1").disabled=true;document.getElementById("set_db_mk_d_2").disabled=true;}

function mk_j_lock(){document.getElementById("list_set_db_mk_j").disabled=true;document.getElementById("set_db_mk_j_1").disabled=true;document.getElementById("set_db_mk_j_2").disabled=true;}

function calcKDR(x){if((x>5)||(x==0)){document.getElementById("set_db_mk_kode_akhir").value=6;}else{document.getElementById("set_db_mk_kode_akhir").value=1;}if((x>5)||(x==0)){if(x==0){document.getElementById("set_db_mk_kode_akhir_revisi").value=5;}else{document.getElementById("set_db_mk_kode_akhir_revisi").value=(x-6);}}else{document.getElementById("set_db_mk_kode_akhir_revisi").value=(x-1);}}
			
			function getLastCode(){
				var d = document.getElementById("set_db_mk_1_a").title;
				if(d.length<=2){alert("Lenght of Code Min. = 3,\nChoose Type and Course.");}
				else{$.post("Ajax/database_db_mk.php",{code:"getlastcode", kode_mk:d}, function(data_) {
						if(data_==""){alert("No MK with this code");document.getElementById("set_db_mk_1_b").value="001";calcKDR(1);}else{
						alert("Last Code was "+data_+".");
						var e = parseFloat(data_.substring(3,5));
						var f = parseFloat(data_.substring(5,6));
						var g;
						if((f>5)||(f==0)){g=1;e=e+1}else{g=6;}
						if(e<10){e="0"+e}document.getElementById("set_db_mk_1_b").value=e+""+g;calcKDR(g);}
				});}
			}
			function changeKDr(){
				a=parseFloat(document.getElementById("set_db_mk_kode_akhir").value);
				b=parseFloat(document.getElementById("set_db_mk_kode_akhir_revisi").value);
				c=a+b;
				if(c>=10){c=0;document.getElementById("set_db_mk_1_b").value = document.getElementById("set_db_mk_1_b").value.substring(0,1)+""+(parseFloat(document.getElementById("set_db_mk_1_b").value.substring(1,2))+1)+""+c;}else{
				document.getElementById("set_db_mk_1_b").value = document.getElementById("set_db_mk_1_b").value.substring(0,2)+""+c;}
			}
			function changeTimeEnd(){
				var x = document.getElementById("set_db_mk_3").value;
				j = parseFloat(document.getElementById("set_db_mk_6_jam").value);
				m = parseFloat(document.getElementById("set_db_mk_6_mnt").value);
				d = document.getElementById("set_db_mk_6_dtk").value;
				x = x*50;x = m+x;var jj = 0;while(x>=60){jj++;x=x-60;}j=j+jj;
				if(j>24){alert("==a g mungkin deh... tengah malam tha..");j=j-24}
				if(j<10){j="0"+j;}if(x<10){x="0"+x;}
				document.getElementById("set_db_mk_7_jam").value=j;
				document.getElementById("set_db_mk_7_mnt").value=x;
				document.getElementById("set_db_mk_7_dtk").value=d;
			}
			function changeSKSV(v){changeSKS(v.value);}
			function changeSKS(v){
				v = v*50;
				document.getElementById("time_sks").innerHTML = v+"m";			
			}
			var xAWAL = "'.substr($data['kode_mata_kuliah'],3,3).'";
			function cekKODEMK(x){
				if(x.value.length<3){alert("Wrong Code, Lenght must 6");x.value = xAWAL;}
			}
			function GoChangeKodeDepan(){
				document.getElementById("set_db_mk_1_a").title = document.getElementById("set_db_mk_jurusan").value + ""+ document.getElementById("set_db_mk_jenis").value;
				$("#set_db_mk_1_a").html(document.getElementById("set_db_mk_1_a").title);
			}
			function GoChangeLabelKodeJurusanV(slct){
				GoChangeLabelKodeJurusan(slct.value);
			}
			function GoChangeLabelKodeJurusan(slct){
				document.getElementById("set_db_mk_kode_jurusan").title = slct;
				$("#set_db_mk_kode_jurusan").html(document.getElementById("set_db_mk_kode_jurusan").title);
				GoChangeKodeDepan();
			}
			function GoChangeLabelKodeJurusanJV(slct){
				GoChangeLabelKodeJurusanJ(slct.value);
			}
			function GoChangeLabelKodeJurusanJ(slct){
				document.getElementById("set_db_mk_j_kode_jurusan").title = slct;
				$("#set_db_mk_j_kode_jurusan").html(document.getElementById("set_db_mk_j_kode_jurusan").title);
			}
			function GoChangeLabelKodeJenisV(slct){
				GoChangeLabelKodeJenis(slct.value);
			}
			function GoChangeLabelKodeJenis(slct){
				document.getElementById("set_db_mk_kode_jenis").title = slct;
				$("#set_db_mk_kode_jenis").html(document.getElementById("set_db_mk_kode_jenis").title);
				GoChangeKodeDepan();
			}
			
			function GoSAVE(v){  //1 add, 2 modif
			if(v==3){HidePanel();return false;}
				var value = "";
				value = document.getElementById("set_db_mk_1_a").title+""+document.getElementById("set_db_mk_1_b").value+"|"+document.getElementById("set_db_mk_2").value+"|"+document.getElementById("set_db_mk_3").value+"|"+document.getElementById("set_db_mk_4").value+"|"+document.getElementById("set_db_mk_5").value+"|"+document.getElementById("set_db_mk_6_jam").value+":"+document.getElementById("set_db_mk_6_mnt").value+":"+document.getElementById("set_db_mk_6_dtk").value+"|"+document.getElementById("set_db_mk_7_jam").value+":"+document.getElementById("set_db_mk_7_mnt").value+":"+document.getElementById("set_db_mk_7_dtk").value+"|";
				var x;if('.$code_.'!=1){
				x = confirm("Are You also want to change relationshop code [course,faculty,students,requirement]");
				if(x){x="true";}else{x="false";}}else{x="true";}
				ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
				$.post("Ajax/database_db_mk.php",{code:'.$code_.', kode_mk:"'.$kode_mk.'" ,value:value, value2:x}, function(data_) {
						search(\'db_mk\');
						search(\'db_mk_j\');
						search(\'db_mk_s\');
						search(\'db_mk_d\');
						search(\'db_mk_m\');
						alert(data_);
						HidePanel();
				});
			}
			function checkipk(text){
				var t = parseFloat(text.value);
				if((t>4)||(t<0)){alert("Wrong Value... Range 0.00 ~ 4.00");text.value = 0.00;}				
			}
			function checksks(text){
				var t = parseFloat(text.value);
				if((t>24)||(t<0)){alert("Wrong Value... Range 0 ~ 24");text.value = 0;}				
			}



			
			</script>
			';
			exit($out);
		break;
	}
}

?>

