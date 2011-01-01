<?php
include_once 'auth.php';

function check_session($nrp,$uid,$turn){
	$data_session = getDataSession($uid,$turn);
	$return = false;
	if (sha1(md5($data_session[0])) == $nrp){
		$return = true;
	}
	return $return;
}?>