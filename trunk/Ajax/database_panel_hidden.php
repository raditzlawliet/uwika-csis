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
				break;}
			case 2:{ //modify
				break;}
			case 3:{ //view
				break;}
			case 4:{ //delete
				break;}
		}
			$set_height = "250";
			if(isset($_COOKIE['set_height_mk_list'])){
				$set_height = $_COOKIE['set_height_mk_list'];
			}
			$table = $table.
			'	<tr><td style="text-transform:capitalize;" width="15%">'.$settings[$n[$i]]['settings'].'</td><td width="2%"> : </td>
				<td><input id="set_admin_'.$i.'" value="'.$settings[$n[$i]]['value'].'" size="10"\></td>
				<td style="font-size:10px;">'.$settings[$n[$i]]['deskripsi'].'</td></tr>
				<tr><td style="text-transform:capitalize;" width="15%">'.$settings[$n[$i]]['settings'].'</td><td width="2%"> : </td>
				<td><input onclick="javascript:GoClickManual(this.checked);" id="set_admin_'.$i.'" type="checkbox" value="'.$manual.'" '.$check.' /></td>
				<td style="font-size:10px;">'.$settings[$n[$i]]['deskripsi'].'</td></tr>';
			
			$out = '<div><b><center>S T U D E N T</center></b>
			<div style="border:1px solid #ccc;border-top:none;overflow:auto; height:'.$set_height.'px;">
			<table style="background:#FFE1E2;padding-top:5px;padding-right:5px;padding-left:5px;width:100%;border:1px solid #ccc;border-bottom:none;">
			'.$table.'
			</table>
			</div>
			<p><table style="float:right;"><tr><td><a onclick="javascript:GoSAVESETTINGS()" class="button" href="#!"><b>SAVE SETTINGS</b></a></td><td><a onclick="javascript:CancelClick();" class="button" id="diff" href="#!"><b>CANCEL</b></a></td></tr></table>
			</div>
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

