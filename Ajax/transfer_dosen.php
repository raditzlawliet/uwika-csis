<?php
session_start();
include '../config.php';
include 'calc.php';

function getTabelDatabaseDosen($search,$searchin,$orderby,$order,$color){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM t_dosen ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM t_dosen WHERE ".$searchin." LIKE '%".$search."%' ORDER BY ".$orderby." ".$order;
			}
			$s = '<div>'.$s;
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>NRP</th><th width="25%">Name</th><th>Gender</th><th>Fakultas/Jurusan</th><th>Admin</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$datafj = getFakultasJurusan($row['kode_jurusan_prioritas']);
				$nrp = $row['nrp'];
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$nrp.'</b></td><td><b>'
				.$row['nama'].'</b></td><td id="center">'
				.$row['jenis_kelamin'].'</td><td id="center">'
				.$datafj['nama_fakultas'].' '.$datafj['nama_jurusan'].'</td><td id="center">'
				.$row['admin'].'</td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_m(3,\''.$nrp.'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_m(2,\''.$nrp.'\')" href="#!">&nbsp;</a><a href="#!"><a id="x" onclick="javascript:edit_db_m(4,\''.$nrp.'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table>';
			if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div>';}
			else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div>';}
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