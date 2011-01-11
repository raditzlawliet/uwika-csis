<?php
include '../config.php';
include 'calc.php';
function getMataKuliahSearch(){$sql="SELECT nama_mata_kuliah,kode_mata_kuliah FROM t_mata_kuliah";$rs=mysql_query($sql);$data;while($row = mysql_fetch_array($rs)){$data[$row['kode_mata_kuliah']]=$row['nama_mata_kuliah'];}mysql_free_result($rs);unset($sql, $rs);return $data;}
function getDosenSearch(){$sql="SELECT nama,nrp FROM t_dosen";$rs=mysql_query($sql);$data;while($row = mysql_fetch_array($rs)){$data[$row['nrp']]=$row['nama'];}mysql_free_result($rs);unset($sql, $rs);return $data;}
function getMahasiswaSearch(){$sql="SELECT nama,nrp,semester FROM t_mahasiswa";$rs=mysql_query($sql);$data;while($row = mysql_fetch_array($rs)){$data[$row['nrp']]=$row['nama'];}mysql_free_result($rs);unset($sql, $rs);return $data;}

function getAllDataMataKuliahTRJurusan($kode_mk){
	$sql = "SELECT * FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_jurusan AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_jurusan as t ON t.kode_jurusan=j.kode_jurusan WHERE m.kode_mata_kuliah = '$kode_mk'";$rs=mysql_query($sql);$data;$k=0;while($row = mysql_fetch_array($rs)){$data[$k]['kode_jurusan'] = $row['kode_jurusan'];$data[$k]['semester']=$row['semester'];$data[$k]['nama_jurusan']=$row['nama_jurusan'];$k++;$data['k']=$k;}mysql_free_result($rs);unset($sql, $rs);return $data;}
function getAllDataMataKuliahTRDosen($kode_mk){
	$sql = "SELECT * FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_dosen AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_dosen as t ON t.nrp=j.nrp WHERE m.kode_mata_kuliah = '$kode_mk'";$rs=mysql_query($sql);$data;$k=0;while($row = mysql_fetch_array($rs)){$data[$k]['nrp'] = $row['nrp'];$data[$k]['nama']=$row['nama'];$k++;$data['k']=$k;}mysql_free_result($rs);unset($sql, $rs);return $data;}
function getAllDataMataKuliahTRSyarat($kode_mk){
	$sql = "SELECT n.nama_mata_kuliah,j.kode_mata_kuliah_syarat,j.kode_syarat FROM tr_mata_kuliah_syarat AS j JOIN t_mata_kuliah AS n ON j.kode_mata_kuliah_syarat=n.kode_mata_kuliah WHERE j.kode_mata_kuliah = '$kode_mk'";$rs=mysql_query($sql);$data;$k=0;while($row = mysql_fetch_array($rs)){$data[$k]['nama_mata_kuliah'] = $row['nama_mata_kuliah'];$data[$k]['kode_mata_kuliah_syarat']=$row['kode_mata_kuliah_syarat'];$data[$k]['kode_syarat']=$row['kode_syarat'];$k++;$data['k']=$k;}	mysql_free_result($rs);unset($sql, $rs);return $data;}
function getAllDataMataKuliahTRMahasiswa($kode_mk,$v){
	if($v!="g"){$t="AND masa='$v' ";}$sql = "SELECT t.nrp,t.nama,j.semester,j.masa,j.lulus FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_mahasiswa AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_mahasiswa as t ON t.nrp=j.nrp WHERE m.kode_mata_kuliah = '$kode_mk' ".$t."ORDER BY masa DESC";$rs=mysql_query($sql);$data;$k=0;while($row = mysql_fetch_array($rs)){$data[$k]['nrp'] = $row['nrp'];$data[$k]['nama']=$row['nama'];$data[$k]['semester']=$row['semester'];$data[$k]['masa']=$row['masa'];$data[$k]['lulus']=$row['lulus'];$k++;$data['k']=$k;}mysql_free_result($rs);unset($sql, $rs);return $data;}
	
function getOneDataMataKuliahTRJurusan($kode_mk,$kode_jurusan){
	$sql = "SELECT * FROM tr_mata_kuliah_jurusan WHERE kode_mata_kuliah = '$kode_mk' AND kode_jurusan='$kode_jurusan'";$rs = mysql_query($sql);$data;
	while($row = mysql_fetch_array($rs)){$data['kode_jurusan'] = $row['kode_jurusan'];$data['semester'] = $row['semester'];}
	mysql_free_result($rs);unset($sql, $rs);return $data;}
function setOneDataMataKuliahTRJurusan($kode_mk,$kode_jurusan,$data){
	$sql="UPDATE tr_mata_kuliah_jurusan SET kode_jurusan = '$data[0]',semester = '$data[1]' WHERE `kode_mata_kuliah` = '$kode_mk' AND kode_jurusan='$kode_jurusan'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function addOneDataMataKuliahTRJurusan($kode_mk,$data){
	$sql="INSERT INTO `tr_mata_kuliah_jurusan` (kode_mata_kuliah, kode_jurusan, semester) VALUES ('$kode_mk', '$data[0]', '$data[1]');";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function delOneDataMataKuliahTRJurusan($kode_mk,$kode_jurusan){
	$sql="DELETE FROM `tr_mata_kuliah_jurusan`  WHERE `kode_mata_kuliah` = '$kode_mk' AND kode_jurusan='$kode_jurusan'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
	
function getOneDataMataKuliahTRDosen($kode_mk,$nrp){
	$sql = "SELECT t.nrp,t.nama FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_dosen AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_dosen as t ON t.nrp=j.nrp WHERE m.kode_mata_kuliah = '$kode_mk' AND t.nrp='$nrp'";$rs = mysql_query($sql);$data;
	while($row = mysql_fetch_array($rs)){$data['nrp'] = $row['nrp'];$data['nama'] = $row['nama'];}
	mysql_free_result($rs);unset($sql, $rs);return $data;}
function setOneDataMataKuliahTRDosen($kode_mk,$nrp,$data){
	$sql="UPDATE tr_mata_kuliah_dosen SET nrp = '$data[0]' WHERE `kode_mata_kuliah` = '$kode_mk' AND nrp='$nrp'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function addOneDataMataKuliahTRDosen($kode_mk,$nrp){
	$sql="INSERT INTO `tr_mata_kuliah_dosen` (kode_mata_kuliah, nrp) VALUES ('$kode_mk', '$nrp');";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function delOneDataMataKuliahTRDosen($kode_mk,$nrp){
	$sql="DELETE FROM `tr_mata_kuliah_dosen`  WHERE `kode_mata_kuliah` = '$kode_mk' AND nrp='$nrp'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}

function getOneDataMataKuliahTRSyarat($kode_mk,$kode_mk_syarat){
	$sql = "SELECT t.kode_mata_kuliah_syarat, nama_mata_kuliah, t.kode_syarat FROM `t_mata_kuliah` AS m JOIN tr_mata_kuliah_syarat AS t ON t.kode_mata_kuliah_syarat = m.kode_mata_kuliah WHERE t.kode_mata_kuliah = '$kode_mk' AND t.kode_mata_kuliah_syarat = '$kode_mk_syarat'";$rs = mysql_query($sql);$data;while($row = mysql_fetch_array($rs)){$data['kode_mata_kuliah_syarat'] = $row['kode_mata_kuliah_syarat'];$data['nama_mata_kuliah'] = $row['nama_mata_kuliah'];$data['kode_syarat'] = $row['kode_syarat'];}mysql_free_result($rs);unset($sql, $rs);return $data;}
function setOneDataMataKuliahTRSyarat($kode_mk,$kode_mk_syarat,$data){
	$sql="UPDATE tr_mata_kuliah_syarat SET kode_mata_kuliah_syarat = '$data[0]',kode_syarat = '$data[1]' WHERE `kode_mata_kuliah` = '$kode_mk' AND kode_mata_kuliah_syarat='$kode_mk_syarat'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function addOneDataMataKuliahTRSyarat($kode_mk,$data){
	$sql="INSERT INTO `tr_mata_kuliah_syarat` (kode_mata_kuliah, kode_mata_kuliah_syarat, kode_syarat) VALUES ('$kode_mk', '$data[0]', '$data[1]');";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function delOneDataMataKuliahTRSyarat($kode_mk,$kode_mk_syarat){
	$sql="DELETE FROM `tr_mata_kuliah_syarat`  WHERE `kode_mata_kuliah` = '$kode_mk' AND kode_mata_kuliah_syarat = '$kode_mk_syarat'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}

function getOneDataMataKuliahTRMahasiswa($kode_mk,$nrp,$data){
	$sql = "SELECT t.nrp,t.nama,j.semester,j.masa,j.hari_register,j.time_register,j.tanggal_register,j.nilai,j.lulus FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_mahasiswa AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_mahasiswa as t ON t.nrp=j.nrp WHERE m.kode_mata_kuliah = '$kode_mk' AND t.nrp='$nrp' AND masa='$data[0]'";$rs = mysql_query($sql);$data;
	while($row = mysql_fetch_array($rs)){
		$data['nrp'] = $row['nrp'];
		$data['nama'] = $row['nama'];
		$data['semester'] = $row['semester'];
		$data['masa'] = $row['masa'];
		$data['hari_register'] = $row['hari_register'];
		$data['time_register'] = $row['time_register'];
		$data['tanggal_register'] = $row['tanggal_register'];
		$data['nilai'] = $row['nilai'];
		$data['lulus'] = $row['lulus'];
	}
	mysql_free_result($rs);unset($sql, $rs);return $data;}
function setOneDataMataKuliahTRMahasiswa($kode_mk,$nrp,$data){
	$sql="UPDATE tr_mata_kuliah_mahasiswa SET nrp = '$data[0]',semester= '$data[1]',masa= '$data[2]',hari_register= '$data[3]',time_register = '$data[4]',tanggal_register = '$data[5]',nilai = '$data[6]',lulus = '$data[7]' WHERE `kode_mata_kuliah` = '$kode_mk' AND nrp='$nrp' AND masa='$data[8]'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function addOneDataMataKuliahTRMahasiswa($kode_mk,$data){
	$sql="INSERT INTO `tr_mata_kuliah_mahasiswa` (kode_mata_kuliah, nrp, semester, masa, hari_register, time_register, tanggal_register, nilai, lulus) VALUES ('$kode_mk', '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]');";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function delOneDataMataKuliahTRMahasiswa($kode_mk,$nrp,$data){
	$sql="DELETE FROM `tr_mata_kuliah_mahasiswa`  WHERE `kode_mata_kuliah` = '$kode_mk' AND nrp='$nrp' AND masa='$data[0]'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
	
$code = htmlentities($_POST['code']);
$code_in = htmlentities($_POST['code_in']);
$kode_mk= htmlentities($_POST['kode_mk']);
$kode_jurusan= htmlentities($_POST['kode_jurusan']);
$nrp = htmlentities($_POST['nrp']);
$data=htmlentities($_POST['data']);
$data=explode("|",$data);

$q = strtolower($_GET["q"]);
$qj = strtolower($_GET["qj"]);
switch($qj){
	case 'fc':{
		$items=getDosenSearch();
		$result = array();
		foreach ($items as $key=>$value) {
			if((strpos(strtolower($key), $q) !== false)|| (strpos(strtolower($value), $q) !== false)) {
				array_push($result, array(
					"nrp" => $key,
					"nama" => $value
				));
			}
		}
		echo json_encode($result);
		break;
	}
	case 'mks':{
		$items=getMataKuliahSearch();
		$result = array();
		foreach ($items as $key=>$value) {
			if((strpos(strtolower($key), $q) !== false)|| (strpos(strtolower($value), $q) !== false)) {
				array_push($result, array(
					"kode_mata_kuliah" => $key,
					"nama_mata_kuliah" => $value
				));
			}
		}
		echo json_encode($result);
		break;
	}
	case 'mkm':{
		$items=getMahasiswaSearch();
		$result = array();
		foreach ($items as $key=>$value) {
			if((strpos(strtolower($key), $q) !== false)|| (strpos(strtolower($value), $q) !== false)) {
				array_push($result, array(
					"nrp" => $key,
					"nama" => $value
				));
			}
		}
		echo json_encode($result);
		break;
	}
}
switch($code){
	case 'mk_j' : {
		switch($code_in){
			case 'get' : {$msg=json_encode(getOneDataMataKuliahTRJurusan($kode_mk,$kode_jurusan));exit($msg);
				break;
			}
			case 'getall' : {$msg=json_encode(getAllDataMataKuliahTRJurusan($kode_mk));exit($msg);
				break;
			}
			case 'set' : {$msg="Save Success";setOneDataMataKuliahTRJurusan($kode_mk,$kode_jurusan,$data);exit($msg);
				break;
			}
			case 'add' : {$msg="Add Success";addOneDataMataKuliahTRJurusan($kode_mk,$data);exit($msg);
				break;
			}
			case 'del' : {$msg="Delete Success";delOneDataMataKuliahTRJurusan($kode_mk,$kode_jurusan);exit($msg);
				break;
			}
		}
		break;
	}
	case 'mk_d' : {
		switch($code_in){
			case 'get' : {$msg=json_encode(getOneDataMataKuliahTRDosen($kode_mk,$nrp));exit($msg);
				break;
			}
			case 'getall' : {$msg=json_encode(getAllDataMataKuliahTRDosen($kode_mk));exit($msg);
				break;
			}
			case 'set' : {$msg="Save Success";setOneDataMataKuliahTRDosen($kode_mk,$nrp,$data);exit($msg);
				break;
			}
			case 'add' : {$msg="Add Success";addOneDataMataKuliahTRDosen($kode_mk,$nrp);exit($msg);
				break;
			}
			case 'del' : {$msg="Delete Success";delOneDataMataKuliahTRDosen($kode_mk,$nrp);exit($msg);
				break;
			}
		}
		break;
	}
	case 'mk_s' : { //nrp as kode_mk_syarat
		switch($code_in){
			case 'get' : {$msg=json_encode(getOneDataMataKuliahTRSyarat($kode_mk,$nrp));exit($msg);
				break;
			}
			case 'getall' : {$msg=json_encode(getAllDataMataKuliahTRSyarat($kode_mk));exit($msg);
				break;
			}
			case 'set' : {$msg="Save Success";setOneDataMataKuliahTRSyarat($kode_mk,$nrp,$data);exit($msg);
				break;
			}
			case 'add' : {$msg="Add Success";addOneDataMataKuliahTRSyarat($kode_mk,$data);exit($msg);
				break;
			}
			case 'del' : {$msg="Delete Success";delOneDataMataKuliahTRSyarat($kode_mk,$nrp);exit($msg);
				break;
			}
		}
		break;
	}
	case 'mk_m' : { //nrp as kode_mk_syarat
		switch($code_in){
			case 'get' : {$msg=json_encode(getOneDataMataKuliahTRMahasiswa($kode_mk,$nrp,$data));exit($msg);
				break;
			}
			case 'getall' : {$msg=json_encode(getAllDataMataKuliahTRMahasiswa($kode_mk,$nrp));exit($msg);
				break;
			}
			case 'set' : {$msg="Save Success";setOneDataMataKuliahTRMahasiswa($kode_mk,$nrp,$data);exit($msg);
				break;
			}
			case 'add' : {$msg="Add Success";addOneDataMataKuliahTRMahasiswa($kode_mk,$data);exit($msg);
				break;
			}
			case 'del' : {$msg="Delete Success";delOneDataMataKuliahTRMahasiswa($kode_mk,$nrp,$data);exit($msg);
				break;
			}
		}
		break;
	}
}
	
?>