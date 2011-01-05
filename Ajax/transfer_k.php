<?php
include '../config.php';
include 'calc.php';
function getDataDatabaseKaryawan($nrp){
			$sql = "SELECT * FROM t_karyawan WHERE nrp = '$nrp'";
			$rs = mysql_query($sql);
			$data;
			while($row = mysql_fetch_array($rs)){
				$data['nrp'] = $row['nrp'];
				$data['password'] = $row['password'];	
				$data['nama'] = $row['nama'];	
				$data['aka'] = $row['aka'];	
				$data['jenis_kelamin'] = $row['jenis_kelamin'];	
				$data['uid'] = $row['uid'];	
				$data['admin'] = $row['admin'];	
			}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $data;
}
function removeDataDatabaseKaryawan($nrp){
	$sql = "DELETE FROM `t_karyawan` WHERE `nrp` = '$nrp'";
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
function addDataDatabaseKaryawan($nrp,$data,$set){
	$sql="INSERT INTO `t_karyawan` (`nrp` ,`password` ,`nama` ,`aka` ,`jenis_kelamin`,`uid` ,`admin`)VALUES ('$data[0]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]')";
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

function setDataDatabaseKaryawan($nrp,$data,$set){
	$k = 1;if($set)$k=2;
	$sql = "UPDATE `t_karyawan` SET nrp='$data[0]',password='$data[2]',nama='$data[3]',aka= '$data[4]',jenis_kelamin='$data[5]',uid='$data[6]',admin='$data[7]' WHERE nrp = '$nrp'";
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

function getTabelDatabaseKaryawan($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM t_karyawan ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM t_karyawan WHERE ".$searchin." LIKE '%".$search."%' ORDER BY ".$orderby." ".$order;
			}
			$s = '<div>'.$s;
			$rs = mysql_query($sql);$count = mysql_num_rows($rs);$pages = ceil($count/30);
			mysql_free_result($rs);unset($rs);
			$sql=$sql." LIMIT ".$start.",30";
			$rs = mysql_query($sql);
			$mk = '<table id="db" class="'.$color.'">
			<tr id="header_table"><th>NRP</th><th width="25%">Name</th><th>AKA</th><th>Gender</th><th>Admin</th><th>ActION</tr></tr>
			';
			$k = 0;
			while($row = mysql_fetch_array($rs)){
				$tr = '';
				if(($k%2)==1){
					$tr = ' id="diff" ';
				}
				$nrp = $row['nrp'];
				$mk = $mk
				.'<tr'.$tr.' height="20px"><td id="center"><b>'
				.$nrp.'</b></td><td><b>'
				.$row['nama'].'</b></td><td id="center">'
				.$row['aka'].'</b></td><td id="center">'
				.$row['jenis_kelamin'].'</td><td id="center">'
				.$row['admin'].'</td><td id="center">'
				.'<a id="v" onclick="javascript:edit_db_k(3,\''.$nrp.'\')" href="#!">&nbsp;</a><a href="#!"><a id="e" onclick="javascript:edit_db_k(2,\''.$nrp.'\')" href="#!">&nbsp;</a><a href="#!"><a id="x" onclick="javascript:edit_db_k(4,\''.$nrp.'\')" href="#!">&nbsp;</a></td>'
				.'</tr>';
				$k++;
			}
			$mk = $mk.'</table>';
			//if($k==0){$mk = $s.' has Return <b>Zero</b> of Searching / Sorting</div><br>';}

			//else{if($k==1){$nm="Data";}else{$nm="Datas";}$mk = $mk.$s.' has Return <b>'.$k.'</b> '.$nm.'</div><br>';}
$mk=$mk.'<br>';
			if(is_null($color)||$color==""){$color="green";}for($i=1; $i<=$pages; $i++){$mk=$mk.'<a id="'.$color.'" class="submit" href="#!" onclick="javascript:searchpage(\'db_k\','.$i.');">'.$i.'</a>&nbsp;';}
			mysql_free_result($rs);
			unset($sql, $rs);
			return $mk;
}

?>