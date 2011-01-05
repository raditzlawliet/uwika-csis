<?php
include 'transfer_dosen.php';

$code = htmlentities($_POST['code_hidden']);
$code_ = htmlentities($_POST['code_edit']);
$nrp = htmlentities($_POST['nrp']);

switch($code){
	case 'db_d' : { //db awal
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
			$data = getDataDatabaseDosen($nrp);
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
				
			$fakultas = getDatabaseFakultas();
			$jurusan = getDatabaseJurusan();
			
			for($i=0;$i<=$fakultas[0][0]['k'];$i++){
				$opt_fakultas=$opt_fakultas.'<option value="'.$fakultas[0][$i]['kode_fakultas'].'">'.$fakultas[0][$i]['nama_fakultas'].'</option>';
				$script_array = $script_array.'hardcoded_values["'.$fakultas[0][$i]['kode_fakultas'].'"]=new Array(';
				$script_array2 = $script_array2.'hardcoded_inner["'.$fakultas[0][$i]['kode_fakultas'].'"]=new Array(';
					$l = 0;
				for($j=0;$j<=$jurusan[0][0]['k'];$j++){
					if($jurusan[0][$j]['kode_fakultas']==$fakultas[0][$i]['kode_fakultas'])
					{	if($l!=0){$script_array = $script_array.',';$script_array2 = $script_array2.',';}
						$l++;
						$opt_jurusan=$opt_jurusan.'<option value="'.$jurusan[0][$j]['kode_jurusan'].'">'.$jurusan[0][$j]['nama_jurusan'].'</option>';
						$script_array =  $script_array.'"'.$jurusan[0][$j]['kode_jurusan'].'"';
						$script_array2 =  $script_array2.'"'.$jurusan[0][$j]['nama_jurusan'].'"';
					}
				}
				$script_array =  $script_array.');';
				$script_array2 =  $script_array2.');';
			}

			$table = $table.
			'<tr><td width="15%">NRP</td><td width="2%"> : </td>
			<td><label id="set_db_d_1a">'.substr($data['nrp'],0,8).'</label><input class="input"  onKeyUp="javascript:setuid();" onchange="javascript:setuid();" id="set_db_d_1b" value="'.substr($data['nrp'],8,3).'" size="1" maxlength="3" '.$view.'\> <label>Angkatan</label><select class="input" onchange="javascript:GoChangeLabelAngkatan(this)" id="set_db_d_1c" '.$view.' title="angkatan" dir="ltr">'.$opt_angkatan.'</select></td>
			<td><label>Type</label></td><td> : </td><td><select class="input" onchange="javascript:GoChangeLabelJenis(this)" id="set_db_d_1d" '.$view.' title="angkatan" dir="ltr"><option value="151">Tetap</option><option value="191">Tidak Tetap</option></select></td></tr>
			<tr><td>Password</td><td> : </td>
			<td><label id="set_db_d_2bck"></label><label style="color:red;"id="set_db_d_2enc">'.$data['password'].'</label>
			<td>New Password</td><td> : </td>
			<td><input class="input" id="set_db_d_2" type="password" value="" maxlength="15" size="15" '.$view.'\></td>
			<td><a class="submit" onclick="javascript:setpassword('.$code_.');" href="#!">Set New Password</a></td></tr>
			<tr><td>Nama</td><td> : </td>
			<td><input class="input" id="set_db_d_3" value="'.$data['nama'].'"maxlength="49" size="30" '.$view.'\></td>
			<td>A K A</td><td> : </td>
			<td><input class="input" id="set_db_d_4" value="'.$data['aka'].'" maxlength="49" size="15" '.$view.'\></td></tr>
			<tr><td>Jenis Kelamin</td><td> : </td>
			<td><select class="input" id="set_db_d_5" title="jenis_kelamin" dir="ltr" '.$view.'><option value="Laki - Laki">Laki - Laki</option><option value="Perempuan">Perempuan</option></select></td></tr>
			<tr><td>Fakultas</td><td> : </td>
			<td><select class="input" onchange="javascript:GoChangeLabelKodeFakultasV(this)" id="set_db_d_6a" title="fakultas" dir="ltr" '.$view.'>'.$opt_fakultas.'</select>&nbsp;&frasl;&nbsp;<label id="set_db_d_6a_">'.$data['kode_fakultas'].'</label></td>
			<td>Jurusan</td><td> : </td>
			<td><select class="input" onchange="javascript:GoChangeLabelKodeJurusanV(this)" id="set_db_d_6" title="jurusan" dir="ltr" '.$view.'>'.$opt_jurusan.'</select>&nbsp;&frasl;&nbsp;<label id="set_db_d_6_">'.$data['kode_jurusan'].'</label></td></tr>
			<tr><td>U I D</td><td> : </td>
			<td><label style="color:red;" id="set_db_d_7">'.$data['uid'].'</label></td>
			<td>Admin</td><td> : </td>
			<td><input class="input" id="set_db_d_8" value="'.$data['admin'].'" maxlength="3" size="2" '.$view.'\></td></tr>
			<td>Upload Picture</td><td> : </td>
			<td><input class="input" id="set_db_d_8" value="'.$data['uid'].'" '.$view.'\></td></tr>
			';
			
			$out = '<div><b><center>F A C U L T Y</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table>
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVE('.$code_.')" class="button" href="#!"><b>&nbsp;SAVE&nbsp;</b></a></td><td><a onclick="javascript:HidePanel();" class="button" id="diff" href="#!"><b>CANCEL</b></a></td></tr></table>
			</div>
			<script>
			function GoSAVE(v){  //1 add, 2 modif
			if(v==3){HidePanel();return false;}
				var xx = document.getElementById("set_db_d_1a").title.length;
				if(xx<8){alert("Pilih Jenis, Jurusan & Angkatan");return false;}
				var leng = document.getElementById("set_db_d_1b").value.length;
				if(leng==0){document.getElementById("set_db_d_1b").value = "001";}
				if(leng==1){document.getElementById("set_db_d_1b").value = "00"+document.getElementById("set_db_d_1b").value;}
				if(leng==2){document.getElementById("set_db_d_1b").value = "0"+document.getElementById("set_db_d_1b").value;}
				var value = "";
				value = document.getElementById("set_db_d_1a").title +""+document.getElementById("set_db_d_1b").value +"|"+document.getElementById("set_db_d_2bck").title+"|"+document.getElementById("set_db_d_2enc").title+"|";
				value = value +document.getElementById("set_db_d_3").value +"|"+document.getElementById("set_db_d_4").value +"|"+document.getElementById("set_db_d_5").value +"|";
				value = value+document.getElementById("set_db_d_6").value+"|"+ document.getElementById("set_db_d_7").title+"|"+document.getElementById("set_db_d_8").value;
								ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
				$.post("Ajax/database_db_d.php",{nrp: "'.$nrp.'", setpassword:setpassmhs, value : value, code:v}, function(data_) {
					alert(data_);
					search(\'db_d\');
					HidePanel();
				}); 
			}
			
			function setuid(v){
				if(v!=3){
				var pass = getNRP();
				$.post("Ajax/encryp.php",{code:"sha1md5", str:pass}, function(data) {
					document.getElementById("set_db_d_7").title = data;
					$("#set_db_d_7").html(document.getElementById("set_db_d_7").title);
				});
				}
			}
			function setpassword(v){
				if(v!=3){
				var pass = document.getElementById("set_db_d_2").value;
				$.post("Ajax/encryp.php",{code:"sha1md5", str:pass}, function(data) {
					document.getElementById("set_db_d_2enc").title = data;
					document.getElementById("set_db_d_2bck").title = pass;
					$("#set_db_d_2enc").html(document.getElementById("set_db_d_2enc").title);
					setpassmhs = true;
				});
				}
			}
			var setpassmhs = false;
			document.getElementById("set_db_d_2enc").title = "'.$data['password'].'";
			document.getElementById("set_db_d_5").value = "'.$data['jenis_kelamin'].'";
			document.getElementById("set_db_d_1c").value = "'.substr($data['nrp'],6,2).'";
			document.getElementById("set_db_d_1d").value = "'.substr($data['nrp'],0,3).'";
			document.getElementById("set_db_d_6a").value = "'.$data['kode_fakultas'].'";
			if("'.$code_.'"=="1"){alert("Fill the Blank !");}else{
			GoChangeLabelKodeFakultas("'.$data['kode_fakultas'].'");
			GoChangeLabelKodeJurusan("'.$data['kode_jurusan_prioritas'].'");
			}
			document.getElementById("set_db_d_6").value = "'.$data['kode_jurusan_prioritas'].'";
			function getNRP(){
				return document.getElementById("set_db_d_1a").title +""+document.getElementById("set_db_d_1b").value;
			}
			function GoChangeNrpDepan(){
				document.getElementById("set_db_d_1a").title = document.getElementById("set_db_d_1d").value+""+document.getElementById("set_db_d_6_").title + ""+ document.getElementById("set_db_d_1c").value;
				$("#set_db_d_1a").html(document.getElementById("set_db_d_1a").title);
				setuid();
			}
			function GoChangeLabelAngkatan(slct){
				document.getElementById("set_db_d_1a").title = document.getElementById("set_db_d_1d").value+""+document.getElementById("set_db_d_6_").title + ""+ slct.value;
				$("#set_db_d_1a").html(document.getElementById("set_db_d_1a").title);
				GoChangeNrpDepan();
			}
			function GoChangeLabelJenis(slct){
				document.getElementById("set_db_d_1a").title = slct.value+""+document.getElementById("set_db_d_6_").title + ""+ document.getElementById("set_db_d_1c").value;
				$("#set_db_d_1a").html(document.getElementById("set_db_d_1a").title);
				GoChangeNrpDepan();
			}
			function GoChangeLabelKodeFakultasV(slct){
				GoChangeLabelKodeFakultas(slct.value);
				combo1_selection_changedV(slct);
			}
			function GoChangeLabelKodeFakultas(slct){
				document.getElementById("set_db_d_6a_").title = slct;
				$("#set_db_d_6a_").html(document.getElementById("set_db_d_6a_").title);
				combo1_selection_changed(slct);
				GoChangeNrpDepan();
			}
			function GoChangeLabelKodeJurusanV(slct){
				GoChangeLabelKodeJurusan(slct.value);
			}
			function GoChangeLabelKodeJurusan(slct){
				document.getElementById("set_db_d_6_").title = slct;
				$("#set_db_d_6_").html(document.getElementById("set_db_d_6_").title);
				GoChangeNrpDepan();
			}
			function combo1_selection_changedV(combo1){
				combo1_selection_changed(combo1.value);
			}
			function combo1_selection_changed(combo1_value)
			{
				var hardcoded_values = new Array();
				'.$script_array.'
				var hardcoded_inner = new Array();
				'.$script_array2.'
				document.getElementById("set_db_d_6").options.length=0;
				for (var i=0;i<hardcoded_values[combo1_value].length;i++)
				{
					var opt = document.createElement("option");
					opt.setAttribute(\'value\',hardcoded_values[combo1_value][i]);
					opt.innerHTML = hardcoded_inner[combo1_value][i];
					document.getElementById("set_db_d_6").appendChild(opt);
					
				}
				GoChangeLabelKodeJurusan(hardcoded_values[combo1_value][0]);
				GoChangeNrpDepan();
			}
			if('.$code_.'==1){document.getElementById("set_db_d_6a").value = "FE";
			document.getElementById("set_db_d_6").value = "611";
			document.getElementById("set_db_d_1c").value = "11";
			document.getElementById("set_db_d_1d").value = "151";
			GoChangeLabelKodeJurusan("611");GoChangeLabelKodeFakultas("FE");
			}

			</script>
			';
			exit($out);
		break;
	}
}

?>

