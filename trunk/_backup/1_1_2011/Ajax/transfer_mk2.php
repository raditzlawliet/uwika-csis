<?php
include '../config.php';
include 'calc.php';
function setDataDatabaseMataKuliah($kode_mk,$data,$x){
	$sql="UPDATE t_mata_kuliah SET kode_mata_kuliah = '$data[0]',`nama_mata_kuliah` = '$data[1]',`jumlah_sks` = '$data[2]',`probis` = '$data[3]',`hari` = '$data[4]',`jam_mulai` = '$data[5]',`jam_selesai` = '$data[6]' WHERE `kode_mata_kuliah` = '$kode_mk'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}
	unset($sql);
	if($x=="true"){
	$sql="UPDATE tr_mata_kuliah_jurusan SET kode_mata_kuliah = '$data[0]' WHERE `kode_mata_kuliah` = '$kode_mk'";if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);
	$sql="UPDATE tr_mata_kuliah_dosen SET kode_mata_kuliah = '$data[0]' WHERE `kode_mata_kuliah` = '$kode_mk'";if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);
	$sql="UPDATE tr_mata_kuliah_mahasiswa SET kode_mata_kuliah = '$data[0]' WHERE `kode_mata_kuliah` = '$kode_mk'";if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);
	$sql="UPDATE tr_mata_kuliah_syarat SET kode_mata_kuliah = '$data[0]' WHERE `kode_mata_kuliah` = '$kode_mk'";if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);
	}
}
function addDataDatabaseMataKuliah($data){
	$sql = "INSERT INTO `t_mata_kuliah` (`kode_mata_kuliah`, `nama_mata_kuliah`, `jumlah_sks`, `probis`, `hari`, `jam_mulai`, `jam_selesai`) VALUES ('$data[0]','$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]');";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}
	unset($sql);
}
function removeDataDatabaseMataKuliah($kode_mk,$x){
	$sql = "DELETE FROM `t_mata_kuliah` WHERE `kode_mata_kuliah` = '$kode_mk'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}
	unset($sql);
	if($x=="true"){
	$sql = "DELETE FROM `tr_mata_kuliah_jurusan` WHERE `kode_mata_kuliah` = '$kode_mk'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}
	unset($sql);
	$sql = "DELETE FROM `tr_mata_kuliah_dosen` WHERE `kode_mata_kuliah` = '$kode_mk'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}
	unset($sql);
	$sql = "DELETE FROM `tr_mata_kuliah_syarat` WHERE `kode_mata_kuliah` = '$kode_mk'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}
	unset($sql);
	$sql = "DELETE FROM `tr_mata_kuliah_mahasiswa` WHERE `kode_mata_kuliah` = '$kode_mk'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}
	unset($sql);
	}
}
function getLastCode($kode_mk){$sql = "SELECT * FROM t_mata_kuliah WHERE kode_mata_kuliah LIKE '%".$kode_mk."%' ORDER BY kode_mata_kuliah DESC limit 1";
$rs = mysql_query($sql);$data;while($row = mysql_fetch_array($rs)){$data = $row['kode_mata_kuliah'];}mysql_free_result($rs);unset($sql, $rs);return $data;}

function getDataMataKuliahTRJurusan($kode_mk){
		$sql = "SELECT * FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_jurusan AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_jurusan as t ON t.kode_jurusan=j.kode_jurusan WHERE m.kode_mata_kuliah = '$kode_mk'";
		$rs = mysql_query($sql);
		$data;$k=0;
		while($row = mysql_fetch_array($rs)){
			$data[$k]['kode_jurusan'] = $row['kode_jurusan'];	
			$data[$k]['semester'] = $row['semester'];
			$data[$k]['nama_jurusan'] =  $row['nama_jurusan'];
			$k++;$data['k']=$k;
		}
		mysql_free_result($rs);
		unset($sql, $rs);
		return $data;
}
function getDataMataKuliahTRDosen($kode_mk){
		$sql = "SELECT * FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_dosen AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_dosen as t ON t.nrp=j.nrp WHERE m.kode_mata_kuliah = '$kode_mk'";
		$rs = mysql_query($sql);
		$data;$k=0;
		while($row = mysql_fetch_array($rs)){
			$data[$k]['nrp'] = $row['nrp'];	
			$data[$k]['nama'] = $row['nama'];	
			$k++;$data['k']=$k;
		}
		mysql_free_result($rs);
		unset($sql, $rs);
		return $data;
}
function getDataMataKuliahTRMahasiswa($kode_mk){
		$sql = "SELECT t.nrp,t.nama,j.semester,j.masa,j.hari_register,j.time_register,j.tanggal_register,j.nilai,j.lulus FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_mahasiswa AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_mahasiswa as t ON t.nrp=j.nrp WHERE m.kode_mata_kuliah = '$kode_mk' ORDER BY masa DESC";
		$rs = mysql_query($sql);
		$data;$k=0;
		while($row = mysql_fetch_array($rs)){
			$data[$k]['nrp'] = $row['nrp'];	
			$data[$k]['nama'] = $row['nama'];	
			$data[$k]['masa'] = $row['masa'];	
			$data[$k]['semester'] = $row['semester'];
			$data[$k]['nilai'] = $row['nilai'];	
			$data[$k]['lulus'] = $row['lulus'];	
			$k++;$data['k']=$k;
		}
		mysql_free_result($rs);
		unset($sql, $rs);
		return $data;
}
function getDataMataKuliahTRSyarat($kode_mk){
		$sql = "SELECT n.nama_mata_kuliah,kode_mata_kuliah_syarat,kode_syarat FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_syarat AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_mata_kuliah AS n ON j.kode_mata_kuliah_syarat=n.kode_mata_kuliah WHERE m.kode_mata_kuliah = '$kode_mk'";
		$rs = mysql_query($sql);
		$data;$k=0;
		while($row = mysql_fetch_array($rs)){
			$data[$k]['nama_mata_kuliah'] = $row['nama_mata_kuliah'];
			$data[$k]['kode_mata_kuliah_syarat'] = $row['kode_mata_kuliah_syarat'];	
			$data[$k]['kode_syarat'] = $row['kode_syarat'];	
			$k++;$data['k']=$k;
		}
		mysql_free_result($rs);
		unset($sql, $rs);
		return $data;
}
function getNamaJurusan($k){$sql = "SELECT * FROM `t_jurusan` WHERE kode_jurusan='$k'";$rs = mysql_query($sql);$data;while($row = mysql_fetch_array($rs)){$data = $row['nama_jurusan'];}mysql_free_result($rs);unset($sql, $rs);return $data;}

function getDatabaseJurusanALL(){
	$sql = "SELECT * FROM `t_jurusan` ORDER BY kode_fakultas ASC";
	$rs = mysql_query($sql);
	$data; $k = 0;
	while($row = mysql_fetch_array($rs)){
		$data[$k]['kode_fakultas'] = $row['kode_fakultas'];
		$data[$k]['kode_jurusan'] = $row['kode_jurusan'];
		$data[$k]['nama_jurusan'] = $row['nama_jurusan'];
		$data[$k]['kode_depan_mata_kuliah'] = $row['kode_depan_mata_kuliah'];
		$data['k'] = $k; $k++;
	}
	mysql_free_result($rs);
	unset($sql, $rs);
	return $data;
}

function getTabelDatabaseMataKuliah_Syarat($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT a.kode_mata_kuliah, q.nama_mata_kuliah, a.kode_mata_kuliah_syarat, qq.nama_mata_kuliah AS nama, a.kode_syarat FROM tr_mata_kuliah_syarat AS a JOIN t_mata_kuliah AS q ON a.kode_mata_kuliah = q.kode_mata_kuliah JOIN t_mata_kuliah AS qq ON a.kode_mata_kuliah_syarat = qq.kode_mata_kuliah ORDER BY a.".$orderby." ".$order; if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT a.kode_mata_kuliah, q.nama_mata_kuliah, a.kode_mata_kuliah_syarat, qq.nama_mata_kuliah AS nama, a.kode_syarat FROM tr_mata_kuliah_syarat AS a JOIN t_mata_kuliah AS q ON a.kode_mata_kuliah = q.kode_mata_kuliah JOIN t_mata_kuliah AS qq ON a.kode_mata_kuliah_syarat = qq.kode_mata_kuliah WHERE a.".$searchin." LIKE '%".$search."%' ORDER BY a.".$orderby." ".$order;
			}
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$s = '<div>'.$s;
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>subject code</th><th width="40%">subject name</th><th>subject code requirement</th><th width="40%">subject name requrement</th><th>requirement code</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$kode_mk = $row['kode_mata_kuliah'];
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$kode_mk.'</b></td><td>'
				.$row['nama_mata_kuliah'].'</td><td id="center"><b>'
				.$row['kode_mata_kuliah_syarat'].'</b></td><td>'
				.$row['nama'].'</td><td id="center">'
				.$row['kode_syarat'].'</td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_mk(3,\''.$kode_mk.'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_mk(2,\''.$kode_mk.'\')" href="#!">&nbsp;</a><a id="x" onclick="javascript:del_mk_s_x(\''.$kode_mk.'\',\''.$row['kode_mata_kuliah_syarat'].'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table><script>function del_mk_s_x(kd_mk,kd_mk2){
						var x = confirm("Are you want to delete this data ("+kd_mk+" - "+kd_mk2+") ?");
						if(x){
							$.post("Ajax/database_db_mk.php",{code:"del_mk_s", kode_mk:kd_mk, value:kd_mk2}, function(data) {
								alert(data);
								search(\'db_mk_s\');
							});	
					}
				}</script>';
			if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}
			else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_mk_s\','.$i.');">'.$i.'</a>&nbsp;';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}

function getTabelDatabaseMataKuliah_Mahasiswa($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM tr_mata_kuliah_mahasiswa as mkm JOIN t_mahasiswa as m ON mkm.nrp=m.nrp JOIN t_mata_kuliah as mk ON mkm.kode_mata_kuliah = mk.kode_mata_kuliah ORDER BY mkm.".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM tr_mata_kuliah_mahasiswa as mkm JOIN t_mahasiswa as m ON mkm.nrp=m.nrp JOIN t_mata_kuliah as mk ON mkm.kode_mata_kuliah = mk.kode_mata_kuliah WHERE mkm.".$searchin." LIKE '%".$search."%' ORDER BY mkm.".$orderby." ".$order;
			}
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$s = '<div>'.$s;
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>subject code</th><th width="25%">subject name</th><th>student nrp</th><th width="15%">student name</th><th>sms</th><th>moment</th><th>date register</th><th>S</th><th>V</th><th>ActION</tr></tr>
			';
			$status = array("x"=>'<img src="images/x.png" width="15px"\ title="Not Graduated">',
							"v"=>'<img src="images/v.png" width="15px"\ title="Graduated">');
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$kode_mk = $row['kode_mata_kuliah'];
				$probis; if($row['probis']=="0"){$probis="No";}else{$probis="Yes";}
				$lls; if($row['lulus']=="1"){$lls="v";}else{$lls="x";}
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$kode_mk.'</b></td><td>'
				.$row['nama_mata_kuliah'].'</td><td id="center"><b>'
				.$row['nrp'].'</b></td><td>'
				.$row['nama'].'</td><td id="center">'
				.$row['semester'].'</td><td id="center">'
				.$row['masa'].'</td><td id="center">'
				.$row['tanggal_register'].'</td><td id="center">'
				.$row['nilai'].'</td><td id="center">'
				.$status[$lls].'</td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_mk(3,\''.$kode_mk.'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_mk(2,\''.$kode_mk.'\')" href="#!">&nbsp;</a><a href="#!"><a id="x" onclick="javascript:del_mk_m_x(\''.$kode_mk.'\',\''.$row['nrp'].'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table><script>function del_mk_m_x(kd_mk,nrp){
						var x = confirm("Are you want to delete this data ("+kd_mk+" - "+nrp+") ?");
						if(x){
							$.post("Ajax/database_db_mk.php",{code:"del_mk_m", kode_mk:kd_mk, value:nrp}, function(data) {
								alert(data);
								search(\'db_mk_m\');
							});	
					}
				}</script>';
			if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}
			else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_mk_m\','.$i.');">'.$i.'</a>&nbsp;';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}
function delOneDataMataKuliahTRMahasiswa($kode_mk,$nrp){
	$sql="DELETE FROM `tr_mata_kuliah_mahasiswa`  WHERE `kode_mata_kuliah` = '$kode_mk' AND nrp='$nrp'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function delOneDataMataKuliahTRSyarat($kode_mk,$kode_mk_syarat){
	$sql="DELETE FROM `tr_mata_kuliah_syarat`  WHERE `kode_mata_kuliah` = '$kode_mk' AND kode_mata_kuliah_syarat = '$kode_mk_syarat'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function delOneDataMataKuliahTRDosen($kode_mk,$nrp){
	$sql="DELETE FROM `tr_mata_kuliah_dosen`  WHERE `kode_mata_kuliah` = '$kode_mk' AND nrp='$nrp'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function delOneDataMataKuliahTRJurusan($kode_mk,$kode_jurusan){
	$sql="DELETE FROM `tr_mata_kuliah_jurusan`  WHERE `kode_mata_kuliah` = '$kode_mk' AND kode_jurusan='$kode_jurusan'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}	

function getTabelDatabaseMataKuliah_Jurusan($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM tr_mata_kuliah_jurusan as mkj JOIN t_jurusan as j ON mkj.kode_jurusan=j.kode_jurusan JOIN t_mata_kuliah as mk ON mkj.kode_mata_kuliah = mk.kode_mata_kuliah ORDER BY mkj.".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM tr_mata_kuliah_jurusan as mkj JOIN t_jurusan as j ON mkj.kode_jurusan=j.kode_jurusan JOIN t_mata_kuliah as mk ON mkj.kode_mata_kuliah = mk.kode_mata_kuliah WHERE mkj.".$searchin." LIKE '%".$search."%' ORDER BY mkj.".$orderby." ".$order;
			}
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$s = '<div>'.$s;
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>subject code</th><th width="40%">subject name</th><th>jurusan code</th><th width="40%">jurusan name</th><th>semester</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$kode_mk = $row['kode_mata_kuliah'];
				$probis; if($row['probis']=="0"){$probis="No";}else{$probis="Yes";}
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$kode_mk.'</b></td><td>'
				.$row['nama_mata_kuliah'].'</td><td id="center"><b>'
				.$row['kode_jurusan'].'</b></td><td id="center">'
				.$row['nama_jurusan'].'</td><td id="center">'
				.$row['semester'].'</td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_mk(3,\''.$kode_mk.'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_mk(2,\''.$kode_mk.'\')" href="#!">&nbsp;</a><a href="#!"><a id="x" onclick="javascript:del_mk_j_x(\''.$kode_mk.'\',\''.$row['kode_jurusan'].'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table><script>function del_mk_j_x(kd_mk,nrp){
						var x = confirm("Are you want to delete this data ("+kd_mk+" - "+nrp+") ?");
						if(x){
							$.post("Ajax/database_db_mk.php",{code:"del_mk_j", kode_mk:kd_mk, value:nrp}, function(data) {
								alert(data);
								search(\'db_mk_j\');
							});	
					}
				}</script>';
			if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}
			else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_mk_j\','.$i.');">'.$i.'</a>&nbsp;';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}
function getTabelDatabaseMataKuliah_Dosen($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM tr_mata_kuliah_dosen as mkd JOIN t_dosen as d ON mkd.nrp=d.nrp JOIN t_mata_kuliah as mk ON mkd.kode_mata_kuliah = mk.kode_mata_kuliah ORDER BY mkd.".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM tr_mata_kuliah_dosen as mkd JOIN t_dosen as d ON mkd.nrp=d.nrp JOIN t_mata_kuliah as mk ON mkd.kode_mata_kuliah = mk.kode_mata_kuliah WHERE mkd.".$searchin." LIKE '%".$search."%' ORDER BY mkd.".$orderby." ".$order;
			}
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$s = '<div>'.$s;
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>code</th><th width="40%">subject name</th><th>faculty nrp</th><th width="40%">faculty name</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$kode_mk = $row['kode_mata_kuliah'];
				$probis; if($row['probis']=="0"){$probis="No";}else{$probis="Yes";}
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$kode_mk.'</b></td><td>'
				.$row['nama_mata_kuliah'].'</td><td id="center"><b>'
				.$row['nrp'].'</b></td><td>'
				.$row['nama'].'</td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_mk(3,\''.$kode_mk.'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_mk(2,\''.$kode_mk.'\')" href="#!">&nbsp;</a><a id="x" onclick="javascript:del_mk_d_x(\''.$kode_mk.'\',\''.$row['nrp'].'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table><script>function del_mk_d_x(kd_mk,nrp){
						var x = confirm("Are you want to delete this data ("+kd_mk+" - "+nrp+") ?");
						if(x){
							$.post("Ajax/database_db_mk.php",{code:"del_mk_d", kode_mk:kd_mk, value:nrp}, function(data) {
								alert(data);
								search(\'db_mk_d\');
							});	
					}
				}</script>';
			if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}
			else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_mk_d\','.$i.');">'.$i.'</a>&nbsp;';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}

function getTabelDatabaseMataKuliah($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM t_mata_kuliah ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM t_mata_kuliah WHERE ".$searchin." LIKE '%".$search."%' ORDER BY ".$orderby." ".$order;
			}
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$s = '<div>'.$s;
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>code</th><th width="40%">Name Subject</th><th>SKS</th><th>Probis ?</th><th>Day</th><th>begin</th><th>end</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$kode_mk = $row['kode_mata_kuliah'];
				$probis; if($row['probis']=="0"){$probis="No";}else{$probis="Yes";}
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$kode_mk.'</b></td><td><b>'
				.$row['nama_mata_kuliah'].'</b></td><td id="center">'
				.$row['jumlah_sks'].' SKS</td><td id="center">'
				.$probis.'</td><td id="center">'
				.getHari($row['hari']).'</td><td id="center">'
				.$row['jam_mulai'].'</td><td id="center">'
				.$row['jam_selesai'].'</td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_mk(3,\''.$kode_mk.'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_mk(2,\''.$kode_mk.'\')" href="#!">&nbsp;</a><a href="#!"><a id="x" onclick="javascript:edit_db_mk(4,\''.$kode_mk.'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table>';
			if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}
			else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_mk\','.$i.');">'.$i.'</a>&nbsp;';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}
function getDataDatabaseMataKuliah($kode_mk){
			$sql = "SELECT * FROM t_mata_kuliah WHERE kode_mata_kuliah = '$kode_mk'";
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
			return $data;
}

?>