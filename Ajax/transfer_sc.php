<?php
include '../config.php';
include 'calc.php';
function getMasaNow(){
	$t_thn = getValueSettingsOf('tahun');
	$t_sms = getValueSettingsOf('semester');
	return getMasa($t_thn,$t_sms);
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
function getLastSemester($nrp){
	$sql = "select semester from t_mahasiswa where nrp = $nrp";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$data = $row['semester'];
	}
	mysql_free_result($rs);
	unset($sql, $rs);
	return $data;
}
function removeDataDatabaseIPS($kd,$s){
	$sql = "DELETE FROM `t_ips` WHERE `nrp` = '$kd' AND `semester` = '$s'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}
function addDataDatabaseIPS($data){
	$sql="INSERT INTO `t_ips` (`nrp`,`semester`,`ips`)VALUES ('$data[0]', '$data[1]', '$data[2]')";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}

function setDataDatabaseIPS($kd,$s,$data){
	$sql = "UPDATE `t_ips` SET nrp='$data[0]', semester='$data[1]', ips='$data[2]' WHERE nrp= '$kd' AND semester= '$s'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}

function removeDataDatabaseNilai($kd,$nrp,$data){
	$sql = "DELETE FROM `t_nilai` WHERE kode_mata_kuliah = '$kd' AND nrp = '$nrp' AND masa = '$data[0]'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}
function addDataDatabaseNilai($data){
	$sql="INSERT INTO `t_nilai` (`kode_mata_kuliah`,`nrp`,`masa`,`semester`,`nilai`)VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]')";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}

function setDataDatabaseNilai($kd,$nrp,$data){
	$sql = "UPDATE `t_nilai` SET kode_mata_kuliah='$data[0]', nrp='$data[1]', masa='$data[2]', semester='$data[3]', nilai='$data[4]' WHERE kode_mata_kuliah = '$kd' AND nrp = '$nrp' AND masa = '$data[5]'";
	if (!mysql_query($sql))
	  {		
		  die('Error: ' . mysql_error().'');
	  }
	unset($sql);
}

function getTabelDatabaseNilai($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM t_nilai ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM t_nilai WHERE ".$searchin." LIKE '%".$search."%' ORDER BY ".$orderby." ".$order;
			}
			$s = '<div>'.$s;
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>Subject Code</th><th width="25%">Subject Name</th><th>NRP</th><th>Student Name</th><th>Moment</th><th>SMS</th><th>Score</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$kj = $row['kode_mata_kuliah'];
				$nrp = $row['nrp'];
				$nama=getName($nrp);
				$knama=getNameMK($kj);
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$kj.'</b></td><td><b>'
				.$knama.'</b></td><td id="center"><b>'
				.$nrp.'</b></td><td id="center"><b>'
				.$nama.'</b></td><td id="center"><b>'
				.$row['masa'].'</b></td><td id="center"><b>'
				.$row['semester'].'</b></td><td id="center"><b>'
				.$row['nilai'].'</b></td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_sc2(3,\''.$kj.'\',\''.$nrp.'\',\''.$row['masa'].'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_sc2(2,\''.$kj.'\',\''.$nrp.'\',\''.$row['masa'].'\')" href="#!">&nbsp;</a><a href="#!"><a id="x" onclick="javascript:edit_db_sc2(4,\''.$kj.'\',\''.$nrp.'\',\''.$row['masa'].'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table>';
			//if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}

			//else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
$mk=$mk.'<br>';
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_sc2\','.$i.');">'.$i.'</a>&nbsp;';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}
function getTabelDatabaseIPS($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM t_ips ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM t_ips WHERE ".$searchin." LIKE '%".$search."%' ORDER BY ".$orderby." ".$order;
			}
			$s = '<div>'.$s;
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>NRP</th><th width="25%">name</th><th>semester</th><th>ips score</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$kj = $row['nrp'];
				$nama=getName($kj);
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$kj.'</b></td><td><b>'
				.$nama.'</b></td><td id="center"><b>'
				.$row['semester'].'</b></td><td id="center"><b>'
				.$row['ips'].'</b></td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_sc(3,\''.$kj.'\',\''.$row['semester'].'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_sc(2,\''.$kj.'\',\''.$row['semester'].'\')" href="#!">&nbsp;</a><a href="#!"><a id="x" onclick="javascript:edit_db_sc(4,\''.$kj.'\',\''.$row['semester'].'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table>';
			//if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}

			//else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
$mk=$mk.'<br>';
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_sc\','.$i.');">'.$i.'</a>&nbsp;';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}

function getName($nrp){$sql = "SELECT nama FROM t_mahasiswa WHERE nrp='$nrp'";$rs = mysql_query($sql);$data;while($row = mysql_fetch_array($rs)){$data= $row['nama'];}mysql_free_result($rs);unset($sql, $rs);return $data;}
function getNameMK($nrp){$sql = "SELECT nama_mata_kuliah FROM t_mata_kuliah WHERE kode_mata_kuliah='$nrp'";$rs = mysql_query($sql);$data;while($row = mysql_fetch_array($rs)){$data= $row['nama_mata_kuliah'];}mysql_free_result($rs);unset($sql, $rs);return $data;}

function getDataDatabaseIPS($kd,$s){
			$sql = "SELECT * FROM t_ips WHERE nrp = '$kd' and semester = '$s'";
			$rs = mysql_query($sql);
			$data;
			while($row = mysql_fetch_array($rs)){
				$data['nrp'] = $row['nrp'];
				$data['nama'] = getName($data['nrp']);
				$data['semester'] = $row['semester'];
				$data['ips'] = $row['ips'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}
function getDataDatabaseNilai($kd,$nrp,$m){
			$sql = "SELECT * FROM t_nilai WHERE kode_mata_kuliah= '$kd' and nrp= '$nrp' and masa='$m'";
			$rs = mysql_query($sql);
			$data;
			while($row = mysql_fetch_array($rs)){
				$data['kode_mata_kuliah'] = $row['kode_mata_kuliah'];
				$data['nama_mata_kuliah'] = getNameMK($data['kode_mata_kuliah']);
				$data['nrp'] = $row['nrp'];
				$data['nama'] = getName($data['nrp']);
				$data['masa'] = $row['masa'];
				$data['semester'] = $row['semester'];
				$data['nilai'] = $row['nilai'];
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}
?>