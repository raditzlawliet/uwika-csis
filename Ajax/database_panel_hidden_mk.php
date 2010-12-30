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
			$set_height = "350";
			if(isset($_COOKIE['set_height_mk_list'])){
				$set_height = $_COOKIE['set_height_mk_list'];
			}
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
			for($i=2011;$i>=1920;$i--){$thn_ = $thn_.'<option value="'.$i.'">'.$i.'</option>';}
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
			<td><select class="input" id="set_db_mk_5" dir="ltr" '.$view.'><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thrusday</option><option value="5">Friday</option></select><option value="6">Saturday</option></select></td>

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
				$data_m_op = $data_m_op.'<option value="'.$data_m[$i]['nrp'].'">'.$data_m[$i]['nama'].' ( '.$data_m[$i]['nrp'].' ) at '.$data_m[$i]['masa'].' and Semester '.$data_m[$i]['semester'].'</option>'; 
			}
			for($i=0;$i<$data_s['k'];$i++){
				$data_s_op = $data_s_op.'<option value="'.$data_s[$i]['kode_mata_kuliah_syarat'].'">'.$data_s[$i]['nama_mata_kuliah'].' ( '.$data_s[$i]['kode_mata_kuliah_syarat'].' ) - '.$data_s[$i]['kode_syarat'].'</option>'; 
			}
			$table2 = $table2.
			'<tr><td width="50%">List of Course that Registered this Subject</td><td><a onclick="javascript:goAddMK_J();" class="submit" href="#!">Add</a>&nbsp;<a onclick="javascript:goDelMK_J();" class="submit" href="#!">Del</a>&nbsp;<a onclick="javascript:goEditMK_J();" class="submit" href="#!">Edit</a></td></tr>
			<tr><td id="mk_j_list" width="50%"><select class="input" style="width:95%;" id="list_set_db_mk_j" onchange="javascript:goViewMK_J();" size="5">'.$data_j_op.'</select></td>
			<td>
				<table>
				<tr><td>Course Name</td><td>:</td><td><select class="input" onchange="javascript:GoChangeLabelKodeJurusanJV(this)" id="set_db_mk_j_1" title="jurusan" dir="ltr" disabled>'.$opt_jurusanJ.'</select>&nbsp;&frasl;&nbsp;<label id="set_db_mk_j_kode_jurusan"></label></td></tr>
				<tr><td>Semester</td><td>:</td><td><select class="input" id="set_db_mk_j_2" dir="ltr" disabled><option value="0">0 (if u want to hide it)</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select></td></tr>
				<tr><td><a onclick="javascript:goSaveMK_J();" class="submit" href="#!">Save</a><a onclick="javascript:goCancelMK_J();" class="submit" href="#!">Cancel</a></td><td></td></tr>
				</table>
			</td></tr>
			';
			
			$table3 = $table3.
			'<tr><td width="50%">List of Faculty that Registered this Subject</td><td><a onclick="javascript:goAddMK_D();" class="submit" href="#!">Add</a>&nbsp;<a onclick="javascript:goDelMK_D();" class="submit" href="#!">Del</a>&nbsp;<a onclick="javascript:goEditMK_D();" class="submit" href="#!">Edit</a></td></tr>
			<tr><td id="mk_d_list" width="50%"><select class="input" style="width:95%;" id="list_set_db_mk_d" onchange="javascript:goViewMK_D();" size="5">'.$data_d_op.'</select></td>
			<td>
				<table>
				<tr><td>Faculty NRP</td><td>:</td><td><select class="input" onchange="javascript:GoChangeLabelKodeJurusanJV(this)" id="set_db_mk_j_1" title="jurusan" dir="ltr" disabled>'.$opt_jurusanJ.'</select>&nbsp;&frasl;&nbsp;<label id="set_db_mk_j_kode_jurusan"></label></td></tr>
				<tr><td>Semester</td><td>:</td><td><select class="input" id="set_db_mk_j_2" dir="ltr" disabled><option value="0">0 (if u want to hide it)</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select></td></tr>
				<tr><td><a onclick="javascript:goSaveMK_J();" class="submit" href="#!">Save</a><a onclick="javascript:goCancelMK_J();" class="submit" href="#!">Cancel</a></td><td></td></tr>
				</table>
			</td></tr>
			';
			
			$table4 = $table4.
			'<tr><td width="50%">List of Requirement Subject that Registered this Subject</td><td><a onclick="javascript:goAddMK_J();" class="submit" href="#!">Add</a>&nbsp;<a onclick="javascript:goDelMK_J();" class="submit" href="#!">Del</a>&nbsp;<a onclick="javascript:goEditMK_J();" class="submit" href="#!">Edit</a></td></tr>
			<tr><td width="50%"><select class="input" style="width:95%;" id="list_set_db_mk_j onblur="javascript:alert(124);" class="select" name="list" size="5" title="titlelist">'.$data_s_op.'</select></td>
			<td>
				<table>
				<tr><td>Course Name</td><td>:</td><td><input maxlenght="3" disabled></input></td></tr>
				</table>
			</td></tr>
			';
			
			$table5 = $table5.
			'<tr><td width="50%">List of Students Subject that Registered this Subject</td><td><a class="submit" href="#!">Add</a>&nbsp;<a class="submit" href="#!">Del</a>&nbsp;<a class="submit" href="#!">Edit</a></td></tr>
			<tr><td width="50%"><select class="input" style="width:95%;" id="list_set_db_mk_j onblur="javascript:alert(124);" class="select" name="list" size="5" title="titlelist">'.$data_m_op.'</select></td>
			<td>
				<table>
				<tr><td>Course Name</td><td>:</td><td><input maxlenght="3" disabled></input></td></tr>
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
			
			$out = '<div><b><center>S U B J E C T</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<div id="mk_"><table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table></div>
			'.$outb.'
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVE('.$code_.')" class="button" href="#!"><b>&nbsp;SAVE&nbsp;</b></a></td><td><a onclick="javascript:HidePanel();" class="button" id="diff" href="#!"><b>CANCEL</b></a></td></tr></table>
			</div>
			<script>
			
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
						respons = eval(\'(\' + data_ + \')\');
						var d;
						for(var i=0;i<respons[\'k\'];i++){
							d=d+\'<option value="\'+respons[i].kode_jurusan+\'">\'+respons[i].nama_jurusan+\' ( \'+respons[i].kode_jurusan+\' ) at Semester \'+respons[i].semester+\'</option>\'; 
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
					var v = document.getElementById("set_db_mk_j_1").value+"|"+document.getElementById("set_db_mk_j_2").value
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

