<?php
include '../config.php';
include 'calc.php';
function getAllDataMataKuliahTRJurusan($kode_mk){
	$sql = "SELECT * FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_jurusan AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_jurusan as t ON t.kode_jurusan=j.kode_jurusan WHERE m.kode_mata_kuliah = '$kode_mk'";$rs=mysql_query($sql);$data;$k=0;while($row = mysql_fetch_array($rs)){$data[$k]['kode_jurusan'] = $row['kode_jurusan'];$data[$k]['semester']=$row['semester'];$data[$k]['nama_jurusan']=$row['nama_jurusan'];$k++;$data['k']=$k;}mysql_free_result($rs);unset($sql, $rs);return $data;}
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

$code = htmlentities($_POST['code']);
$code_in = htmlentities($_POST['code_in']);
$kode_mk= htmlentities($_POST['kode_mk']);
$kode_jurusan= htmlentities($_POST['kode_jurusan']);
$nrp_dosen= htmlentities($_POST['nrp_dosen']);
$nrp_mahasiswa= htmlentities($_POST['nrp_mahasiswa']);
$kode_mk_syarat= htmlentities($_POST['kode_mk_syarat']);
$data=htmlentities($_POST['data']);
$data=explode("|",$data);

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
}
?>