<?php
session_start();
include 'transfer_.php';

$code = htmlentities($_POST['code']);
$search_text = htmlentities($_POST['search_text']);
$search_in = htmlentities($_POST['search_in']);
$sort_text = htmlentities($_POST['sort_text']);
$sort_by = htmlentities($_POST['sort_by']);
$color = htmlentities($_POST['color']);
$page=htmlentities($_REQUEST['page']);

$start = ($page-1)*30;

switch($code){
	case 'db_h' : { //db awal
			$out = '';
			exit($out);
		break;
	}
	case 'db_m' : { //db mahasiswa
			exit(getTabelDatabaseMahasiswa($search_text,$search_in,$sort_text,$sort_by,$color,$start));
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
}
?>

