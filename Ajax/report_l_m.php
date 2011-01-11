<?php
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
$all=htmlentities($_REQUEST['all']);

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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
		847a3654ac83afc8878c21550977b1a2 (Do not remove this code)
        This website has created by Radityo Hernanda, Bobby Handoko, Evan Sutrisno and Ferry Naga. Copyright 2010.
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Campus System Information Student</title>
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js"></script>-->
<link href="../index.css" rel="stylesheet" type="text/css" />
<link href="../main.css" rel="stylesheet" type="text/css" />
<link href="../panel.css" rel="stylesheet" type="text/css" />
<link href="../header.css" rel="stylesheet" type="text/css" />
<link href="../footer.css" rel="stylesheet" type="text/css" />
<link href="../sidebar_panel.css" rel="stylesheet" type="text/css" />
<link href="../footer_panel.css" rel="stylesheet" type="text/css" />
<link href="../header_panel.css" rel="stylesheet" type="text/css" />
<link href="../images.css" rel="stylesheet" type="text/css" /><!--[if IE 5]>

<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
.twoColFixLtHdr #sidebar1 { width: 230px; }
</style>
<![endif]--><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColFixLtHdr #sidebar1 { padding-top: 30px; }
.twoColFixLtHdr #mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->

</head>
<body>
        <p>
        <div style="padding-left:20px;">
	<div id="container_space" style="padding:0;margin:0;left:100px;text-align:left;">
    	<div id="main" style="width:100%;"><center>
<?php
switch($code){
	case 'db_l_m' : { //db mahasiswa
		if($all!="all"){
			if($ab=="1"){
				$a = "<center><h1>K H S</h1></center>";
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
					$a=$a.getTabelDatabaseListMataKuliahPerMahasiswaS($search_text,$search_in,$sort_text,$sort_by,$color,$start,$limit,$show,$search2x,$ab);
					exit($a);
				}
				$a = $a.getTabelDatabaseListMataKuliahPerMahasiswa($search_text,$search_in,$sort_text,$sort_by,$color,$start,$limit,$show,$search2x,$ab);
				exit($a);
			}
			if($ab=="2"){
				$a = "<center><h1>K R S</h1></center>";
				$a = $a.getTabelDatabaseListMataKuliahPerMahasiswa($search_text,$search_in,$sort_text,$sort_by,$color,$start,$limit,$show,$search2x,$ab);
				exit($a);
			}
			if($ab=="0"){
				$a = "<center><h1>LAPORAN MAHASISWA</h1></center>";
				$a = $a.getTabelDatabaseListMataKuliahPerMahasiswa($search_text,$search_in,$sort_text,$sort_by,$color,$start,$limit,$show,$search2x,$ab);
				exit($a);
			}
			break;
		}else{
			$data = getAllDataMahasiswa();
			for($i=0;$i<$data['k'];$i++){
			if($ab=="1"){
				$zxc = $zxc."<center><h1>K H S</h1></center>";
			}
			if($ab=="2"){
				$zxc = $zxc."<center><h1>K R S</h1></center>";
			}
			if($ab=="0"){
				$zxc = $zxc."<center><h1>LAPORAN MAHASISWA</h1></center>";
			}
				$zxc=$zxc."<p>".getTabelDatabaseListMataKuliahPerMahasiswa($data[$i],$search_in,$sort_text,$sort_by,$color,$start,$limit,$show,$search2x,$ab);
			}
			exit($zxc);
		}
	}
}
?>
</center></div>
        </div>
	</div>
</body>
</html>