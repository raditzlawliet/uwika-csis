<?php
session_start();
include '../config.php';
include 'calc.php';

function getTabelDatabaseMahasiswa($search,$searchin,$orderby,$order,$color){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM t_mahasiswa ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM t_mahasiswa WHERE ".$searchin." LIKE '%".$search."%' ORDER BY ".$orderby." ".$order;
			}
			$s = '<div>'.$s;
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>NRP</th><th width="25%">Name</th><th>Gender</th><th>Code Jurusan</th><th>Class</th><th>SMS</th><th>Remaining SKS</th><th>IPK</th><th>ActION</tr></tr>
			';
			$status = array("e"=>'<img src="images/e.png" width="15px"\ title="Edit / Modify this Data">',
							"x"=>'<img src="images/x.png" width="15px"\ title="Delete this Data">',
							"v"=>'<img src="images/v.png" width="15px"\ title="View this Data">');
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$nrp = $row['nrp'];
				$probis; if($row['probis']=="0"){$probis="Morning";}else{$probis="Bussiness";}
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$nrp.'</b></td><td><b>'
				.$row['nama'].'</b></td><td id="center">'
				.$row['jenis_kelamin'].'</td><td id="center">'
				.$row['kode_jurusan'].'</td><td id="center">'
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
			if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div>';}
			else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div>';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}


?>