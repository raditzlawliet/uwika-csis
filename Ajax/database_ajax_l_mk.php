<?php
session_start();
include 'transfer_l_mk.php';

$code = htmlentities($_POST['code']);
$search_text = htmlentities($_POST['search_text']);
$search_in = htmlentities($_POST['search_in']);
$sort_text = htmlentities($_POST['sort_text']);
$sort_by = htmlentities($_POST['sort_by']);
$color = htmlentities($_POST['color']);
$page=htmlentities($_REQUEST['page']);
$limit=htmlentities($_REQUEST['limit']);
$show=htmlentities($_REQUEST['show']);
$search2=htmlentities($_REQUEST['search2']);
$sx=htmlentities($_REQUEST['sx']);
$ad=htmlentities($_REQUEST['ad']);
$ab=htmlentities($_REQUEST['ab']);
$start = ($page-1)*30;
$show = explode("|",$show);
$x = explode("|",$search2);
if($ad=="1"){
	$search2x[0]['q']=1;
	$search2x[0]['c']=$x[3];
	$search2x[0]['s']=$x[1];
	$search2x[0]['o']=$x[2];
	$search2x[0]['v']=$x[0];
}

switch($code){
	case 'db_l_mk' : { //db dosen
			exit(getTabelDatabaseListMahasiswaPerMataKuliah($search_text,$search_in,$sort_text,$sort_by,$color,$start,$limit,$show,$search2x,$ab));
		break;
	}
}
?>

