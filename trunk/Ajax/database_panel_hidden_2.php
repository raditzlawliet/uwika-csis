<?php
include '../config.php';
include 'calc.php';
function getValueSettingsOf($sets){
		$sql = "SELECT *\n"
		. "FROM settings WHERE `settings`.`settings` = '$sets'";
		$rs = mysql_query($sql);
		$data;
		while($row = mysql_fetch_array($rs)){
			$data = $row['value'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		return $data;
}
function getLastSMS($nrp){
	$t_thn = getValueSettingsOf('tahun');
	$t_sms = getValueSettingsOf('semester');
	$i = substr($nrp,3,2);
	$i=$i+0; $thn;
	if($i<10)$thn = "0";
	else $thn = "";
	if($i>=45)$thn = "19".$thn."".$i;
	else $thn = "20".$thn."".$i;
	$thn=$thn+0;$t_thn=$t_thn+0;$t_sms=$t_sms+0;
	$sms=((($t_thn-$thn)*2)+$t_sms);
	return "".$sms;
}

$code = htmlentities($_POST['code']);
$nrp = htmlentities($_POST['nrp']);

switch($code){
	case 'sms' : {
		exit(getLastSMS($nrp));
		break;
	}
	case 'ipk' : {
		exit(getLastSMS($nrp));
		break;
	}
}
	
?>
