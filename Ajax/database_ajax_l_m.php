<?php
session_start();
include 'transfer_l_m.php';

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
$diff=htmlentities($_REQUEST['diff']);
$diff2=htmlentities($_REQUEST['diff2']);

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
	case 'db_l_m' : {
		if($ab=="1"){
			$abc = getLastSemester($search_text);
			$search2x[0]['q']=1;
			$search2x[0]['c']="AND";
			$search2x[0]['s']="semester";
			$search2x[0]['o']="=";
			$search2x[0]['v']=$abc;
			if($diff=="1"){
				$search2x[0]['q']=1;
				$search2x[0]['c']="AND";
				$search2x[0]['s']="semester";
				$search2x[0]['o']="=";
				$search2x[0]['v']=$diff2;
				exit(getTabelDatabaseListMataKuliahPerMahasiswaS($search_text,$search_in,$sort_text,$sort_by,$color,$start,$limit,$show,$search2x,$ab));
			}
		}
		exit(getTabelDatabaseListMataKuliahPerMahasiswa($search_text,$search_in,$sort_text,$sort_by,$color,$start,$limit,$show,$search2x,$ab));
		break;
	}
}
?>