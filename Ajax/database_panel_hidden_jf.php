<?php
include 'transfer_jf.php';

$code = htmlentities($_POST['code_hidden']);
$code_ = htmlentities($_POST['code_edit']);
$nrp = htmlentities($_POST['nrp']);

switch($code){
	case 'db_jf' : { //db awal
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
			$data = getDataDatabaseJurusan($nrp);

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
			'<tr><td width="15%">Programs Code</td><td width="2%"> : </td>			
			<td><input class="input" id="set_db_j_1" value="'.$data['kode_jurusan'].'"maxlength="3" size="3" '.$view.'\></td>
			<tr><td>Programs Name</td><td> : </td>
			<td><input class="input" id="set_db_j_2" value="'.$data['nama_jurusan'].'"maxlength="49" size="30" '.$view.'\></td>
			<tr><td>Faculty</td><td> : </td>
			<td><select class="input" onchange="javascript:GoChangeLabelKodeFakultasV(this)" id="set_db_j_3" title="fakultas" dir="ltr" '.$view.'><option value=""></option>'.$opt_fakultas.'</select>&nbsp;&frasl;&nbsp;<label id="set_db_j_3a">'.$data['kode_fakultas'].'</label></td>
			<tr><td>Subject Code</td><td> : </td>
			<td><input class="input" id="set_db_j_4" value="'.$data['kode_depan_mata_kuliah'].'"maxlength="2" size="3" '.$view.'\></td>
			';
			
			$out = '<div><b><center>P R O G R A M S</center></b>
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
				var value = "";
				value = document.getElementById("set_db_j_1").value +"|"+document.getElementById("set_db_j_2").value +"|"+document.getElementById("set_db_j_3").value+"|"+document.getElementById("set_db_j_4").value+"|";
				ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
				$.post("Ajax/database_db_jf.php",{nrp: "'.$nrp.'", value:value, code:v}, function(data_) {
					alert(data_);
					search(\'db_jf\');
					HidePanel();
				}); 
			}

			document.getElementById("set_db_j_3").value = "'.$data['kode_fakultas'].'";
			if("'.$code_.'"=="1"){alert("Fill the Blank !");}else{
			GoChangeLabelKodeFakultas("'.$data['kode_fakultas'].'");
			}
			function GoChangeLabelKodeFakultasV(slct){
				GoChangeLabelKodeFakultas(slct.value);
			}
			function GoChangeLabelKodeFakultas(slct){
				document.getElementById("set_db_j_3a").title = slct;
				$("#set_db_j_3a").html(document.getElementById("set_db_j_3a").title);
			}
			if('.$code_.'==1){document.getElementById("set_db_j_3").value = "FE";
			GoChangeLabelKodeFakultas("FE");
			}

			</script>
			';
			exit($out);
		break;
	}

	case 'db_jf2' : { //db awal
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
			$data = getDataDatabaseFakultas($nrp);

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
			'<tr><td width="15%">Faculty Code</td><td width="2%"> : </td>			
			<td><input class="input" id="set_db_j_1" value="'.$data['kode_fakultas'].'"maxlength="3" size="3" '.$view.'\></td>
			<tr><td>Faculty Name</td><td> : </td>
			<td><input class="input" id="set_db_j_2" value="'.$data['nama_fakultas'].'"maxlength="49" size="30" '.$view.'\></td>
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
				var value = "";
				value = document.getElementById("set_db_j_1").value +"|"+document.getElementById("set_db_j_2").value +"|";
				ShowHiddenPanel(true,\'loading\',\'Ajax/n.php\',\'.main_panel\');
				$.post("Ajax/database_db_jf.php",{nrp: "'.$nrp.'", value:value, code:2+""+v}, function(data_) {
					alert(data_);
					search(\'db_jf2\');
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

