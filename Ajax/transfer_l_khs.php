<?php
include '../config.php';
include 'calc.php';
function getAllDataMahasiswa(){
	$sql = "select nrp from t_mahasiswa";
	$rs = mysql_query($sql);
	$k=0;
	while($row = mysql_fetch_array($rs)){
		$data[$k] = $row['nrp'];
		$k++;
	}
	$data['k'] = $k;
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
				$data['angkatan'] = getAngkatanFromNrp($data['nrp']);
				$data['ipk'] = $row['ipk'];	
				$data['sisa_sks'] = $row['sisa_sks'];
				$data['sks_awal'] = $row['sks_awal'];
				$data['uid'] = $row['uid'];	
				$data['admin'] = $row['admin'];	
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}

function getTabelDatabaseListMataKuliahPerMahasiswa($search,$searchin,$orderby,$order,$color,$start,$limit,$show,$search2){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM tr_mata_kuliah_mahasiswa JOIN t_mata_kuliah ON tr_mata_kuliah_mahasiswa.kode_mata_kuliah=t_mata_kuliah.kode_mata_kuliah ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$r2='';
				if($search2[0]['q']>=1){for($i = 0;$i<$search2[0]['q'];$i++){if($i==0){$search2[$i]["c"]="AND";}if($search2[$i]['o']=="LIKE"){$search2[$i]['v']="%".$search2[$i]['v']."%";}$r2=$r2.$search2[$i]["c"]." ".$search2[$i]['s']." ".$search2[$i]['o']." '".$search2[$i]['v']."' ";}}
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM tr_mata_kuliah_mahasiswa JOIN t_mata_kuliah ON tr_mata_kuliah_mahasiswa.kode_mata_kuliah=t_mata_kuliah.kode_mata_kuliah WHERE ".$searchin." = '".$search."' ".$r2."ORDER BY ".$orderby." ".$order;
				
			}
			$s = '<div>'.$s;
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			if($limit=="true"){
			$sql=$sql." LIMIT ".$start.",30";}
			$rs = mysql_query($sql);
			$array = array(0=>"Kode MK",1=>"Nama Mata Kuliah",2=>"SKS",3=>"Hari",4=>"Jam Mulai",5=>"Jam Selesai",6=>"Semester [M]",7=>"Masa",8=>"Hari R",9=>"Jam R",10=>"Tanggal R",11=>"Nilai",12=>"Lulus");$array2 = array(0=>"kode_mata_kuliah",1=>"nama_mata_kuliah",2=>"jumlah_sks",3=>"hari",4=>"jam_mulai",5=>"jam_selesai",6=>"semester",7=>"masa",8=>"hari_register",9=>"time_register",10=>"tanggal_register",11=>"nilai",12=>"lulus");$array3 = array(0=>"id=\"center\"",1=>"",2=>"id=\"center\"",3=>"id=\"center\"",4=>"id=\"center\"",5=>"id=\"center\"",6=>"id=\"center\"",7=>"id=\"center\"",8=>"id=\"center\"",9=>"id=\"center\"",10=>"id=\"center\"",11=>"id=\"center\"",12=>"id=\"center\"");
			for($i=0;$i<13;$i++){if($show[$i]=="true"){$ht=$ht."<th >".$array[$i]."</th>";}}
			$data_profile = getDataDatabaseMahasiswa($search);
			$mk = $mk.'<br><table id="db" class="'.$color.'">
			<tr><td style="width:6%;"><b>NRP </b></td><td style="width:2%;">:</td><td style="width:30%;">'.$data_profile['nrp'].'</td>
			<td style="width:20%;"><b>Fakultas - Jurusan </b></td><td style="width:2%;">:</td><td style="width:23%;">'.$data_profile['nama_fakultas'].' - '.$data_profile['nama_jurusan'].'</td></tr>
			<tr><td><b>Nama </b></td><td>:</td><td>'.$data_profile['nama'].'</td>
			<td><b>Semester - Angkatan </b></td><td>:</td><td>'.$data_profile['semester'].' - '.$data_profile['angkatan'].'</td></tr>
			<tr><td>____</td><td>:</td><td></td><td><b>SKS (Auto) - Sisa SKS</td><td>:</td><td>'.$data_profile['sks_awal'].' - '.$data_profile['sisa_sks'].'</td></tr>
			</table><br> 
			';
			$mk = $mk.'<table id="db" class="'.$color.'"><tr id="header_table">'.$ht.'</tr> 	';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$mk = $mk.'<tr'.$tr.' height="20px">';
				for($i = 0;$i<13;$i++){if($show[$i]=="true"){
if(($i==3)||($i==8)){
$mk=$mk.'<td '.$array3[$i].'><b>'.getHari($row[$array2[$i]]).'</b></td>';}else{$mk=$mk.'<td '.$array3[$i].'><b>'.$row[$array2[$i]].'</b></td>';}}}
				$mk=$mk.'</tr>';
				$k++;
			}
			$mk = $mk.'</table><br>';
			if(is_null($color)||$color==""){$color="green";}if($limit=="true"){for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_l_m\','.$i.');">'.$i.'</a>&nbsp;';}}
			mysql_free_result($rs);
			unset($sql, $rs);
			if($k==0){$mk=$mk."Isi NRP mahasiswa dengan benar, agar list bisa tertampilkan / List Kosong Tak ada yang terdaftar.";}
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
function getDataDatabaseDosen($nrp){
			$sql = "SELECT * FROM t_dosen WHERE nrp = '$nrp'";
			$rs = mysql_query($sql);
			$data;
			while($row = mysql_fetch_array($rs)){
				$data['nrp'] = $row['nrp'];
				$data['password'] = $row['password'];	
				$data['nama'] = $row['nama'];	
				$data['aka'] = $row['aka'];	
				$data['jenis_kelamin'] = $row['jenis_kelamin'];	
				$data['kode_jurusan_prioritas'] = $row['kode_jurusan_prioritas'];
				$a = getFakultasJurusan($data['kode_jurusan_prioritas']);
				$data['nama_jurusan'] = $a['nama_jurusan'];
				$data['kode_fakultas'] = $a['kode_fakultas'];
				$data['nama_fakultas'] = $a['nama_fakultas'];
				$data['uid'] = $row['uid'];	
				$data['admin'] = $row['admin'];	
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