<?php

include '../config.php';

$code = htmlentities($_POST['code']);

if($code=="refresh_sks"){
	$nrp = htmlentities($_POST['nrp']);
	$sks = getSKSMahasiswa($nrp);
	exit($sks[0].' - '.$sks[1]);
}

function getSKSMahasiswa($nrp){
	$sql = "SELECT sks_awal,sisa_sks\n"
    . "FROM t_mahasiswa\n"
    . "WHERE nrp = '$nrp' LIMIT 0, 1";
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$data[0] = $row['sks_awal'];
				$data[1] = $row['sisa_sks'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}

?>

