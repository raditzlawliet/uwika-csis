<?php

include '../config.php';

$code = htmlentities($_POST['code']);

if($code=="refresh_sks"){
	$nrp = htmlentities($_POST['nrp']);
	$sks = getSKSMahasiswa($nrp);
	exit($sks);
}

function getSKSMahasiswa($nrp){
	$sql = "SELECT sisa_sks\n"
    . "FROM t_mahasiswa\n"
    . "WHERE nrp = '$nrp' LIMIT 0, 1";
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$data = $row['sisa_sks'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}

?>

