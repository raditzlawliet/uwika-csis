<?php
session_start();
include 'transfer_sc.php';

$code = htmlentities($_POST['code']);
$search_text = htmlentities($_POST['search_text']);
$search_in = htmlentities($_POST['search_in']);
$sort_text = htmlentities($_POST['sort_text']);
$sort_by = htmlentities($_POST['sort_by']);
$color = htmlentities($_POST['color']);
$page=htmlentities($_REQUEST['page']);

$start = ($page-1)*30;

switch($code){
	case 'db_sc' : { //db dosen
			exit(getTabelDatabaseIPS($search_text,$search_in,$sort_text,$sort_by,$color,$start));
		break;
	}
	case 'db_sc2' : { //db dosen
			exit(getTabelDatabaseNilai($search_text,$search_in,$sort_text,$sort_by,$color,$start));
		break;
	}
}
?>

