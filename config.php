<?php
session_start();

$host	= 'localhost';
$user	= 'root'; 
$pass	= '';				
$db_name= 'csisdb';

$nama_web = 'CSIS - Campus System Information Student';

$koneksi = mysql_connect($host, $user, $pass);
if($koneksi) {
	$db_open = mysql_select_db($db_name);
	if(!$db_open) {
		echo mysql_error();
	}
}

$sql = " SELECT `t_mahasiswa`.`kode`, `t_biodata`.*\n"
    . "FROM `t_biodata`\n"
    . " LEFT JOIN `pemrogaman_web`.`t_mahasiswa` ON `t_biodata`.`kode` = `t_mahasiswa`.`kode` \n"
    . " LIMIT 0, 30";
	
?>