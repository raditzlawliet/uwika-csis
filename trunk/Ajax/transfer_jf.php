<?php
include '../config.php';
include 'calc.php';
function removeDataDatabaseJurusan($kd){
	$sql = "DELETE FROM `t_jurusan` WHERE `kode_jurusan` = '$kd'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}
function addDataDatabaseJurusan($data){
	$sql="INSERT INTO `t_jurusan` (`kode_jurusan`,`nama_jurusan`,`kode_fakultas`,`kode_depan_mata_kuliah`)VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]')";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}

function setDataDatabaseJurusan($kd,$data){
	$sql = "UPDATE `t_jurusan` SET kode_jurusan='$data[0]', nama_jurusan='$data[1]', kode_fakultas='$data[2]', kode_depan_mata_kuliah= '$data[3]' WHERE t_jurusan.kode_jurusan = '$kd'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}

function removeDataDatabaseFakultas($kd){
	$sql = "DELETE FROM `t_fakultas` WHERE `kode_fakultas` = '$kd'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}
function addDataDatabaseFakultas($data){
	$sql="INSERT INTO `t_fakultas` (`kode_fakultas`,`nama_fakultas`)VALUES ('$data[0]', '$data[1]')";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}

function setDataDatabaseFakultas($kd,$data){
	$sql = "UPDATE `t_fakultas` SET kode_fakultas='$data[0]', nama_fakultas='$data[1]' WHERE kode_fakultas = '$kd'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}
function getTabelDatabaseJurusan($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM t_jurusan ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM t_jurusan WHERE ".$searchin." LIKE '%".$search."%' ORDER BY ".$orderby." ".$order;
			}
			$s = '<div>'.$s;
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>programs code</th><th width="25%">programs name</th><th>faculty code</th><th>subject code</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$kj = $row['kode_jurusan'];
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$kj.'</b></td><td><b>'
				.$row['nama_jurusan'].'</b></td><td id="center"><b>'
				.$row['kode_fakultas'].'</b></td><td id="center"><b>'
				.$row['kode_depan_mata_kuliah'].'</b></td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_jf(3,\''.$kj.'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_jf(2,\''.$kj.'\')" href="#!">&nbsp;</a><a href="#!"><a id="x" onclick="javascript:edit_db_jf(4,\''.$kj.'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table>';
			//if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}

			//else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
$mk=$mk.'<br>';
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_jf\','.$i.');">'.$i.'</a>&nbsp;';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}
function getTabelDatabaseFakultas($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM t_fakultas ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM t_fakultas WHERE ".$searchin." LIKE '%".$search."%' ORDER BY ".$orderby." ".$order;
			}
			$s = '<div>'.$s;
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>faculty code</th><th>faculty code</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$kj = $row['kode_fakultas'];
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$kj.'</b></td><td><b>'
				.$row['nama_fakultas'].'</b></td><td id="center"><b>'
				.'<a id="v" onclick="javascript:edit_db_jf2(3,\''.$kj.'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_jf2(2,\''.$kj.'\')" href="#!">&nbsp;</a><a href="#!"><a id="x" onclick="javascript:edit_db_jf2(4,\''.$kj.'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table>';
			//if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}

			//else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
$mk=$mk.'<br>';
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_jf2\','.$i.');">'.$i.'</a>&nbsp;';}
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
function getDataDatabaseJurusan($kd){
			$sql = "SELECT * FROM t_jurusan WHERE kode_jurusan = '$kd'";
			$rs = mysql_query($sql);
			$data;
			while($row = mysql_fetch_array($rs)){
				$data['kode_jurusan'] = $row['kode_jurusan'];
				$data['nama_jurusan'] = $row['nama_jurusan'];
				$data['kode_fakultas'] = $row['kode_fakultas'];
				$data['kode_depan_mata_kuliah'] = $row['kode_depan_mata_kuliah'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}
function getDataDatabaseFakultas($kd){
			$sql = "SELECT * FROM t_fakultas WHERE kode_fakultas = '$kd'";
			$rs = mysql_query($sql);
			$data;
			while($row = mysql_fetch_array($rs)){
				$data['kode_fakultas'] = $row['kode_fakultas'];
				$data['nama_fakultas'] = $row['nama_fakultas'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
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
?>