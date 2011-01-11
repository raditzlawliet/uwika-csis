<?php
session_start();
include '../config.php';
include '../auth.php';
include '../session.php';
include 'calc.php';
function isNowKRS($settings_manual){
	$tgl = date(Y)."-".date(m)."-".date(d);
	if($settings_manual==1){
	$sql = "SELECT settings,value FROM `settings` WHERE (settings = 'tanggal_krs_mulai' OR settings = 'tanggal_krs_selesai') AND ( \n"
		. "(SELECT value FROM `settings` WHERE settings = 'tanggal_krs_mulai') <= '$tgl' AND \n"
		. "(SELECT value FROM `settings` WHERE settings = 'tanggal_krs_selesai') >= '$tgl' )";}
	else{
//	$sql = "SELECT settings,value FROM `settings` WHERE (settings = \'tanggal_krs_mulai\' OR settings = \'tanggal_krs_selesai\') AND ( \n"
//		. "(SELECT value FROM `settings` WHERE settings = \'tanggal_krs_mulai\') <= '$tgl' AND \n"
//		. "(SELECT value FROM `settings` WHERE settings = \'tanggal_krs_selesai\') >= '$tgl' )";
	}
	$rs = mysql_query($sql);
	$data = false;
	while($row = mysql_fetch_array($rs)){
		$data = true;
	}
	mysql_free_result($rs);
	unset($sql, $rs);
	return $data;
}
function getMataKuliahTabrakanWaktunya($kode_mk,$nrp,$masa){
$sql = "SELECT mkm.kode_mata_kuliah, mku.nama_mata_kuliah, hari, jam_mulai, jam_selesai
FROM tr_mata_kuliah_mahasiswa AS mkm
JOIN t_mata_kuliah AS mku ON mkm.kode_mata_kuliah = mku.kode_mata_kuliah
WHERE mkm.nrp = '$nrp'
AND mkm.masa = '$masa'
AND mku.hari = (
	SELECT mk.hari
	FROM `t_mata_kuliah` AS mk
	WHERE mk.kode_mata_kuliah = '$kode_mk' )
AND (
	mku.jam_mulai
	BETWEEN (
		
		SELECT mk.jam_mulai
		FROM `t_mata_kuliah` AS mk
		WHERE mk.kode_mata_kuliah = '$kode_mk'
	)
	AND (
		
		SELECT mk.jam_selesai
		FROM `t_mata_kuliah` AS mk
		WHERE mk.kode_mata_kuliah = '$kode_mk'
	)
	OR mku.jam_selesai
	BETWEEN (
		
		SELECT mk.jam_mulai
		FROM `t_mata_kuliah` AS mk
		WHERE mk.kode_mata_kuliah = '$kode_mk'
	)
	AND (
	
		SELECT mk.jam_selesai
		FROM `t_mata_kuliah` AS mk
		WHERE mk.kode_mata_kuliah = '$kode_mk'
	)
	OR (
			(SELECT mk.jam_mulai
			FROM `t_mata_kuliah` AS mk
			WHERE mk.kode_mata_kuliah = '$kode_mk')
			BETWEEN mku.jam_mulai AND mku.jam_selesai
		
			OR
		
			(SELECT mk.jam_selesai
			FROM `t_mata_kuliah` AS mk
			WHERE mk.kode_mata_kuliah = '$kode_mk')
			BETWEEN mku.jam_mulai AND mku.jam_selesai
		)
)";	
			$rs = mysql_query($sql);
			$data[0]['ada'] = false;
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$data[0]['ada'] = true;
				$data[$k]['kode_mata_kuliah'] = $row['kode_mata_kuliah'];
				$data[0]['k'] = $k;
				$k++;
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}
function getSMSMahasiswa($nrp){
			$sql = "SELECT semester \n"
			. "FROM t_mahasiswa\n"
			. "WHERE nrp = '$nrp'";
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$data = $row['semester'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}
function addStudentRegisteredMataKuliah($kode_mk,$nrp,$masa,$sks){
			$sms = getSMSMahasiswa($nrp);
			$d = date(w);
			$tgl = date(Y)."-".date(m)."-".date(d);
			$time = date(H).":".date(i).":".date(s);
			$sql = "INSERT INTO `tr_mata_kuliah_mahasiswa` (`kode_mata_kuliah`, `nrp`, `semester`, `masa`, `hari_register`, `time_register`, `tanggal_register`) VALUES ('$kode_mk','$nrp', '$sms', '$masa', '$d', '$time' , '$tgl');";
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
function getMataKuliahFromSyaratThenRemoveIt($kode_mk_syarat,$nrp,$masa){
//	DELETE FROM `csisdb`.`tr_mata_kuliah_mahasiswa` WHERE `tr_mata_kuliah_mahasiswa`.`kode_mata_kuliah` = 'PU1001' AND `tr_mata_kuliah_mahasiswa`.`nrp` = '31109032' AND `tr_mata_kuliah_mahasiswa`.`masa` = '2010/1'	
	$sql = "SELECT kode_mata_kuliah FROM `tr_mata_kuliah_syarat` WHERE kode_mata_kuliah_syarat = '$kode_mk_syarat'";
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$tmp = getStudentIsRegisteredMataKuliah($row['kode_mata_kuliah'],$nrp);
				if($tmp['ada']){
						if($tmp['masa']==$masa){
							removeStudentRegisteredMataKuliah($row['kode_mata_kuliah'],$nrp,$masa);
						}
				}
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
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
function getSyarat($kode_mk){
			$sql = "SELECT * FROM `tr_mata_kuliah_syarat` AS a JOIN t_mata_kuliah AS b ON a.kode_mata_kuliah_syarat=b.kode_mata_kuliah WHERE a.kode_mata_kuliah = '$kode_mk'";$rs = mysql_query($sql);
			$k = 0;
			$data[0]['ada'] = false;
			while($row = mysql_fetch_array($rs)){
				$data[0]['ada'] = true;
				$data[$k]['kode_mk'] = $row['kode_mata_kuliah'];
				$data[$k]['kode_mk_syarat'] = $row['kode_mata_kuliah_syarat'];
				$data[$k]['kode_syarat'] = $row['kode_syarat'];
				$data[0]['k'] = $k;
				$k++;
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}
function getStudentIsLulusMataKuliah($kode_mk,$nrp){
			$sql = "SELECT mkm.masa\n"
			. "FROM tr_mata_kuliah_mahasiswa as mkm WHERE mkm.kode_mata_kuliah = '$kode_mk' AND mkm.nrp = '$nrp' AND mkm.lulus = 1";
			$rs = mysql_query($sql);
			$data = false;
			while($row = mysql_fetch_array($rs)){
				$data = true;
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}
function getStudentIsRegisteredMataKuliah($kode_mk,$nrp){
			$sql = "SELECT mkm.nrp, mkm.lulus, mkm.masa\n"
			. "FROM tr_mata_kuliah_mahasiswa as mkm where mkm.kode_mata_kuliah = '$kode_mk' AND mkm.nrp = '$nrp' ORDER BY mkm.masa ASC";
			$rs = mysql_query($sql);
			$data['ada'] = false;
			while($row = mysql_fetch_array($rs)){
				$data['ada'] = true;
				$data['nrp'] = $row['nrp'];
				$data['masa'] = $row['masa'];
				$tmp = explode("/",$data['masa']);
				$data['tahun'] = $tmp[0];
				$data['semester'] = $tmp[1];
				$data['lulus'] = $row['lulus'];
				if($row['lulus']=="1"){
					$data['lulus_'] = "1";
				}else{
					if($data['lulus_']=="1"){
						$data['lulus_'] = "1";
					}else{
						$data['lulus_'] = "0";
					}
				}
				$data['k']++;
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
	
}
function getListStudentRegisteredMataKuliahX($kode_mk,$tahun,$semester){
			$masa = getMasa($tahun,$semester);
			$sql = "SELECT mkm.kode_mata_kuliah, m.nrp, m.nama, mkm.hari_register,mkm.time_register,mkm.tanggal_register,m.kode_jurusan,m.semester\n"
			. "FROM tr_mata_kuliah_mahasiswa as mkm \n"
			. "JOIN t_mahasiswa as m ON mkm.nrp = m.nrp \n"
			. "where kode_mata_kuliah = '$kode_mk' AND masa = '$masa'\n"
			. "order by mkm.tanggal_register DESC, mkm.time_register DESC";
			$rs = mysql_query($sql);
			$mk = "";
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$k++;
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $k;
}

function getListStudentRegisteredMataKuliah($kode_mk,$tahun,$semester){
			$masa = getMasa($tahun,$semester);
			$sql = "SELECT mkm.kode_mata_kuliah, m.nrp, m.nama, mkm.hari_register,mkm.time_register,mkm.tanggal_register,m.kode_jurusan,m.semester\n"
			. "FROM tr_mata_kuliah_mahasiswa as mkm \n"
			. "JOIN t_mahasiswa as m ON mkm.nrp = m.nrp \n"
			. "where kode_mata_kuliah = '$kode_mk' AND masa = '$masa'\n"
			. "order by mkm.tanggal_register DESC, mkm.time_register DESC";
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
				<td>'.$row['nama'].'</td>
				<td>'.getHari($row['hari_register']).', '.$row['tanggal_register'].', '.$row['time_register'].'</td>';
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
		$k = 0;
		while($row = mysql_fetch_array($rs)){
			$k++;
			if($k==1){
			$data['nrp'] = $row['nrp'];
			$data['nama'] = $row['nama'];}
			$data['k'] = $k;
			$data[$k]['nrp'] = $row['nrp'];
			$data[$k]['nama'] = $row['nama'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		return $data;

}
function getMKSemesterProdi($mk,$j){
	$sql = "SELECT semester\n"
		. " FROM t_mata_kuliah AS mk\n"
		. " JOIN tr_mata_kuliah_jurusan AS mkj ON mk.kode_mata_kuliah = mkj.kode_mata_kuliah\n"
		. " WHERE mk.kode_mata_kuliah = '$mk' AND mkj.kode_jurusan = '$j'";
		$rs = mysql_query($sql);
		$data;
		while($row = mysql_fetch_array($rs)){
			$data = $row['semester'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		return $data;
}

function getListMataKuliahPerSemester($kode_jurusan,$sms,$probis,$nrp){
			$sql = "SELECT *\n"
			. "FROM t_mata_kuliah AS mk\n"
			. "JOIN tr_mata_kuliah_jurusan AS mkj\n"
			. "ON mk.kode_mata_kuliah = mkj.kode_mata_kuliah\n"
			. "WHERE probis = '$probis' AND kode_jurusan = '$kode_jurusan' AND semester = '$sms'\n"
			. "ORDER BY hari ASC, mk.jam_mulai ASC, mk.jam_selesai ASC, mk.kode_mata_kuliah ASC";
			$rs = mysql_query($sql);
			$mk = '<table id="mk">
			<tr id="header_table"><th>Kode</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Hari</th><th>Jam Mulai</th><th>Jam Selesai</th><th>Status</th></tr>
			';
			$k = 0;
			$status = array("a"=>'<img src="images/a.png" width="15px"\ title="Already Complete - Anda sudah menyelesaikan Mata Kuliah ini, dan anda masih bisa mengambilnya lagi.">',
							"v"=>'<img src="images/v.png" width="15px"\ title="Already Complete - Anda sudah menyelesaikan Mata Kuliah ini, dan anda masih bisa mengambilnya lagi.">',
							"r"=>'<img src="images/r.png" width="15px"\ title="Already Registered Before, but Not Complete -  Anda sudah pernah daftar Mata Kuliah ini, tetapi gagal. dan anda bisa mengambilnya lagi.">',
							"x"=>'<img src="images/x.png" width="15px"\ title="Didn\'t Match Requirement or Can\'t Participate Now - Anda belum dapat mengambil mata kuliah ini disebabkan Tabrakan Waktu atau SKS habis atau Syarat belum terpenuhi.">',
							"n"=>'');
			$t_thn = getValueSettingsOf('tahun');
			$t_sms = getValueSettingsOf('semester');
			$masa = getMasa($t_thn,$t_sms);
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$ac = $status["n"];
				$kode_mk = $row['kode_mata_kuliah'];
				$syarat = getSyarat($kode_mk);
				$syarat_ = 0;
				$sdh = false;
				if($syarat[0]['ada']){
					for($i = 0; $i<=$syarat[0][k];$i++){
						//if dia lulus, maka bs ambil, jika tidak. maka g bs ambil
						if(getStudentIsLulusMataKuliah($syarat[$i]['kode_mk_syarat'],$nrp)){ //lulus
							if($syarat_ !=2){
								$syarat_ = 1;
							}
						}else{		//gagal / blum ambil
							if($syarat[$i]['kode_syarat']==1){
									$mk_syarat = getStudentIsRegisteredMataKuliah($syarat[$i]['kode_mk_syarat'],$nrp);
										if($mk_syarat['ada']){
												if($mk_syarat['masa']==$masa){
													//LOLOS SYARAT 1
												}else{
													//gagal
													$syarat_ = 2;
												}
										}else{
											//gagal
											$syarat_ = 2;
										}
							}else{
								$syarat_ = 2;
							}
							
						}
						if($syarat_ == 2){
							$ac = $status["x"];
							$tr = $tr.' class="red" ';
						}else{						
							//bisa ambil / sudah lolozzzz
						}
					}
				}
				$s_r = getStudentIsRegisteredMataKuliah($kode_mk,$nrp);
			if($syarat_ != 2){
				if($s_r['ada']){
					if($s_r['lulus']=="1"){
//							$ac = "a"; //already
							$ac = $status["a"];	
					}else{					
						if($s_r['masa']==$masa){
//							$ac = "v"; //sudah regist skrng
							$ac = $status["v"];
							$sdh = true;
							$tr = $tr.' class="blue" ';
							if($s_r["k"]>1) {
								if($s_r['lulus_']=="1"){
									$ac = $status["a"].$status["v"];
								}else{
									$ac = $status["r"].$status["v"];
								}
							}
						}else{
//							$ac = "r"; //sudh regist dlu, tpi gagal, bs regist lg
							$ac = $status["r"];
						}
					}
				}else{
//					$ac = "n"; //blom sama skali
					$ac = $status["n"];
				}
			}
			$mk_tabrak = getMataKuliahTabrakanWaktunya($kode_mk,$nrp,$masa);
			if($mk_tabrak[0]['ada']){
				$sama_mk_tabrak = false;
				for($l=0;$l<=$mk_tabrak[0]['k'];$l++){
					if($mk_tabrak[0]['kode_mata_kuliah'] == $kode_mk){
						$sama_mk_tabrak = true;
						$sdh = true;
					}
				}
				if(!$sama_mk_tabrak){
					$ac = $status["x"];
					$tr = $tr.' class="red" ';
				}
			}
				$sks_m = getSKSMahasiswa($nrp);
				$sks_mk = $row['jumlah_sks'];
				if(!$sdh){if($sks_m < $sks_mk){
					$ac = $status["x"];
					$tr = $tr.' class="red" ';
				}}
				$mk = $mk
				.'<tr'.$tr.' onclick="javascript:GoDAFTARKRSMK(\''.$kode_mk.'\',\''.$_SESSION['uid'].'\');"><td id="center"><b>'
				.$row['kode_mata_kuliah'].'</b></td><td id="nama_mat_kul"><b>'
				.$row['nama_mata_kuliah'].'</b></td><td id="center" style="width:5%;">'
				.$sks_mk.'</td><td id="center">'
				.getHari($row['hari']).'</td><td id="center">'
				/*.$row['kode_jurusan'].*/
				.$row['jam_mulai'].'</td><td id="center">'
				/*.$row['semester'].*/
				.$row['jam_selesai'].'</td><td class="'.$kode_mk.'_status" id="center">'
				.$ac.'</td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table>';
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}

function getListMataKuliahPerNRP($nrp,$masa,$krs_true,$show_msg){
			$kode_jurusan = substr($nrp,0,3);
			$sql = "SELECT *\n"
			. "FROM t_mata_kuliah AS mk\n"
			. "JOIN tr_mata_kuliah_mahasiswa AS mkm ON mk.kode_mata_kuliah = mkm.kode_mata_kuliah\n"
			. "LEFT JOIN tr_mata_kuliah_jurusan AS mkj on mk.kode_mata_kuliah = mkj.kode_mata_kuliah\n"
			. "WHERE nrp = '$nrp'\n"
			. "AND masa = '$masa'\n"
			. "AND mkj.kode_jurusan = '$kode_jurusan'\n"
			. "ORDER BY hari, mk.jam_mulai ASC, mk.jam_selesai ASC, mk.kode_mata_kuliah ASC";
			$rs = mysql_query($sql);
			$mk = '<div id="header_krs_semester">L I S T &nbsp; &nbsp; M A T A &nbsp; &nbsp; K U L I A H &nbsp; &nbsp; Y A N G &nbsp; &nbsp; S U D A H &nbsp; &nbsp; A N D A &nbsp; &nbsp; A M B I L</div>
<table id="mk">
			<tr id="header_table"><th id="mk_nrp">Kode</th><th id="mk_nrp">Nama Mata Kuliah</th><th id="mk_nrp">SKS</th><th id="mk_nrp">Semester</th><th id="mk_nrp">Hari</th><th id="mk_nrp">Jam Mulai</th><th id="mk_nrp">Jam Selesai</th><th id="mk_nrp">Status</th></tr>';
			$k = 0;
			$status = array("a"=>'<img src="images/a.png" width="15px"\ title="Already Complete - Anda sudah menyelesaikan Mata Kuliah ini, dan anda masih bisa mengambilnya lagi.">',
							"v"=>'<img src="images/v.png" width="15px"\ title="Already Complete - Anda sudah menyelesaikan Mata Kuliah ini, dan anda masih bisa mengambilnya lagi.">',
							"r"=>'<img src="images/r.png" width="15px"\ title="Already Registered Before, but Not Complete -  Anda sudah pernah daftar Mata Kuliah ini, tetapi gagal. dan anda bisa mengambilnya lagi.">',
							"x"=>'<img src="images/x.png" width="15px"\ title="Didn\'t Match Requirement or Can\'t Participate Now - Anda belum dapat mengambil mata kuliah ini disebabkan Tabrakan Waktu atau SKS habis atau Syarat belum terpenuhi.">',
							"n"=>'');
				$ada = false;
			while($row = mysql_fetch_array($rs)){
				$ada = true;
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$ac = $status["n"];
				$kode_mk = $row['kode_mata_kuliah'];
				$syarat = getSyarat($kode_mk);
				$syarat_ = 0;
				$sdh = false;
				if($syarat[0]['ada']){
					for($i = 0; $i<=$syarat[0][k];$i++){
						//if dia lulus, maka bs ambil, jika tidak. maka g bs ambil
						if(getStudentIsLulusMataKuliah($syarat[$i]['kode_mk_syarat'],$nrp)){ //lulus
							if($syarat_ !=2){
								$syarat_ = 1;
							}
						}else{		//gagal / blum ambil
							if($syarat[$i]['kode_syarat']==1){
									$mk_syarat = getStudentIsRegisteredMataKuliah($syarat[$i]['kode_mk_syarat'],$nrp);
										if($mk_syarat['ada']){
												if($mk_syarat['masa']==$masa){
													//LOLOS SYARAT 1
												}else{
													//gagal
													$syarat_ = 2;
												}
										}else{
											//gagal
											$syarat_ = 2;
										}
							}else{
								$syarat_ = 2;
							}
							
						}
						if($syarat_ == 2){
							$ac = $status["x"];
							$tr = $tr.' class="red" ';
						}else{						
							//bisa ambil / sudah lolozzzz
						}
					}
				}
				$s_r = getStudentIsRegisteredMataKuliah($kode_mk,$nrp); 
			if($syarat_ != 2){
				if($s_r['ada']){
					if($s_r['lulus']=="1"){
//							$ac = "a"; //already
							$ac = $status["a"];	
					}else{					
						if($s_r['masa']==$masa){
//							$ac = "v"; //sudah regist skrng
							$ac = $status["v"];
							$sdh = true;
							$tr = $tr.' class="blue" ';
							if($s_r["k"]>1) {
								if($s_r['lulus_']=="1"){
									$ac = $status["a"].$status["v"];
								}else{
									$ac = $status["r"].$status["v"];
								}
							}
						}else{
//							$ac = "r"; //sudh regist dlu, tpi gagal, bs regist lg
							$ac = $status["r"];
						}
					}
				}else{
//					$ac = "n"; //blom sama skali
					$ac = $status["n"];
				}
			}
			$mk_tabrak = getMataKuliahTabrakanWaktunya($kode_mk,$nrp,$masa);
			if($mk_tabrak[0]['ada']){
				$sama_mk_tabrak = false;
				for($l=0;$l<=$mk_tabrak[0]['k'];$l++){
					if($mk_tabrak[0]['kode_mata_kuliah'] == $kode_mk){
						$sama_mk_tabrak = true;
						$sdh = true;
					}
				}
				if(!$sama_mk_tabrak){
					$ac = $status["x"];
					$tr = $tr.' class="red" ';
				}
			}
				$sks_m = getSKSMahasiswa($nrp);
				$sks_mk = $row['jumlah_sks'];
				if(!$sdh){if($sks_m < $sks_mk){
					$ac = $status["x"];
					$tr = $tr.' class="red" ';
				}}
				if($krs_true){$mk = $mk.'<tr'.$tr.' onclick="javascript:GoDAFTARKRSMK2(\''.$kode_mk.'\',\''.$_SESSION['uid'].'\');"><td id="center"><b>';}
				else{$mk = $mk.'<tr'.$tr.' ><td id="center"><b>';}
				$mk = $mk
				.$row['kode_mata_kuliah'].'</b></td><td id="nama_mat_kul"><b>'
				.$row['nama_mata_kuliah'].'</b></td><td id="center" style="width:5%;">'
				.$sks_mk.'</td><td id="center">'
				.$row['semester'].'</td><td id="center">'
				.getHari($row['hari']).'</td><td id="center">'
				/*.$row['kode_jurusan'].*/
				.$row['jam_mulai'].'</td><td id="center">'
				/*.$row['semester'].*/
				.$row['jam_selesai'].'</td><td class="'.$kode_mk.'_status" id="center">'
				.$ac.'</td>'
				.'</tr>';
				$k++;
			}
			$status = array("a"=>'<img src="images/a.png" width="15px"\ title="Already Complete - Anda sudah menyelesaikan Mata Kuliah ini, dan anda masih bisa mengambilnya lagi.">',
							"v"=>'<img src="images/v.png" width="15px"\ title="Already Complete - Anda sudah menyelesaikan Mata Kuliah ini, dan anda masih bisa mengambilnya lagi.">',
							"r"=>'<img src="images/r.png" width="15px"\ title="Already Registered Before, but Not Complete -  Anda sudah pernah daftar Mata Kuliah ini, tetapi gagal. dan anda bisa mengambilnya lagi.">',
							"x"=>'<img src="images/x.png" width="15px"\ title="Didn\'t Match Requirement or Can\'t Participate Now - Anda belum dapat mengambil mata kuliah ini disebabkan Tabrakan Waktu atau SKS habis atau Syarat belum terpenuhi.">',
							"n"=>'');
			$mk = $mk.'</table>
			<p>
			<div style="text-align:left;letter-spacing:2px;font-size:11px;"><b> &nbsp; CATATAN</b></div>
			<div style="text-align:left;">
			<table id="legend_krs">
			<tr><th id="center">Kode</th><th id="center">Deskripsi (Arahkan Mouse diatas gambar)</th></tr>
			<tr><td id="center">'.$status["n"].'</td><td>Nothing Interest - Artinya anda bisa mengambil Mata Kuliah ini.</td>
			<tr><td id="center">'.$status["a"].'</td><td>Already Complete - Anda sudah menyelesaikan Mata Kuliah ini, dan anda masih bisa mengambilnya lagi.</td>
			<tr class="blue"><td id="center">'.$status["v"].'</td><td>Already Registered Now - Anda sudah mendaftarkan Mata Kuliah ini pada tahun ajaran sekarang.</td>
			<tr class="red"><td id="center">'.$status["r"].'</td><td>Already Registered Before, but Not Complete -  Anda sudah pernah daftar Mata Kuliah ini, tetapi gagal. dan anda bisa mengambilnya lagi.</td>
			<tr class="red"><td id="center">'.$status["x"].'</td><td>Didn\'t Match Requirement or Can\'t Participate Now - Anda belum dapat mengambil mata kuliah ini disebabkan Tabrakan Waktu atau SKS habis atau Syarat belum terpenuhi.</td>
			</table>
			</div>
			<script>function GoDAFTARKRSMK2(kode_mk,uid){
				data = "&uid=" + encodeURI(uid) + "&kode_mk=" + encodeURI(kode_mk) + "&semester=" + encodeURI("'.$sms.'");
				ShowHiddenPanel(true,\'krs_list_mk\',\'Ajax/panel.php\',\'.main_panel\',data);
			}</script>';
			mysql_free_result($rs);
			unset($sql, $rs);
			if(!$ada){if($show_msg){$mk = "There isn't Mata Kuliah Registered by NRP ".$nrp." at ".$masa.".";}else{$mk = "";}}
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

function getUidByNRP($nrp){
		$sql = "SELECT uid FROM t_mahasiswa WHERE nrp = '$nrp' UNION SELECT uid FROM t_dosen WHERE nrp='$nrp' UNION SELECT uid FROM t_karyawan WHERE nrp='$nrp'";
		$rs = mysql_query($sql);
		$data_profile;
		while($row = mysql_fetch_array($rs)){
			$data_profile = $row['uid'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		return $data_profile;
}
function getProfile($uid,$turn){
		$sql = array("SELECT * FROM t_mahasiswa WHERE uid = '$uid'",
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
			$data_profile['sks_awal']= $row['sks_awal'];
			$data_profile['probis']= $row['probis'];
			$data_jurusan = getFakultasJurusan($data_profile['kode_jurusan']);
			$data_profile['nama_fakultas'] = $data_jurusan['nama_fakultas'];
			$data_profile['nama_jurusan'] = $data_jurusan['nama_jurusan'];
			$data_profile['kode_fakultas'] = $data_jurusan['kode_fakultas'];
			$data_profile['angkatan'] = getAngkatanFromNrp($data_profile['nrp']);
			$data_profile['ipk']= $row['ipk'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
			if($turn==0){
			$sql = "SELECT * FROM t_mahasiswa as t JOIN t_ips as r on t.nrp=r.nrp where t.uid = '$uid' and r.semester = (SELECT semester from t_mahasiswa where uid = '$uid')-1";
			$rs = mysql_query($sql);
			while($row = mysql_fetch_array($rs)){
				$data_profile['last_ips']= $row['ips'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
		}
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