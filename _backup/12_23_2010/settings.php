<?php
session_start();
$host	= 'localhost';
$user	= 'root'; 
$pass	= '';				
$db_name= 'CSISdb';

$nama_web = 'CSIS - Campus Students Information System';

$koneksi = mysql_connect($host, $user, $pass);
if($koneksi){
	$dbopen = mysql_select_db($db_name);
	if(!$db_open){
		echo mysql_error();
	}
}
?>