<?php
session_start();
include 'config.php';

function auth_first($username,$password){
	if (!auth($username,$password)){
		//wrong
		return false;
	}else{
		return true;
		//right
	}
}
function auth_second($username){
        $sql = "SELECT * FROM t_mahasiswa WHERE username='$username'";
		$rs = mysql_query($sql);
        $return = false;
		if (mysql_num_rows($rs)==1){
			$return = true;
		}
        mysql_free_result($rs);
        unset($sql, $rs);
        return $return;
}

function auth($username, $password) {
		$md5password = sha1(md5($password));
		
		$sql = array("SELECT * FROM t_mahasiswa WHERE nrp='$username' AND password='$md5password'",
					 "SELECT * FROM t_dosen WHERE nrp='$username' AND password='$md5password'",
					 "SELECT * FROM t_karyawan WHERE nrp='$username' AND password='$md5password'");
		$turn = 0;
		do{
			
		$rs = mysql_query($sql[$turn]);
        $return = false;
		if (mysql_num_rows($rs)==1){
			session($username,$password,$turn);
			$return = true;
		}
        mysql_free_result($rs);
        unset($rs);

		$tempturn=false;
		if(($turn==2)||($return==true)){
			$tempturn=true;
		}
		$turn++;
		}while(!$tempturn);
        unset($sql);

		return $return;
}


function session($username,$password,$turn){
		$md5password = sha1(md5($password));

		$sql = array("SELECT * FROM t_mahasiswa WHERE nrp='$username' AND password='$md5password'",
					 "SELECT * FROM t_dosen WHERE nrp='$username' AND password='$md5password'",
					 "SELECT * FROM t_karyawan WHERE nrp='$username' AND password='$md5password'");

		$rs = mysql_query($sql[$turn]);
		while($row = mysql_fetch_array($rs)){
			setcookie('login', "1", time()+3600, "/");
			$_SESSION['turn'] = $turn;
			$_SESSION['uid'] = $row['uid'];
			$_SESSION['md5nrp'] = sha1(md5($row['nrp']));
		}
        mysql_free_result($rs);
        unset($sql, $rs);

}

function getDataSession($uid,$turn){
		$sql = array("SELECT * FROM t_mahasiswa WHERE uid='$uid'",
					 "SELECT * FROM t_dosen WHERE uid='$uid'",
					 "SELECT * FROM t_karyawan WHERE uid='$uid'");

		$rs = mysql_query($sql[$turn]);
		$data_session;
		while($row = mysql_fetch_array($rs)){
			$data_session[0] = $row['nrp'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		return $data_session;
}

?>