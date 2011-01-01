<?php
session_start();
include 'transfer_mk2.php';

$code = htmlentities($_POST['code']);
$search_text = htmlentities($_POST['search_text']);
$search_in = htmlentities($_POST['search_in']);
$sort_text = htmlentities($_POST['sort_text']);
$sort_by = htmlentities($_POST['sort_by']);
$color = htmlentities($_POST['color']);
$page=htmlentities($_REQUEST['page']);

$start = ($page-1)*30;

switch($code){
	case 'db_mk' : { //db mata kul
			exit(getTabelDatabaseMataKuliah($search_text,$search_in,$sort_text,$sort_by,$color,$start));
		break;
	}
	case 'db_mk_d' : { //db mata kul
			exit(getTabelDatabaseMataKuliah_Dosen($search_text,$search_in,$sort_text,$sort_by,$color,$start));
		break;
	}
	case 'db_mk_j' : { //db mata kul
			exit(getTabelDatabaseMataKuliah_Jurusan($search_text,$search_in,$sort_text,$sort_by,$color,$start));
		break;
	}
	case 'db_mk_m' : { //db mata kul
			exit(getTabelDatabaseMataKuliah_Mahasiswa($search_text,$search_in,$sort_text,$sort_by,$color,$start));
		break;
	}
	case 'db_mk_s' : { //db mata kul
			exit(getTabelDatabaseMataKuliah_Syarat($search_text,$search_in,$sort_text,$sort_by,$color,$start));
		break;
	}
}

