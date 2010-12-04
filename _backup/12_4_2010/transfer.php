<?php
session_start();
include_once 'config.php';
include_once 'auth.php';
include_once 'session.php';

function getBiodataHome($kode,$kode_pengaman){
	if(!isset($_SESSION['kode'],$_SESSION['kode_pengaman'],$_SESSION['username'])){
		echo "<meta http-equiv=\"refresh\" content=\"0;url=login.php\" />";
	}else{
		if (!check_session($_SESSION['kode'],$_SESSION['kode_pengaman'],$_SESSION['username'])){
			session_destroy();
			echo "<meta http-equiv=\"refresh\" content=\"0;url=login.php\" />";
		}else{
			$sql = "SELECT * FROM t_biodata,t_mahasiswa WHERE t_mahasiswa.kode=".$kode." AND t_biodata.kode = t_mahasiswa.kode ";
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$data_biodata_h = array("nama_depan"=>$row['nama_depan'],"nama_tengah"=>$row['nama_tengah'],"nama_belakang"=>$row['nama_belakang']);
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data_biodata_h;
		}
	}
}

function getBiodataSuggest($kode){
			$sql = "SELECT * FROM t_biodata,t_mahasiswa WHERE t_mahasiswa.kode=".$kode." AND t_biodata.kode = t_mahasiswa.kode ";
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$data_biodata_ss[0] = $row['nama_depan'];
				$data_biodata_ss[1] = $row['nama_belakang'];
				$data_biodata_ss[2] = $row['nama_tengah'];
				$data_biodata_ss[3] = $row['pesan_profile'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data_biodata_ss;
}

function getBiodataProfile($kode,$kode_pengaman){
	if(!isset($_SESSION['kode'],$_SESSION['kode_pengaman'],$_SESSION['username'])){
		echo "<meta http-equiv=\"refresh\" content=\"0;url=login.php\" />";
	}else{
		if (!check_session($_SESSION['kode'],$_SESSION['kode_pengaman'],$_SESSION['username'])){
			session_destroy();
			echo "<meta http-equiv=\"refresh\" content=\"0;url=login.php\" />";
		}else{
			$sql = "SELECT * FROM t_biodata,t_mahasiswa WHERE t_mahasiswa.kode=".$kode." AND t_biodata.kode = t_mahasiswa.kode ";
/*			$sql = " SELECT `t_mahasiswa`.`kode`, `t_biodata`.*\n"
				. " FROM `t_biodata`\n"
				. " WHERE `t_biodata`.`kode`='$kode'\n"
				. " LEFT JOIN `pemrogaman_web`.`t_mahasiswa` ON `t_biodata`.`kode` = `t_mahasiswa`.`kode` \n"
				. " LIMIT 0, 30"; */
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$data_biodata_p = array("nama_depan"=>$row['nama_depan'],"nama_tengah"=>$row['nama_tengah'],"nama_belakang"=>$row['nama_belakang'],"jenis_kelamin"=>$row['jenis_kelamin'],"alamat"=>$row['alamat'],"kota"=>$row['kota'],"provinsi"=>$row['provinsi'],"negara"=>$row['negara'],"pesan_profile"=>$row['pesan_profile']);
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data_biodata_p;
		}
	}
}

function getBiodataProfilefromKode($kode){
			$sql = "SELECT * FROM t_biodata,t_mahasiswa WHERE t_mahasiswa.kode=".$kode." AND t_biodata.kode = t_mahasiswa.kode ";
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$data_biodata_p = array("nama_depan"=>$row['nama_depan'],"nama_tengah"=>$row['nama_tengah'],"nama_belakang"=>$row['nama_belakang'],"jenis_kelamin"=>$row['jenis_kelamin'],"alamat"=>$row['alamat'],"kota"=>$row['kota'],"provinsi"=>$row['provinsi'],"negara"=>$row['negara'],"pesan_profile"=>$row['pesan_profile']);
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data_biodata_p;
}

function getNewPeople(){
			$sql = "SELECT t_biodata.* FROM t_mahasiswa,t_biodata WHERE t_mahasiswa.kode = t_biodata.kode ORDER BY t_biodata.kode DESC LIMIT 0,5";
			$rs = mysql_query($sql);
			$tempx = 0;
			while($row = mysql_fetch_array($rs)){
				$data_kode_baru[$tempx] = $row['kode'];
				$tempx++;
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data_kode_baru;
}
function getFriend($kode){
			$sql = "SELECT t_friend.* FROM t_mahasiswa,t_friend WHERE t_mahasiswa.kode='$kode' AND t_mahasiswa.kode = t_friend.kode ";
			$rs = mysql_query($sql);
			$temp = 1;
			while($row = mysql_fetch_array($rs)){
				$data_teman[$temp] = $row['kode_teman'];
				$temp++;
			}
			$data_teman[0] = $temp-1;
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data_teman;
}
function getKodefromUsername($username){
			$sql = "SELECT t_mahasiswa.* FROM t_mahasiswa WHERE t_mahasiswa.username= '$username'";
			$rs = mysql_query($sql);
			$returndata;
			while($row = mysql_fetch_array($rs)){
				$returndata = $row['kode'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $returndata;
}

function addPeople($data){
	$sql = "INSERT INTO t_mahasiswa (`kode`, `kode_pengaman`, `username`, `password`) VALUES ( '' , '$data[1]', '$data[2]', '$data[3]')";
if (!mysql_query($sql))
  {
  die('Error: ' . mysql_error());
  }	
  $tempkode = getKodefromUsername($data[2]);
	$sql2 = "INSERT INTO `t_biodata` (`kode`, `nrp`, `nama_depan`, `nama_tengah`, `nama_belakang`, `jenis_kelamin`, `alamat`, `kota`, `provinsi`, `negara`, `pesan_profile`) VALUES ('$tempkode', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$data[12]', '$data[13]')";
if (!mysql_query($sql2))
  {
  die('Error: ' . mysql_error());
  }	
		echo "<meta http-equiv=\"refresh\" content=\"0;url=login.php\" />";

}
?>