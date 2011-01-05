<?php
session_start();
include '../config.php';
include 'calc.php';

function setSemesterPlusToAll($v,$val,$o){
	$sql="SELECT nrp,ipk,semester FROM t_mahasiswa";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$data[0] = $row['nrp'];
		$data[2] = $row['semester'];
		if($o){$data[2] = $data[2] + $val;}else{$data[2] = $data[2] - $val;}
		$sql2="UPDATE `t_mahasiswa` SET `semester` = '$data[2]' WHERE `t_mahasiswa`.`nrp` = '$data[0]'";
		$rs2 = mysql_query($sql2);
		if (!mysql_query($sql2))
		  {		
			  die('Error: ' . mysql_error().'');
		  }
		unset($sql2);
	}
	mysql_free_result($rs);
	unset($sql, $rs);
	return $data;
}
function removeDataDatabaseMahasiswa($nrp){
	$sql = "DELETE FROM `t_mahasiswa` WHERE `t_mahasiswa`.`nrp` = '$nrp'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
	$sql = "DELETE FROM `tb_password` WHERE `nrp` = '$nrp'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}
function resetDataSKSDatabaseMahasiswa($v){
	$sql="SELECT nrp,ipk,semester FROM t_mahasiswa";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$data[0] = $row['nrp'];
		$data[2] = $row['semester'];
		$sks = 24;
		if($data[2]!=1){
			$data[3] = ($data[2]-1);
			$sql2="SELECT nrp,ips FROM `t_ips` WHERE nrp='$data[0]' AND semester ='$data[3]'";
			$rs2 = mysql_query($sql2);
			$sks = 9; $data[4]=0;
			while($row = mysql_fetch_array($rs2)){
				$data[4] = $row['ips'];
			}
			mysql_free_result($rs2);
			unset($sql2, $rs2);
			$data[4] = $data[4]+0;
			if($data[4]<=3){$sks=21;}
			if($data[4]<2.5){$sks=18;}
			if($data[4]<2){$sks=15;}
			if($data[4]<1.5){$sks=12;}
			if($data[4]<1){$sks=9;}
		}
		$sql2="UPDATE `t_mahasiswa` SET `sisa_sks` = '$sks' WHERE `t_mahasiswa`.`nrp` = '$data[0]'";
		$rs2 = mysql_query($sql2);
		if (!mysql_query($sql2))
		  {		
			  die('Error: ' . mysql_error().'');
		  }
		unset($sql2);
	}
	mysql_free_result($rs);
	unset($sql, $rs);
	return $data;
}

function addDataDatabaseMahasiswa($nrp,$data,$set){
	$sql="INSERT INTO `t_mahasiswa` (`nrp` ,`password` ,`nama` ,`aka` ,`jenis_kelamin` ,`tanggal_lahir` ,`alamat` ,`asal_sekolah` ,`kode_jurusan` ,`probis`, `tanggal_masuk` ,`semester` ,`ipk` ,`sisa_sks` ,`uid` ,`admin`)VALUES ('$data[0]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$data[12]', '$data[13]', '$data[14]', '$data[15]', '$data[16]')";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
	$sql="INSERT INTO `tb_password` (`nrp` ,`password`)VALUES ('$data[0]', '$data[1]')";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}

function setDataDatabaseMahasiswa($nrp,$data,$set){
	$k = 1;if($set)$k=2;
	$sql = "UPDATE `t_mahasiswa` SET nrp='$data[0]',password='$data[2]',nama='$data[3]',aka= '$data[4]',jenis_kelamin='$data[5]',tanggal_lahir='$data[6]',alamat='$data[7]',asal_sekolah='$data[8]',kode_jurusan='$data[9]',probis='$data[10]',tanggal_masuk='$data[11]',semester='$data[12]',ipk='$data[13]',sisa_sks='$data[14]',uid='$data[15]',admin='$data[16]' WHERE t_mahasiswa.nrp = '$nrp'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
	if($set=="true"){
		$sql = "UPDATE `tb_password` SET `nrp` = '$data[0]', `password` = '$data[1]' WHERE `tb_password`.`nrp` = '$nrp' LIMIT 1";
		if (!mysql_query($sql))
		  {		
			  die('Error: ' . mysql_error().'');
		  }
		unset($sql);
	}
}
function getDatabaseFakultas(){
	$sql = "SELECT * FROM `t_fakultas`";
	$rs = mysql_query($sql);
	$data; $k = 0;
	while($row = mysql_fetch_array($rs)){
		$data[0][$k]['kode_fakultas'] = $row['kode_fakultas'];
		$data[0][$k]['nama_fakultas'] = $row['nama_fakultas'];
		$data[0][0]['k'] = $k; $k++;
		$data[1][$row['kode_fakultas']]['nama_fakultas'] = $row['nama_fakultas'];
	}
	mysql_free_result($rs);
	unset($sql, $rs);
	return $data;
}

function getDatabaseJurusan(){
	$sql = "SELECT * FROM `t_jurusan` WHERE kode_jurusan !=\"\" ";
	$rs = mysql_query($sql);
	$data; $k = 0;
	while($row = mysql_fetch_array($rs)){
		$data[0][$k]['kode_fakultas'] = $row['kode_fakultas'];
		$data[0][$k]['kode_jurusan'] = $row['kode_jurusan'];
		$data[0][$k]['nama_jurusan'] = $row['nama_jurusan'];
		$data[0][0]['k'] = $k; $k++;
		$data[1][$row['kode_jurusan']]['kode_fakultas'] = $row['kode_fakultas'];
		$data[1][$row['kode_jurusan']]['nama_jurusan'] = $row['nama_jurusan'];
	}
	mysql_free_result($rs);
	unset($sql, $rs);
	return $data;
}
function getTabelDatabaseMahasiswa($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM t_mahasiswa ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM t_mahasiswa WHERE ".$searchin." LIKE '%".$search."%' ORDER BY ".$orderby." ".$order;
			}
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$s = '<div>'.$s;
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>NRP</th><th width="25%">Name</th><th>Gender</th><th>Fakultas/Jurusan</th><th>Class</th><th>SMS</th><th>Remaining SKS</th><th>IPK</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$datafj = getFakultasJurusan($row['kode_jurusan']);
				$nrp = $row['nrp'];
				$probis; if($row['probis']=="0"){$probis="Morning";}else{$probis="Probis";}
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$nrp.'</b></td><td><b>'
				.$row['nama'].'</b></td><td id="center">'
				.$row['jenis_kelamin'].'</td><td id="center">'
				.$datafj['nama_fakultas'].' '.$datafj['nama_jurusan'].'</td><td id="center">'
				/*.$row['kode_jurusan'].*/
				.$probis.'</td><td id="center">'
				/*.$row['semester'].*/
				.$row['semester'].'</td><td id="center">'
				.$row['sisa_sks'].' SKS</td><td id="center">'
				.$row['ipk'].'</td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_m(3,\''.$nrp.'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_m(2,\''.$nrp.'\')" href="#!">&nbsp;</a><a href="#!"><a id="x" onclick="javascript:edit_db_m(4,\''.$nrp.'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table>';
			//if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}

			//else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
$mk=$mk.'<br>';
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_m\','.$i.');">'.$i.'</a>&nbsp;';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
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
function getDataDatabaseMahasiswa($nrp){
			$sql = "SELECT * FROM t_mahasiswa WHERE nrp = '$nrp'";
			$rs = mysql_query($sql);
			$data;
			while($row = mysql_fetch_array($rs)){
				$data['nrp'] = $row['nrp'];
				$data['password'] = $row['password'];	
				$data['nama'] = $row['nama'];	
				$data['aka'] = $row['aka'];	
				$data['jenis_kelamin'] = $row['jenis_kelamin'];	
				$data['tanggal_lahir'] = $row['tanggal_lahir'];	
				$data['alamat'] = $row['alamat'];	
				$data['asal_sekolah'] = $row['asal_sekolah'];	
				$data['kode_jurusan'] = $row['kode_jurusan'];
				$a = getFakultasJurusan($data['kode_jurusan']);
				$data['nama_jurusan'] = $a['nama_jurusan'];
				$data['kode_fakultas'] = $a['kode_fakultas'];
				$data['nama_fakultas'] = $a['nama_fakultas'];
				$data['probis'] = $row['probis'];	
				$data['tanggal_masuk'] = $row['tanggal_masuk'];	
				$data['semester'] = $row['semester'];	
				$data['ipk'] = $row['ipk'];	
				$data['sisa_sks'] = $row['sisa_sks'];	
				$data['uid'] = $row['uid'];	
				$data['admin'] = $row['admin'];	
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}


?>