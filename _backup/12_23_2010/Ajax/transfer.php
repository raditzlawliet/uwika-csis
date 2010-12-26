<?php
session_start();
include '../config.php';
include '../auth.php';
include '../session.php';

function addStudentRegisteredMataKuliah($kode_mk,$nrp,$masa,$sks){
			$sms = getDataMahasiswa("semester",$nrp);
			$d = date(w);
			$tgl = date(Y)."-".date(m)."-".date(d);
			$time = date(h).":".date(i).":".date(s);
			$sql = "INSERT INTO `csisdb`.`tr_mata_kuliah_mahasiswa` (`kode_mata_kuliah`, `nrp`, `semester`, `masa`, `hari_register`, `time_register`, `tanggal_register`) VALUES ('$kode_mk','$nrp', '$sms', '$masa', '$d', '$time' , '$tgl');";
			if (!mysql_query($sql))
			  {		
				  die('Error: ' . mysql_error().'');
			  }
//			$sks_m = getSKSMahasiswa($nrp);
//			$sks_mk = getSKSMataKuliah($kode_mk);
//			$sks = $sks_m - $sks_mk;
			unset($sql);
			$sql = "UPDATE `t_mahasiswa` SET `sisa_sks` = '$sks' WHERE `t_mahasiswa`.`nrp` = '$nrp';";
			if (!mysql_query($sql))
			  {		
				  die('Error: ' . mysql_error().'');
			  }
			unset($sql);
}

function removeStudentRegisteredMataKuliah($kode_mk,$nrp,$masa){
			$sql = "DELETE FROM `tr_mata_kuliah_mahasiswa` WHERE `tr_mata_kuliah_mahasiswa`.`kode_mata_kuliah` = '$kode_mk' AND `tr_mata_kuliah_mahasiswa`.`nrp` = '$nrp' AND `tr_mata_kuliah_mahasiswa`.`masa` = '$masa'";
			if (!mysql_query($sql))
			  {		
				  die('Error: ' . mysql_error().'');
			  }
			$sks_m = getSKSMahasiswa($nrp);
			$sks_mk = getSKSMataKuliah($kode_mk);
			$sks = $sks_m + $sks_mk;
			$sql = "UPDATE `t_mahasiswa` SET `sisa_sks` = '$sks' WHERE `t_mahasiswa`.`nrp` = '$nrp';";
			if (!mysql_query($sql))
			  {		
				  die('Error: ' . mysql_error().'');
			  }
			unset($sql);
}

function getSKSMataKuliah($kode_mk){
			$sql = "SELECT jumlah_sks FROM `t_mata_kuliah` \n"
			. "WHERE kode_mata_kuliah = '$kode_mk'";
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$data = $row['jumlah_sks'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}
function getDataMahasiswa($datas,$nrp){
			$sql = "SELECT '$datas'\n"
			. "FROM t_mahasiswa\n"
			. "WHERE nrp = '$nrp' LIMIT 0, 1";
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$data = $row[$datas];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
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
function getStudentIsRegisteredMataKuliah($kode_mk,$nrp){
			$sql = "SELECT mkm.nrp, mkm.masa\n"
			. "FROM tr_mata_kuliah_mahasiswa as mkm where mkm.kode_mata_kuliah = '$kode_mk' and mkm.nrp = '$nrp'";
			$rs = mysql_query($sql);
			$data['ada'] = false;
			while($row = mysql_fetch_array($rs)){
				$data['ada'] = true;
				$data['nrp'] = $row['nrp'];
				$data['masa'] = $row['masa'];
				$tmp = explode("/",$data['masa']);
				$data['tahun'] = $tmp[0];
				$data['semester'] = $tmp[1];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
	
}
function getMasa($tahun,$semester){
			if($semester%2==0){
				$sms = 2;
			}else{
				$sms = 1;
			}
			$masa = $tahun."/".$sms;
			return $masa;
}
function getListStudentRegisteredMataKuliah($kode_mk,$tahun,$semester){
			$masa = getMasa($tahun,$semester);
			$sql = "SELECT mkm.kode_mata_kuliah, m.nrp, m.nama, mkm.hari_register,mkm.time_register,m.kode_jurusan,m.semester\n"
			. "FROM tr_mata_kuliah_mahasiswa as mkm \n"
			. "JOIN t_mahasiswa as m ON mkm.nrp = m.nrp \n"
			. "where kode_mata_kuliah = '$kode_mk' AND masa = '$masa'\n"
			. "order by mkm.hari_register DESC, mkm.time_register DESC";
			$rs = mysql_query($sql);
			$mk = "";
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
//<tr><td id="center">31109036</td><td width="40%">Radityo</td><td>Selasa, 10:10:23</td><td>Teknik - Informatika</td><td id="center">3 - 2009</td></tr>
//<tr id="diff"><td id="center">61109036</td><td>Radityo Hernanda</td><td>Rabu, 19:10:23</td><td>Ekonomi - Management</td><td id="center">3 - 2009</td></tr>
				$nrp = $row['nrp'];
				$mk = $mk
				.'<tr '.$tr.'onclick="javascript:GoKRS_PROFILESTUDENT(\''.$nrp.'\');">
				<td id="center">'.$nrp.'</td>
				<td width="40%">'.$row['nama'].'</td>
				<td>'.getHari($row['hari_register']).', '.$row['time_register'].'</td>';
				$fj = getFakultasJurusan($row['kode_jurusan']);
				$mk = $mk
				.'<td>'.$fj['nama_fakultas'].' - '.$fj['nama_jurusan'].'</td>
				<td id="center">'.$row['semester'].' - '.getAngkatanFromNrp($nrp).'</td>'
				.'</a></tr>';
				$k++;
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}
function getAngkatanFromNrp($nrp){
				$thn = substr($nrp,3,2);
				if($thn>=45)$thn = "19".$thn;
				else $thn = "20".$thn;
				$akt = $thn;
				return $akt;
}
function getMataKuliah($kode_mata_kuliah){
		$sql = "SELECT *\n"
		. "FROM t_mata_kuliah AS mk\n"
		. "WHERE mk.kode_mata_kuliah = '$kode_mata_kuliah'\n";
		$rs = mysql_query($sql);
		$data;
		while($row = mysql_fetch_array($rs)){
			$data['kode_mata_kuliah'] = $row['kode_mata_kuliah'];
			$data['nama_mata_kuliah'] = $row['nama_mata_kuliah'];
			$data['jumlah_sks'] = $row['jumlah_sks'];
			$data['probis'] = $row['probis'];
			$data['hari'] = $row['hari'];
			$data['jam_mulai'] = $row['jam_mulai'];
			$data['jam_selesai'] = $row['jam_selesai'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		$kode_fakultas = $data['kode_fakultas'];
		$sql = "SELECT d.nrp,d.nama\n"
		. "FROM t_mata_kuliah AS mk\n"
		. "JOIN tr_mata_kuliah_dosen AS mkd join t_dosen as d ON mk.kode_mata_kuliah = mkd.kode_mata_kuliah AND d.nrp = mkd.nrp\n"
		. "WHERE mk.kode_mata_kuliah = '$kode_mata_kuliah'";
		$rs = mysql_query($sql);
		$data['nrp'] = 'Secret';
		$data['nama'] = 'Secret';
		while($row = mysql_fetch_array($rs)){
			$data['nrp'] = $row['nrp'];
			$data['nama'] = $row['nama'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		return $data;

}

function getListMataKuliahPerSemester($kode_jurusan,$sms,$probis){
			$sql = "SELECT *\n"
			. "FROM t_mata_kuliah AS mk\n"
			. "JOIN tr_mata_kuliah_jurusan AS mkj\n"
			. "ON mk.kode_mata_kuliah = mkj.kode_mata_kuliah\n"
			. "WHERE probis = '$probis' AND kode_jurusan = '$kode_jurusan' AND semester = '$sms'\n"
			. "ORDER BY hari";
			$rs = mysql_query($sql);
			$mk = '<table id="mk">
			<tr id="header_table"><th>Kode</th><th>Nama Mata Kuliah</th><th>Hari</th><th>Jam Mulai</th><th>Jam Selesai</th></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$mk = $mk
				.'<tr '.$tr.'onclick="javascript:GoDAFTARKRSMK(\''.$row['kode_mata_kuliah'].'\',\''.$_SESSION['uid'].'\');"><td id="center"><b>'
				.$row['kode_mata_kuliah'].'</b></td><td id="nama_mat_kul"><b>'
				.$row['nama_mata_kuliah'].'</b></td><td id="center">'
				.getHari($row['hari']).'</td><td id="center">'
				/*.$row['kode_jurusan'].*/
				.$row['jam_mulai'].'</td><td id="center">'
				/*.$row['semester'].*/
				.$row['jam_selesai'].'</td>'
				.'</a></tr>';
				$k++;
			}
			$mk = $mk.'</table>';
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}
function setSettings($set,$value){
		$sql = "UPDATE `settings` SET `value` = '$value' WHERE `settings`.`settings` = '$set' ;";
		mysql_query($sql);
		if (!mysql_query($sql))
		  {		
			  die('Error: ' . mysql_error().'');
		  }
}
function getSettings(){
		$sql = "SELECT *\n"
		. "FROM settings";
		$rs = mysql_query($sql);
		$data;
		while($row = mysql_fetch_array($rs)){
			$tmp = $row['settings'];
			$data[$tmp]['settings'] = $tmp;
			$data[$tmp]['value'] = $row['value'];
			$data[$tmp]['deskripsi'] = $row['deskripsi'];
			$data[$tmp]['manual'] = $row['manual'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		return $data;
}

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
function getProfile($uid,$turn){
		$sql = array("SELECT * FROM t_mahasiswa WHERE uid='$uid'",
					 "SELECT * FROM t_dosen WHERE uid='$uid'",
					 "SELECT * FROM t_karyawan WHERE uid='$uid'");
		$rs = mysql_query($sql[$turn]);
		$data_profile;
		while($row = mysql_fetch_array($rs)){
			$data_profile['uid'] = $row['uid'];
			$data_profile['nrp'] = $row['nrp'];
			$data_profile['nama'] = $row['nama'];
			$data_profile['kode_jurusan'] = $row['kode_jurusan'];
			$data_profile['semester']= $row['semester'];
			$data_profile['sisa_sks']= $row['sisa_sks'];
			$data_profile['probis']= $row['probis'];
			$data_jurusan = getFakultasJurusan($data_profile['kode_jurusan']);
			$data_profile['nama_fakultas'] = $data_jurusan['nama_fakultas'];
			$data_profile['nama_jurusan'] = $data_jurusan['nama_jurusan'];
			$data_profile['kode_fakultas'] = $data_jurusan['kode_fakultas'];
			$data_profile['angkatan'] = getAngkatanFromNrp($data_profile['nrp']);
		}
        mysql_free_result($rs);
        unset($sql, $rs);

		return $data_profile;
}
function getFakultasJurusan($kode_jurusan){
		$sql = "SELECT * FROM t_jurusan WHERE kode_jurusan='$kode_jurusan'";
		$rs = mysql_query($sql);
		$data;
		while($row = mysql_fetch_array($rs)){
			$data['kode_jurusan'] = $row['kode_jurusan'];
			$data['nama_jurusan'] = $row['nama_jurusan'];
			$data['kode_fakultas'] = $row['kode_fakultas'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		$kode_fakultas = $data['kode_fakultas'];
		
		$sql = "SELECT * FROM t_fakultas WHERE kode_fakultas='$kode_fakultas'";
		$rs = mysql_query($sql);
		while($row = mysql_fetch_array($rs)){
			$data['nama_fakultas'] = $row['nama_fakultas'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		return $data;
}

function getHari($hari_num){
	$hari = array(0=>"Minggu",1=>"Senin",2=>"Selasa",3=>"Rabu",4=>"Kamis",5=>"Jum'at",6=>"Sabtu",7=>"Minggu");
//	$hari = array(0=>"Sunday",1=>"Monday",2=>"Tuesday",3=>"Wednesday",4=>"Thrusday",5=>"Friday",6=>"Saturday",7=>"Sunday");
	return $hari[$hari_num];
}

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