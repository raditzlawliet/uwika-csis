<?php
include '../config.php';
include 'calc.php';
function resetIPSsms($nrp,$sms){ //semua ini dgunakan sblum KHS, semester 1 otomatis jg dpt.
		for($i=1;$i<=$sms;$i++){
			$nilai=0.00;
			$jsks=0;
			$ips=0.00;
			$sql2 = "select jumlah_sks,nilai,tr_mata_kuliah_mahasiswa.kode_mata_kuliah from tr_mata_kuliah_mahasiswa JOIN t_mata_kuliah ON tr_mata_kuliah_mahasiswa.kode_mata_kuliah=t_mata_kuliah.kode_mata_kuliah where nrp='$nrp' and semester='$i'";
			$rs2 = mysql_query($sql2);$adamk=0;
			while($row2 = mysql_fetch_array($rs2)){
				$adamk=1;
				$kode_mk=$row2['kode_mata_kuliah'];
				$nil = floatval($row2['nilai']);$gradeh="A+";$gradea=4;
				if($nil<100){$gradeh="A";$gradea=4;}
				if($nil<90){$gradeh="B+";$gradea=3.5;}
				if($nil<80){$gradeh="B";$gradea=3;}
				if($nil<70){$gradeh="C+";$gradea=2.5;}
				if($nil<60){$gradeh="C";$gradea=2;}
				if($nil<50){$gradeh="D";$gradea=1;}
				if($nil<40){$gradeh="E";$gradea=0;}
				$nilai=floatval($nilai+gradea);		$b=$b." nrp : ".$nrp." sms : ".$i." kd : ".$kode_mk." nilai: ".$nilai." sks: ".$jsks;
				$jsks=$jsks+$row2['jumlah_sks'];
			}mysql_free_result($rs2);unset($sql2, $rs2);
			if($adamk==1){$ips=floatval($nilai/$jsks);}else{$ips=0.00;}		$b=$b." nrp : ".$nrp." sms : ".$i." ips: ".$ips." \n";
			$ips=substr($ips,0,4);
			$sql2 = "select * from t_ips where nrp='$nrp' and semester='$i'";
			$rs2 = mysql_query($sql2);$ada=0;
			while($row2 = mysql_fetch_array($rs2)){
				$ada=1;
			}mysql_free_result($rs2);unset($sql2, $rs2);
			if($ada==1){
				$sql2 = "UPDATE `t_ips` SET ips='$ips' WHERE nrp= '$nrp' AND semester= '$i'";
				if (!mysql_query($sql2))
				  {		
					  die('Error: ' . mysql_error().'');
				  }
				unset($sql2);
			}else{
				$sql2="INSERT INTO `t_ips` (`nrp`,`semester`,`ips`)VALUES ('$nrp', '$i', '$ips')";
				if (!mysql_query($sql2))
				  {		
					  die('Error: ' . mysql_error().'');
				  }
				unset($sql2);
			}
			
		}
}

function resetIPSnrp($nrp){ //semua ini dgunakan sblum KHS, semester 1 otomatis jg dpt.
	$sql = "select nrp,semester from t_mahasiswa where nrp='$nrp'";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$nrp = $row['nrp'];
		$sms = $row['semester'];	$b=$b." nrp : ".$nrp." sms: ".$sms."\n";
		for($i=1;$i<=$sms;$i++){
			$nilai=0.00;
			$jsks=0;
			$ips=0.00;
			$sql2 = "select jumlah_sks,nilai,tr_mata_kuliah_mahasiswa.kode_mata_kuliah from tr_mata_kuliah_mahasiswa JOIN t_mata_kuliah ON tr_mata_kuliah_mahasiswa.kode_mata_kuliah=t_mata_kuliah.kode_mata_kuliah where nrp='$nrp' and semester='$i'";
			$rs2 = mysql_query($sql2);$adamk=0;
			while($row2 = mysql_fetch_array($rs2)){
				$adamk=1;
				$kode_mk=$row2['kode_mata_kuliah'];
				$nil = floatval($row2['nilai']);$gradeh="A+";$gradea=4;
				if($nil<100){$gradeh="A";$gradea=4;}
				if($nil<90){$gradeh="B+";$gradea=3.5;}
				if($nil<80){$gradeh="B";$gradea=3;}
				if($nil<70){$gradeh="C+";$gradea=2.5;}
				if($nil<60){$gradeh="C";$gradea=2;}
				if($nil<50){$gradeh="D";$gradea=1;}
				if($nil<40){$gradeh="E";$gradea=0;}
				$nilai=floatval($nilai+($gradea*floatval($row2['jumlah_sks'])));		$b=$b." nrp : ".$nrp." sms : ".$i." kd : ".$kode_mk." nilai: ".$nilai." sks: ".$jsks;
				$jsks=$jsks+$row2['jumlah_sks'];
			}mysql_free_result($rs2);unset($sql2, $rs2);
			if($adamk==1){$ips=floatval($nilai/$jsks);}else{$ips=0.00;}		$b=$b." nrp : ".$nrp." sms : ".$i." ips: ".$ips." \n";
			$ips=substr($ips,0,4);
			$sql2 = "select * from t_ips where nrp='$nrp' and semester='$i'";
			$rs2 = mysql_query($sql2);$ada=0;
			while($row2 = mysql_fetch_array($rs2)){	$ada=1;	}mysql_free_result($rs2);unset($sql2, $rs2);
			if($ada==1){
				$sql2 = "UPDATE `t_ips` SET ips='$ips' WHERE nrp= '$nrp' AND semester= '$i'";
				if (!mysql_query($sql2)){die('Error: ' . mysql_error().'');}unset($sql2);
			}else{
				$sql2="INSERT INTO `t_ips` (`nrp`,`semester`,`ips`)VALUES ('$nrp', '$i', '$ips')";
				if (!mysql_query($sql2)){die('Error: ' . mysql_error().'');}unset($sql2);
			}
			
		}
		
	}
	mysql_free_result($rs);unset($sql, $rs);
}

function resetLulus($v,$nrp,$kode_mk,$masa,$sms){ //semua ini dgunakan sblum KHS, semester 1 otomatis jg dpt.
	$sql="select * from tr_mata_kuliah_mahasiswa";
	switch($v){
		case 1:	{$sql = "select * from tr_mata_kuliah_mahasiswa where nrp='$nrp' "; break;} //nrp
		case 2:	{$sql = "select * from tr_mata_kuliah_mahasiswa where kode_mata_kuliah='$kode_mk' "; break;} //kode_mk
		case 3:	{$sql = "select * from tr_mata_kuliah_mahasiswa where kode_mata_kuliah='$kode_mk' and masa='$masa'"; break;} //kode_mk - masa
		case 4:	{$sql = "select * from tr_mata_kuliah_mahasiswa where masa='$masa'"; break;} //masa
		case 5:	{$sql = "select * from tr_mata_kuliah_mahasiswa where nrp='$nrp' and semester='$sms'"; break;} //nrp-sms
		case 6:	{$sql = "select * from tr_mata_kuliah_mahasiswa where nrp='$nrp' and semester='$sms' and kode_mata_kuliah='$kode_mk'"; break;} //nrp-sms-kode_mk
		case 7: {$sql = "select * from tr_mata_kuliah_mahasiswa";break;}
	}
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$nrp = $row['nrp'];
		$kode_mk = $row['kode_mata_kuliah'];
		$masa = $row['masa'];
		$sms = $row['semester'];
		$n = $row['nilai']; $n = floatval($n+0);
		$l = 0;if($n>=60){$l=1;}
		$sql2= "UPDATE `tr_mata_kuliah_mahasiswa` SET lulus='$l' WHERE nrp= '$nrp' AND kode_mata_kuliah= '$kode_mk' AND masa= '$masa' AND semester= '$sms'";
		if (!mysql_query($sql2)){die('Error: ' . mysql_error().'');}unset($sql2);
		$x=$x." nrp: ".$nrp." kd: ".$kode_mk." masa: ".$masa." sms: ".$sms." nilai: ".$n." lls: ".$l." | \n";
	}
	mysql_free_result($rs);unset($sql, $rs);
//	exit($x);
}


function resetIPSAll(){ //semua ini dgunakan sblum KHS, semester 1 otomatis jg dpt.
	$sql = "select nrp,semester from t_mahasiswa";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$nrp = $row['nrp'];
		$sms = $row['semester'];	$b=$b." nrp : ".$nrp." sms: ".$sms."\n";
		for($i=1;$i<=$sms;$i++){
			$nilai=0.00;
			$jsks=0;
			$ips=0.00;
			$sql2 = "select jumlah_sks,nilai,tr_mata_kuliah_mahasiswa.kode_mata_kuliah from tr_mata_kuliah_mahasiswa JOIN t_mata_kuliah ON tr_mata_kuliah_mahasiswa.kode_mata_kuliah=t_mata_kuliah.kode_mata_kuliah where nrp='$nrp' and semester='$i'";
			$rs2 = mysql_query($sql2);$adamk=0;
			while($row2 = mysql_fetch_array($rs2)){
				$adamk=1;
				$kode_mk=$row2['kode_mata_kuliah'];
				$nil = floatval($row2['nilai']);$gradeh="A+";$gradea=4;
				if($nil<100){$gradeh="A";$gradea=4;}
				if($nil<90){$gradeh="B+";$gradea=3.5;}
				if($nil<80){$gradeh="B";$gradea=3;}
				if($nil<70){$gradeh="C+";$gradea=2.5;}
				if($nil<60){$gradeh="C";$gradea=2;}
				if($nil<50){$gradeh="D";$gradea=1;}
				if($nil<40){$gradeh="E";$gradea=0;}
				$nilai=floatval($nilai+($gradea*floatval($row2['jumlah_sks'])));		$b=$b." nrp : ".$nrp." sms : ".$i." kd : ".$kode_mk." nilai: ".$nilai." sks: ".$jsks;
				$jsks=$jsks+$row2['jumlah_sks'];
			}mysql_free_result($rs2);unset($sql2, $rs2);
			if($adamk==1){$ips=floatval($nilai/$jsks);}else{$ips=0.00;}		$b=$b." nrp : ".$nrp." sms : ".$i." ips: ".$ips." \n";
			$ips=substr($ips,0,4);
			$sql2 = "select * from t_ips where nrp='$nrp' and semester='$i'";
			$rs2 = mysql_query($sql2);$ada=0;
			while($row2 = mysql_fetch_array($rs2)){
				$ada=1;
			}mysql_free_result($rs2);unset($sql2, $rs2);
			if($ada==1){
				$sql2 = "UPDATE `t_ips` SET ips='$ips' WHERE nrp= '$nrp' AND semester= '$i'";
				if (!mysql_query($sql2))
				  {		
					  die('Error: ' . mysql_error().'');
				  }
				unset($sql2);
			}else{
				$sql2="INSERT INTO `t_ips` (`nrp`,`semester`,`ips`)VALUES ('$nrp', '$i', '$ips')";
				if (!mysql_query($sql2))
				  {		
					  die('Error: ' . mysql_error().'');
				  }
				unset($sql2);
			}
			
		}
		
	}
	mysql_free_result($rs);unset($sql, $rs);
	//exit($b);
}
function resetIPKnrp($nrp){
	$sql = "select nrp,semester from t_mahasiswa where nrp='$nrp'";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$nrp = $row['nrp'];
		$sms = $row['semester'];	$b=$b." nrp : ".$nrp." sms: ".$sms."\n";
		$nilai=0.00;
		$jsks=0;
		$ips=0.00;
		$adamk=0;
		for($i=1;$i<=$sms;$i++){
			$sql2 = "select jumlah_sks,nilai,tr_mata_kuliah_mahasiswa.kode_mata_kuliah from tr_mata_kuliah_mahasiswa JOIN t_mata_kuliah ON tr_mata_kuliah_mahasiswa.kode_mata_kuliah=t_mata_kuliah.kode_mata_kuliah where nrp='$nrp' and semester='$i'";
			$rs2 = mysql_query($sql2);
			while($row2 = mysql_fetch_array($rs2)){
				$adamk=1;
				$kode_mk=$row2['kode_mata_kuliah'];
				$nil = floatval($row2['nilai']);$gradeh="A+";$gradea=4;
				if($nil<100){$gradeh="A";$gradea=4;}
				if($nil<90){$gradeh="B+";$gradea=3.5;}
				if($nil<80){$gradeh="B";$gradea=3;}
				if($nil<70){$gradeh="C+";$gradea=2.5;}
				if($nil<60){$gradeh="C";$gradea=2;}
				if($nil<50){$gradeh="D";$gradea=1;}
				if($nil<40){$gradeh="E";$gradea=0;}
				$nilai=floatval($nilai+($gradea*floatval($row2['jumlah_sks'])));		$b=$b." nrp : ".$nrp." sms : ".$i." kd : ".$kode_mk." nilai: ".$nilai." sks: ".$jsks;
				$jsks=$jsks+$row2['jumlah_sks'];
			}mysql_free_result($rs2);unset($sql2, $rs2);
		}
		if($adamk==1){$ipk=floatval($nilai/$jsks);}else{$ipk=0.00;}		$b=$b." nrp : ".$nrp." sms : ".$i." ips: ".$ips." \n";
		$ipk=substr($ipk,0,4);
		$sql = "UPDATE `t_mahasiswa` SET ipk='$ipk' WHERE nrp= '$nrp'";
		if (!mysql_query($sql))
		  {		
			  die('Error: ' . mysql_error().'');
		  }
		unset($sql);		
	}
	mysql_free_result($rs);unset($sql, $rs);
}
function resetIPKAll(){ //semua ini dgunakan sblum KHS, semester 1 otomatis jg dpt.
	$sql = "select nrp,semester from t_mahasiswa";
	$rs = mysql_query($sql);
	while($row = mysql_fetch_array($rs)){
		$nrp = $row['nrp'];
		$sms = $row['semester'];	$b=$b." nrp : ".$nrp." sms: ".$sms."\n";
		$nilai=0.00;
		$jsks=0;
		$ips=0.00;
		$adamk=0;
		for($i=1;$i<=$sms;$i++){
			$sql2 = "select jumlah_sks,nilai,tr_mata_kuliah_mahasiswa.kode_mata_kuliah from tr_mata_kuliah_mahasiswa JOIN t_mata_kuliah ON tr_mata_kuliah_mahasiswa.kode_mata_kuliah=t_mata_kuliah.kode_mata_kuliah where nrp='$nrp' and semester='$i'";
			$rs2 = mysql_query($sql2);
			while($row2 = mysql_fetch_array($rs2)){
				$adamk=1;
				$kode_mk=$row2['kode_mata_kuliah'];
				$nil = floatval($row2['nilai']);$gradeh="A+";$gradea=4;
				if($nil<100){$gradeh="A";$gradea=4;}
				if($nil<90){$gradeh="B+";$gradea=3.5;}
				if($nil<80){$gradeh="B";$gradea=3;}
				if($nil<70){$gradeh="C+";$gradea=2.5;}
				if($nil<60){$gradeh="C";$gradea=2;}
				if($nil<50){$gradeh="D";$gradea=1;}
				if($nil<40){$gradeh="E";$gradea=0;}
				$nilai=floatval($nilai+($gradea*floatval($row2['jumlah_sks'])));		$b=$b." nrp : ".$nrp." sms : ".$i." kd : ".$kode_mk." nilai: ".$nilai." sks: ".$jsks;
				$jsks=$jsks+$row2['jumlah_sks'];
			}mysql_free_result($rs2);unset($sql2, $rs2);
		}
		if($adamk==1){$ipk=floatval($nilai/$jsks);}else{$ipk=0.00;}		$b=$b." nrp : ".$nrp." sms : ".$i." ips: ".$ips." \n";
		$ipk=substr($ipk,0,4);
		$sql = "UPDATE `t_mahasiswa` SET ipk='$ipk' WHERE nrp= '$nrp'";
		if (!mysql_query($sql))
		  {		
			  die('Error: ' . mysql_error().'');
		  }
		unset($sql);		
	}
	mysql_free_result($rs);unset($sql, $rs);
}
function getMasaNow(){
	$t_thn = getValueSettingsOf('tahun');
	$t_sms = getValueSettingsOf('semester');
	return getMasa($t_thn,$t_sms);
}

function getValueSettingsOf($sets){
		$sql = "SELECT * FROM settings WHERE `settings`.`settings` = '$sets'";
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
	$sql = "select semester from t_mahasiswa where nrp = '$nrp'";
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

function setDataDatabaseNilai($kode_mk,$nrp,$data){
	$sql="UPDATE tr_mata_kuliah_mahasiswa SET kode_mata_kuliah = '$data[0]', nrp = '$data[1]',semester= '$data[2]',masa= '$data[3]',hari_register= '$data[4]' , time_register = '$data[5]',tanggal_register = '$data[6]',nilai = '$data[7]',lulus = '$data[8]' WHERE `kode_mata_kuliah` = '$kode_mk' AND nrp='$nrp' AND masa='$data[9]'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}
function addDataDatabaseNilai($data){
	$sql="INSERT INTO `tr_mata_kuliah_mahasiswa` (kode_mata_kuliah, nrp, semester, masa, hari_register, time_register, tanggal_register, nilai, lulus) VALUES ( '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]','$data[8]');";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}

function removeDataDatabaseNilai($kode_mk,$nrp,$data){
	$sql="DELETE FROM `tr_mata_kuliah_mahasiswa`  WHERE `kode_mata_kuliah` = '$kode_mk' AND nrp='$nrp' AND masa='$data[0]'";
	if (!mysql_query($sql)){die('Error: ' . mysql_error().'');}unset($sql);}

function getTabelDatabaseNilai($search,$searchin,$orderby,$order,$color,$start){
			$s = "Ordering Table with Coloum <b>'".$orderby."'</b> By <b>'".$order."'</b>";
			$sql = "SELECT * FROM tr_mata_kuliah_mahasiswa ORDER BY ".$orderby." ".$order;
			if($search!=""){
				$s = "Searching <b>'".$search."'</b> In Table with Coloum <b>'".$searchin."'</b> and ".$s;
				$sql = "SELECT * FROM tr_mata_kuliah_mahasiswa WHERE ".$searchin." LIKE '%".$search."%' ORDER BY ".$orderby." ".$order;
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
function getDataDatabaseNilai($kode_mk,$nrp,$masa){
	$sql = "SELECT m.kode_mata_kuliah,m.nama_mata_kuliah,j.nrp,t.nama,j.semester,j.masa,j.hari_register,j.time_register,j.tanggal_register,j.nilai,j.lulus FROM t_mata_kuliah AS m JOIN tr_mata_kuliah_mahasiswa AS j ON m.kode_mata_kuliah=j.kode_mata_kuliah JOIN t_mahasiswa as t ON t.nrp=j.nrp WHERE m.kode_mata_kuliah = '$kode_mk' AND t.nrp='$nrp' AND j.masa='$masa'";$rs = mysql_query($sql);$data;
	while($row = mysql_fetch_array($rs)){
		$data['kode_mata_kuliah'] = $row['kode_mata_kuliah'];
		$data['nama_mata_kuliah'] = $row['nama_mata_kuliah'];
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
	mysql_free_result($rs);unset($sql, $rs);return $data;
}
?>