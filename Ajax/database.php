<?php
session_start();
include 'transfer_.php';

$code = htmlentities($_POST['code']);
$uid = htmlentities($_POST['uid']);
$admin = htmlentities($_POST['admin']);

switch($code){
	case 'db_admin' : { //db awal
			$out = '
				<center><h1 style="letter-spacing:20px;"><b>DATABASE</b></h1><p>
				<div id="db">
					<div id="db_menu">
					<ul>
						<a id="db_h" onclick="javascript:GoHELL(\'db_h\');" href="#!">HOME</a>
						<a id="db_m" onclick="javascript:GoHELL(\'db_m\');" href="#!">STUDENT</a>
						<a id="db_d" onclick="javascript:GoHELL(\'db_d\');" href="#!">FACULTY</a>
						<a id="db_k" onclick="javascript:GoHELL(\'db_k\');" href="#!">EMPLOYEE</a>
						<a id="db_mk" onclick="javascript:GoHELL(\'db_mk\');" href="#!">MATA KULIAH</a>
						<a id="db_sc" onclick="javascript:GoHELL(\'db_sc\');" href="#!">SCORE</a>
						<a id="db_jf" onclick="javascript:GoHELL(\'db_jf\');" href="#!">JURUSAN & FAKULTAS</a>
					</ul>
					</div>
					<h1 style="margin-bottom:27px;"></h1>
					<div id="db_main">
					</div>
				</div>
				</center>
				
				<script>
				GoHELL("db_h");
				function GoHELL(ids){
					var doku = new Array("db_h","db_m","db_d","db_k","db_mk","db_sc","db_jf");
					for(var i = 0;i<7;i++){
						document.getElementById(doku[i]).className = "";
					}
					document.getElementById(ids).className = "active";
					$("#db_main").html("");
					$.post("Ajax/database_panel.php",{code:ids, uid:"'.$uid.'", admin:"'.$admin.'"}, function(data) {
						$("#db_main").html("");
						$("#db_main").html(data);
					}); 
					
				}
				</script>
				';
			exit($out);
		break;
	}
}

?>

