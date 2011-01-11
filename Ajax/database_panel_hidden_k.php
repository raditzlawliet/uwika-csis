<?php
include 'transfer_k.php';

$code = htmlentities($_POST['code_hidden']);
$code_ = htmlentities($_POST['code_edit']);
$nrp = htmlentities($_POST['nrp']);

switch($code){
	case 'db_k' : { //db awal
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
			$data = getDataDatabaseKaryawan($nrp);
			$table = $table.
			'
			<tr><td width="15%">NRP</td><td width="2%"> : </td>
			<td><input onchange="javascript:setuid();" onKeyUp="javascript:setuid();"class="input" id="set_db_k_1" value="'.$data['nrp'].'" maxlength="49" size="15" '.$view.'\></td></tr>
			<tr><td>Password</td><td> : </td>
			<td><label id="set_db_k_2bck"></label><label style="color:red;"id="set_db_k_2enc">'.$data['password'].'</label>
			<td>Password Baru</td><td> : </td>
			<td><input class="input" id="set_db_k_2" type="password" value="" maxlength="15" size="15" '.$view.'\></td>
			<td><a class="submit" onclick="javascript:setpassword('.$code_.');" href="#!">Set New Password</a></td></tr>
			<tr><td>Nama</td><td> : </td>
			<td><input class="input" id="set_db_k_3" value="'.$data['nama'].'"maxlength="49" size="30" '.$view.'\></td>
			<td>A K A</td><td> : </td>
			<td><input class="input" id="set_db_k_4" value="'.$data['aka'].'" maxlength="49" size="15" '.$view.'\></td></tr>
			<tr><td>Jenis Kelamin</td><td> : </td>
			<td><select class="input" id="set_db_k_5" title="jenis_kelamin" dir="ltr" '.$view.'><option value="Laki - Laki">Laki - Laki</option><option value="Perempuan">Perempuan</option></select></td></tr>
			<tr><td>U I D</td><td> : </td>
			<td><label style="color:red;" id="set_db_k_6">'.$data['uid'].'</label></td>
			<td>Admin</td><td> : </td>
			<td><input class="input" id="set_db_k_7" value="'.$data['admin'].'" maxlength="3" size="2" '.$view.'\></td></tr>
			<td>Upload Picture</td><td> : </td>
			<td><input class="input" id="set_db_k_8" value="'.$data['uid'].'" '.$view.'\></td></tr>
			';
			
			$out = '<div><b><center>E M P L O Y E E</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table>
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVE('.$code_.')" class="button" href="#!"><b>&nbsp;SIMPAN&nbsp;</b></a></td><td><a onclick="javascript:HidePanel();" class="button" id="diff" href="#!"><b>BATAL</b></a></td></tr></table>
			</div>
			<script>
			function GoSAVE(v){  //1 add, 2 modif
			if(v==3){HidePanel();return false;}
				var xx = document.getElementById("set_db_k_1").value.length;
				if(xx<11){alert("NRP 11 Digit");return false;}
				var value = "";
				value = document.getElementById("set_db_k_1").value +"|"+document.getElementById("set_db_k_2bck").title+"|"+document.getElementById("set_db_k_2enc").title+"|";
				value = value +document.getElementById("set_db_k_3").value +"|"+document.getElementById("set_db_k_4").value +"|"+document.getElementById("set_db_k_5").value +"|";
				value = value+document.getElementById("set_db_k_6").title+"|"+ document.getElementById("set_db_k_7").value+"|";
				ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
				$.post("Ajax/database_db_k.php",{nrp: "'.$nrp.'", setpassword:setpassmhs, value : value, code:v}, function(data_) {
					alert(data_);
					search(\'db_k\');
					HidePanel();
				}); 
			}

			function setuid(v){
				if(v!=3){
				var pass = getNRP();
				$.post("Ajax/encryp.php",{code:"sha1md5", str:pass}, function(data) {
					document.getElementById("set_db_k_6").title = data;
					$("#set_db_k_6").html(document.getElementById("set_db_k_6").title);
				});
				}
			}
			function setpassword(v){
				if(v!=3){
				var pass = document.getElementById("set_db_k_2").value;
				$.post("Ajax/encryp.php",{code:"sha1md5", str:pass}, function(data) {
					document.getElementById("set_db_k_2enc").title = data;
					document.getElementById("set_db_k_2bck").title = pass;
					$("#set_db_k_2enc").html(document.getElementById("set_db_k_2enc").title);
					setpassmhs = true;
				});
				}
			}
			var setpassmhs = false;
			document.getElementById("set_db_k_2enc").title = "'.$data['password'].'";
			document.getElementById("set_db_k_5").value = "'.$data['jenis_kelamin'].'";
			if("'.$code_.'"=="1"){alert("Fill the Blank !");}
			function getNRP(){
				return document.getElementById("set_db_k_1").value;
			}
			function GoChangeNrpDepan(){
				document.getElementById("set_db_k_1a").title = document.getElementById("set_db_k_1d").value+""+document.getElementById("set_db_k_6_").title + ""+ document.getElementById("set_db_k_1c").value;
				$("#set_db_k_1a").html(document.getElementById("set_db_k_1a").title);
				setuid();
			}

			</script>
			';
			exit($out);
		break;
	}
}

?>

