<?php
session_start();
include 'transfer_.php';

$code = htmlentities($_POST['code_hidden']);
$code_ = htmlentities($_POST['code_edit']);
$nrp = htmlentities($_POST['nrp']);

switch($code){
	case 'db_m' : { //db awal
		switch($code_){
			case 1:{ //add
				$view = '';
				$addd = '<label style="color:red;">Biasanya 0 untuk mahasiswa baru.</label>';
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
			$data = getDataDatabaseMahasiswa($nrp);
			for($i=40;$i!=999;$i--){
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
			for($i=2019;$i>=1920;$i--){$thn_ = $thn_.'<option value="'.$i.'">'.$i.'</option>';}
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
			<td><label id="set_db_nrp_depan">'.substr($data['nrp'],0,5).'</label><input class="input"  onKeyUp="javascript:setuid();" onchange="javascript:setuid();" id="set_db_mahasiswa_nrp_belakang" value="'.substr($data['nrp'],5,3).'" size="1" maxlength="3" '.$view.'\> <label>Angkatan</label><select class="input" onchange="javascript:GoChangeLabelAngkatan(this)" id="set_db_mahasiswa_angkatan" '.$view.' title="angkatan" dir="ltr">'.$opt_angkatan.'</select></td></tr>
			<tr><td>Password</td><td> : </td>
			<td><label id="set_db_mahasiswa_password_bck"></label><label style="color:red;"id="set_db_mahasiswa_password_enc">'.$data['password'].'</label>
			<td>New Password</td><td> : </td>
			<td><input class="input" id="set_db_mahasiswa_password" type="password" value="" maxlength="15" size="15" '.$view.'\></td>
			<td><a class="submit" onclick="javascript:setpassword('.$code_.');" href="#!">Set New Password</a></td></tr>
			<tr><td>Nama</td><td> : </td>
			<td><input class="input" id="set_db_mahasiswa_nama" value="'.$data['nama'].'"maxlength="49" size="30" '.$view.'\></td>
			<td>A K A</td><td> : </td>
			<td><input class="input" id="set_db_mahasiswa_aka" value="'.$data['aka'].'" maxlength="49" size="15" '.$view.'\></td></tr>
			<tr><td>Jenis Kelamin</td><td> : </td>
			<td><select class="input" id="set_db_mahasiswa_jenis_kelamin" title="jenis_kelamin" dir="ltr" '.$view.'><option value="Laki - Laki">Laki - Laki</option><option value="Perempuan">Perempuan</option></select></td>
			<td>Tanggal Lahir</td><td> : </td>
			<td><select class="input" id="set_db_mahasiswa_tanggal_lahir_thn" title="fakultas" dir="ltr" '.$view.'>'.$thn_.'</select><select class="input" id="set_db_mahasiswa_tanggal_lahir_bln" title="fakultas" dir="ltr" '.$view.'>'.$bln_.'</select><select class="input" id="set_db_mahasiswa_tanggal_lahir_hri" title="fakultas" dir="ltr" '.$view.'>'.$hri_.'</select></td><td><label style="color:red"> (YYYY-MM-DD)</label></td></tr>
			<tr><td>Alamat</td><td> : </td>
			<td><input class="input" id="set_db_mahasiswa_alamat" value="'.$data['alamat'].'" size="20" '.$view.'\></td></tr>
			<tr><td>Asal Sekolah</td><td> : </td>
			<td><input class="input" id="set_db_mahasiswa_asal_sekolah" value="'.$data['asal_sekolah'].'" maxlength="49" size="30" '.$view.'\></td></tr>
			<tr><td>Fakultas</td><td> : </td>
			<td><select class="input" onchange="javascript:GoChangeLabelKodeFakultasV(this)" id="set_db_mahasiswa_fakultas" title="fakultas" dir="ltr" '.$view.'>'.$opt_fakultas.'</select>&nbsp;&frasl;&nbsp;<label id="set_db_kode_fakultas">'.$data['kode_fakultas'].'</label></td>
			<td>Jurusan</td><td> : </td>
			<td><select class="input" onchange="javascript:GoChangeLabelKodeJurusanV(this)" id="set_db_mahasiswa_jurusan" title="jurusan" dir="ltr" '.$view.'>'.$opt_jurusan.'</select>&nbsp;&frasl;&nbsp;<label id="set_db_kode_jurusan">'.$data['kode_jurusan'].'</label></td></tr>
			<tr><td>Kelas</td><td> : </td>
			<td><select class="input" id="set_db_mahasiswa_probis" title="probis" dir="ltr" '.$view.'><option value="0">Morning</option><option value="1" '.$view.'>Probis</option></select></td>
			<td>Tanggal Masuk</td><td> : </td>
			<td><select class="input" id="set_db_mahasiswa_tanggal_masuk_thn" title="fakultas" dir="ltr" '.$view.'>'.$thn_.'</select><select class="input" id="set_db_mahasiswa_tanggal_masuk_bln" title="fakultas" dir="ltr" '.$view.'>'.$bln_.'</select><select class="input" id="set_db_mahasiswa_tanggal_masuk_hri" title="fakultas" dir="ltr" '.$view.'>'.$hri_.'</select></td><td><label style="color:red"> (YYYY-MM-DD)</label></td></tr>
			<tr><td>Semester</td><td> : </td>
			<td><input class="input" id="set_db_mahasiswa_semester" value="'.$data['semester'].'" maxlength="2" size="2" '.$view.'\>&nbsp;<a class="submit" onclick="javascript:setsms('.$code_.');" href="#!">Cri SMS dr NRP & MASA</a></td><td>&nbsp;</td><td>&nbsp;</td><td>'.$addd.'</td></tr>
			<tr><td>IPK</td><td> : </td>
			<td><input onchange="javascript:checkipk(this);" class="input" id="set_db_mahasiswa_ipk" value="'.$data['ipk'].'" maxlength="4" size="2" '.$view.'\>&nbsp;<a class="submit" onclick="javascript:setipk('.$code_.');" href="#!">Cri IPK From IPS</a></td></tr>
			<td>S K S Awal/Limit</td><td> : </td>
			<td><input onchange="javascript:checksks(this);" class="input" id="set_db_mahasiswa_sks_awal" value="'.$data['sks_awal'].'" maxlength="2" size="2" '.$view.'\>&nbsp;<a class="submit" onclick="javascript:setsks('.$code_.');" href="#!">Cri SKS dr IPK</a></td>
			<td>Sisa S K S</td><td> : </td>
			<td><input onchange="javascript:checksks(this);" class="input" id="set_db_mahasiswa_sisa_sks" value="'.$data['sisa_sks'].'" maxlength="2" size="2" '.$view.'\>&nbsp;</td>
			<tr><td>U I D</td><td> : </td>
			<td><label style="color:red;" id="set_db_mahasiswa_uid">'.$data['uid'].'</label></td>
			<td>Admin</td><td> : </td>
			<td><input class="input" id="set_db_mahasiswa_admin" value="'.$data['admin'].'" maxlength="3" size="2" '.$view.'\></td></tr>
			<td>Upload Picture</td><td> : </td>
			<td><input class="input" id="set_db_mahasiswa_admin" value="'.$data['uid'].'" '.$view.'\></td></tr>
			';
			
			$out = '<div><b><center>S T U D E N T</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table>
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVE('.$code_.')" class="button" href="#!"><b>&nbsp;SIMPAN&nbsp;</b></a></td><td><a onclick="javascript:HidePanel();" class="button" id="diff" href="#!"><b>BATAL</b></a></td></tr></table>
			</div>
			<script>
			document.getElementById("set_db_mahasiswa_password_enc").title = "'.$data['password'].'";
			document.getElementById("set_db_mahasiswa_tanggal_lahir_thn").value = "'.substr($data['tanggal_lahir'],0,4).'";
			document.getElementById("set_db_mahasiswa_tanggal_lahir_bln").value = "'.substr($data['tanggal_lahir'],5,2).'";
			document.getElementById("set_db_mahasiswa_tanggal_lahir_hri").value = "'.substr($data['tanggal_lahir'],8,2).'";
			document.getElementById("set_db_mahasiswa_tanggal_masuk_thn").value = "'.substr($data['tanggal_masuk'],0,4).'";
			document.getElementById("set_db_mahasiswa_tanggal_masuk_bln").value = "'.substr($data['tanggal_masuk'],5,2).'";
			document.getElementById("set_db_mahasiswa_tanggal_masuk_hri").value = "'.substr($data['tanggal_masuk'],8,2).'";
			document.getElementById("set_db_mahasiswa_probis").value = "'.$data['probis'].'";
			document.getElementById("set_db_mahasiswa_jenis_kelamin").value = "'.$data['jenis_kelamin'].'";
			document.getElementById("set_db_mahasiswa_angkatan").value = "'.substr($data['nrp'],3,2).'";
			document.getElementById("set_db_mahasiswa_fakultas").value = "'.$data['kode_fakultas'].'";
			document.getElementById("set_db_mahasiswa_jurusan").value = "'.$data['kode_jurusan'].'";
			if("'.$code_.'"=="1"){alert("Fill the Blank !");}else{
				GoChangeLabelKodeFakultas("'.$data['kode_fakultas'].'");
				GoChangeLabelKodeJurusan("'.$data['kode_jurusan'].'");
				document.getElementById("set_db_mahasiswa_jurusan").value = "'.$data['kode_jurusan'].'";
			}
			function GoSAVE(v){  //1 add, 2 modif
			if(v==3){HidePanel();return false;}
				var xx = document.getElementById("set_db_nrp_depan").title .length;
				if(xx<5){alert("Pilih Jurusan & Angkatan");return false;}
				var leng = document.getElementById("set_db_mahasiswa_nrp_belakang").value.length;
				if(leng==0){document.getElementById("set_db_mahasiswa_nrp_belakang").value = "001";}
				if(leng==1){document.getElementById("set_db_mahasiswa_nrp_belakang").value = "00"+document.getElementById("set_db_mahasiswa_nrp_belakang").value;}
				if(leng==2){document.getElementById("set_db_mahasiswa_nrp_belakang").value = "0"+document.getElementById("set_db_mahasiswa_nrp_belakang").value;}
				var bajengan = "nrp|password_bck|password|";
				var value = "";
				value = document.getElementById("set_db_nrp_depan").title +""+document.getElementById("set_db_mahasiswa_nrp_belakang").value +"|"+document.getElementById("set_db_mahasiswa_password_bck").title+"|"+document.getElementById("set_db_mahasiswa_password_enc").title+"|";
				value = value +document.getElementById("set_db_mahasiswa_nama").value +"|"+document.getElementById("set_db_mahasiswa_aka").value +"|"+document.getElementById("set_db_mahasiswa_jenis_kelamin").value +"|"+document.getElementById("set_db_mahasiswa_tanggal_lahir_thn").value +"-"+document.getElementById("set_db_mahasiswa_tanggal_lahir_bln").value +"-"+document.getElementById("set_db_mahasiswa_tanggal_lahir_hri").value+"|";
				value = value +document.getElementById("set_db_mahasiswa_alamat").value +"|"+document.getElementById("set_db_mahasiswa_asal_sekolah").value +"|"+document.getElementById("set_db_mahasiswa_jurusan").value +"|"+document.getElementById("set_db_mahasiswa_probis").value+"|"+document.getElementById("set_db_mahasiswa_tanggal_masuk_thn").value +"-"+document.getElementById("set_db_mahasiswa_tanggal_masuk_bln").value +"-"+document.getElementById("set_db_mahasiswa_tanggal_masuk_hri").value+"|";
value = value +document.getElementById("set_db_mahasiswa_semester").value +"|"+document.getElementById("set_db_mahasiswa_ipk").value +"|"+document.getElementById("set_db_mahasiswa_sisa_sks").value +"|"+document.getElementById("set_db_mahasiswa_uid").title+"|"+document.getElementById("set_db_mahasiswa_admin").value+"|"+document.getElementById("set_db_mahasiswa_sks_awal").value;;

				ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
				$.post("Ajax/database_db_m.php",{nrp: "'.$nrp.'", setpassword:setpassmhs, value : value, value2:bajengan, code:v}, function(data_) {
					alert(data_);
					search(\'db_m\');
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
			
			function setuid(v){
				if(v!=3){
				var pass = getNRP();
				$.post("Ajax/encryp.php",{code:"sha1md5", str:pass}, function(data) {
					document.getElementById("set_db_mahasiswa_uid").title = data;
					$("#set_db_mahasiswa_uid").html(document.getElementById("set_db_mahasiswa_uid").title);
				});
				}
			}
			function setipk(v){
				if(v!=3){
				alert("IPK akan dicek dari NRP yang ada di LAYAR yang anda ubah terakhir kali dari Zigma(Nilai Value MK)/Zigma(SKS MK) Yang pernah diambil (Kondisi, WAKTU MAU KHS, Sebelum KRS)");
				var nrpx=getNRP();
					$.post("Ajax/database_panel_hidden_2.php",{code:"ipk", nrp:nrpx}, function(data) {
						document.getElementById("set_db_mahasiswa_ipk").value = data;
					});
				}
			}	
			function setsms(v){
				if(v!=3){
				alert("Semester akan dicek dari NRP yang ada di LAYAR yang anda ubah terakhir kali (Bukan di DB)");
				var nrpx=getNRP();
					$.post("Ajax/database_panel_hidden_2.php",{code:"sms", nrp:nrpx}, function(data) {
						document.getElementById("set_db_mahasiswa_semester").value = data;
					});
				}
			}			
			function setsks(v){
				if(v!=3){
				var p = parseFloat(document.getElementById("set_db_mahasiswa_ipk").value);
				var sks = 24;
				if(p<=1)sks=9;
				else if(p<1.5)sks=12;
				else if(p<2)sks=15;
				else if(p<2.5)sks=18;
				else if(p<3)sks=21;
				document.getElementById("set_db_mahasiswa_sisa_sks").value = sks;
				document.getElementById("set_db_mahasiswa_sks_awal").value = sks;
				}
			}
			function setpassword(v){
				if(v!=3){
				var pass = document.getElementById("set_db_mahasiswa_password").value;
				$.post("Ajax/encryp.php",{code:"sha1md5", str:pass}, function(data) {
					document.getElementById("set_db_mahasiswa_password_enc").title = data;
					document.getElementById("set_db_mahasiswa_password_bck").title = pass;
					$("#set_db_mahasiswa_password_enc").html(document.getElementById("set_db_mahasiswa_password_enc").title);
					setpassmhs = true;
				});
				}
			}
			var setpassmhs = false;
			function getNRP(){
				return document.getElementById("set_db_nrp_depan").title +""+document.getElementById("set_db_mahasiswa_nrp_belakang").value;
			}
			function GoChangeNrpDepan(){
				document.getElementById("set_db_nrp_depan").title = document.getElementById("set_db_kode_jurusan").title + ""+ document.getElementById("set_db_mahasiswa_angkatan").value;
				$("#set_db_nrp_depan").html(document.getElementById("set_db_nrp_depan").title);
				setuid();
			}
			function GoChangeLabelAngkatan(slct){
				document.getElementById("set_db_nrp_depan").title = document.getElementById("set_db_kode_jurusan").title + ""+ slct.value;
				$("#set_db_nrp_depan").html(document.getElementById("set_db_nrp_depan").title);
				GoChangeNrpDepan();
			}
			function GoChangeLabelKodeFakultasV(slct){
				GoChangeLabelKodeFakultas(slct.value);
				combo1_selection_changedV(slct);
			}
			function GoChangeLabelKodeFakultas(slct){
				document.getElementById("set_db_kode_fakultas").title = slct;
				$("#set_db_kode_fakultas").html(document.getElementById("set_db_kode_fakultas").title);
				combo1_selection_changed(slct);
				GoChangeNrpDepan();
			}
			function GoChangeLabelKodeJurusanV(slct){
				GoChangeLabelKodeJurusan(slct.value);
			}
			function GoChangeLabelKodeJurusan(slct){
				document.getElementById("set_db_kode_jurusan").title = slct;
				$("#set_db_kode_jurusan").html(document.getElementById("set_db_kode_jurusan").title);
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
				document.getElementById("set_db_mahasiswa_jurusan").options.length=0;
				for (var i=0;i<hardcoded_values[combo1_value].length;i++)
				{
					var opt = document.createElement("option");
					opt.setAttribute(\'value\',hardcoded_values[combo1_value][i]);
					opt.innerHTML = hardcoded_inner[combo1_value][i];
					document.getElementById("set_db_mahasiswa_jurusan").appendChild(opt);
					
				}
				GoChangeLabelKodeJurusan(hardcoded_values[combo1_value][0]);
				GoChangeNrpDepan();
			}
			if('.$code_.'==1){document.getElementById("set_db_mahasiswa_fakultas").value = "FE";
			document.getElementById("set_db_mahasiswa_jurusan").value = "611";
			document.getElementById("set_db_mahasiswa_angkatan").value = "11";
			GoChangeLabelKodeJurusan("611");GoChangeLabelKodeFakultas("FE");
			}
			</script>
			';
			exit($out);
		break;
	}
	case 'db_m' : { //db mahasiswa
			exit(getTabelDatabaseMahasiswa($search_text,$search_in,$sort_text,$sort_by,$color));
		break;
	}
	case 'db_d' : { //db dosen
			$out = '
				<center><h1 style="letter-spacing:20px;"><b>FACULTY</b></h1><p>
				'.$code.' '.$uid.' '.$admin.'  d
				</center>
				
				<script>
				</script>
				';
			exit($out);
		break;
	}
	case 'db_k' : { //db karyawan
			$out = '
				<center><h1 style="letter-spacing:20px;"><b>EMPLOYEE</b></h1><p>
				'.$code.' '.$uid.' '.$admin.'  k
				</center>
				
				<script>
				</script>
				';
			exit($out);
		break;
	}
	case 'db_mk' : { //db mata kul
			$out = '
				<center><h1 style="letter-spacing:20px;"><b>MATA KULIAH</b></h1><p>
				'.$code.' '.$uid.' '.$admin.'  mk
				</center>
				
				<script>
				</script>
				';
			exit($out);
		break;
	}
	case 'db_sc' : { //db score
			$out = '
				<center><h1 style="letter-spacing:20px;"><b>SCORE</b></h1><p>
				'.$code.' '.$uid.' '.$admin.' sc
				</center>
				
				<script>
				</script>
				';
			exit($out);
		break;
	}
	case 'db_jf' : { //db fj
			$out = '
				<center><h1 style="letter-spacing:20px;"><b>JURUSAN & FAKULTAS</b></h1><p>
				'.$code.' '.$uid.' '.$admin.'  jf
				</center>
				
				<script>
				</script>
				';
			exit($out);
		break;
	}
}

?>

