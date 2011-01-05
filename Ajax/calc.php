<?php
function getMasa($tahun,$semester){
			if($semester%2==0){
				$sms = 2;
			}else{
				$sms = 1;
			}
			$masa = $tahun."/".$sms;
			return $masa;
}
function getAngkatanFromNrp($nrp){
				$thn = substr($nrp,3,2);
				if($thn>=45)$thn = "19".$thn;
				else $thn = "20".$thn;
				$akt = $thn;
				return $akt;
}
function getHari($hari_num){
	$hari = array(0=>"Minggu",1=>"Senin",2=>"Selasa",3=>"Rabu",4=>"Kamis",5=>"Jum'at",6=>"Sabtu",7=>"Minggu");
//	$hari = array(0=>"Sunday",1=>"Monday",2=>"Tuesday",3=>"Wednesday",4=>"Thrusday",5=>"Friday",6=>"Saturday",7=>"Sunday");
	return $hari[$hari_num];
}
?>