<?php
session_start();
include 'transfer_k.php';

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
	case 'db_k' : { //db dosen
			exit(getTabelDatabaseKaryawan($search_text,$search_in,$sort_text,$sort_by,$color,$start));
		break;
	}
}
?>

