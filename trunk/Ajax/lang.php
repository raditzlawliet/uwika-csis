<?php

function getWord($bahasa,$key){
	$en = array("pilihan_bahasa"=>"English - Indonesian","nama_web"=>"Hopfluf - A Creative Imagine Production");
	
	$id = array("pilihan_bahasa"=>"Inggris - Bahasa Indonesia","nama_web"=>"Hopfluf - A Creative Imagine Production");
	
	switch($bahasa){
		case 1: //indonesia
			return $id[$key];
			break;
		default: //default e english ws...
			return $en[$key];
	}
}

?>