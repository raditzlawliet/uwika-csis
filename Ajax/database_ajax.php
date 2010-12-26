<?php
session_start();
include 'transfer_.php';

$code = htmlentities($_POST['code']);
$search_text = htmlentities($_POST['search_text']);
$search_in = htmlentities($_POST['search_in']);
$sort_text = htmlentities($_POST['sort_text']);
$sort_by = htmlentities($_POST['sort_by']);
$color = htmlentities($_POST['color']);

switch($code){
	case 'db_h' : { //db awal
			$out = '';
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

