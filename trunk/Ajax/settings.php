<?php
session_start();
include 'transfer.php';

$code = htmlentities($_POST['code']);
$value = htmlentities($_POST['value']);

switch($code){
	case 'save_settings_admin' : {
			$n = array(0=>'semester_ganjil_mulai',
					   1=>'semester_ganjil_selesai',
					   2=>'semester_genap_mulai',
					   3=>'semester_genap_selesai',
					   
					   4=>'tanggal_krs_semester_ganjil_mulai',
					   5=>'tanggal_krs_semester_ganjil_selesai',
					   6=>'tanggal_krs_semester_genap_mulai',
					   7=>'tanggal_krs_semester_genap_selesai',
					   8=>'jatah_hari_krs',
					   9=>'jatah_bulan_semester',
					   
					   10=>'semester',
					   11=>'semester_awal',
					   12=>'semester_akhir',
					   13=>'tanggal_krs_mulai',
					   14=>'tanggal_krs_selesai',
					   15=>'tahun',

					   16=>'konfigurasi_manual',
					   17=>'semester_ganjil',
					   18=>'semester_genap'
					 );
			$i=0;
			$data = explode("|",$value);
			do{
				setSettings($n[$i],$data[$i]);
				$i++;
			}while($i!=19);
			$message = "Save Settings Sukses";
			exit($message);
		break;
	}
}
?>