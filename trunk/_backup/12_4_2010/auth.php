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

function auth_second_nrp($nrp){
        $sql = "SELECT * FROM t_biodata WHERE nrp='$nrp'";
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
        $sql = "SELECT * FROM t_mahasiswa WHERE nrp='$username' AND password='$md5password'";
		$rs = mysql_query($sql);
        $return = false;
		if (mysql_num_rows($rs)==1){
			session($username,$password);
			$return = true;
		}
        mysql_free_result($rs);
        unset($sql, $rs);
        return $return;
}

function session($username,$password){
		$md5password = sha1(md5($password));
        $sql = "SELECT * FROM t_mahasiswa WHERE nrp='$username' AND password='$md5password'";
		$rs = mysql_query($sql);
		while($row = mysql_fetch_array($rs)){
			setcookie('login', "1", time()+3600, "/");
			$_SESSION['uid'] = $row['uid'];
			$_SESSION['md5nrp'] = sha1(md5($row['nrp']));
		}
        mysql_free_result($rs);
        unset($sql, $rs);
}

function getDataSession($uid){
        $sql = "SELECT * FROM t_mahasiswa WHERE uid='$uid'";
		$rs = mysql_query($sql);
		$data_session;
		while($row = mysql_fetch_array($rs)){
			$data_session[0] = $row['nrp'];
		}
        mysql_free_result($rs);
        unset($sql, $rs);
		return $data_session;
}


$today_date	= date("d/m/Y H:i:s");

function insert_comment($name, $comment){
	global $db;
	
	$sql_date	= date("Y-m-d H:i:s");
	$sql		= $db->query("INSERT INTO comments (name, comment, date) VALUES('$name', '$comment', '$sql_date')");
	
	if($sql){
		
		//get this comment id from db
		$result = $db->query("SELECT id FROM comments WHERE date = '$sql_date'");
		$data = $result->fetch_array(MYSQLI_ASSOC);
		$comment_id = $data['id'];
		return $comment_id;
		
	}
	else{
		
		return false;
	}
}

function delete_comment($id){
	global $db;
	
	$delete = $db->query("DELETE FROM comments WHERE id = '$id'");
	
	if($delete){
		
		return true;
		
	}
	else{
		
		return false;
		
	}
}

?>