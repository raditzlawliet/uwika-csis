<?php
include_once 'auth.php';

function check_session ($kode,$kode_pengaman,$username){
	$data_session = getDataSession($kode);
	$return = false;
	if (md5($data_session[1]) == $kode_pengaman){
		if (md5($data_session[2]) == $username){
			$return = true;
		}
	}
	return $return;
}?>