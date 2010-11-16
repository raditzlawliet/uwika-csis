<?php
session_start();
include_once 'config.php';

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
    if ($username && $password) {
		$md5password = md5($password);
        $sql = "SELECT * FROM t_mahasiswa WHERE nrp='$username' AND kode_pengaman='$md5password'";
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
    return false;
}

function session($username,$password){
        $sql = "SELECT * FROM t_mahasiswa WHERE nrp='$username' AND password='$password'";
		$rs = mysql_query($sql);
		while($row = mysql_fetch_array($rs)){
			$_SESSION['uid'] = $row['uid'];
			$_SESSION['md5nrp'] = md5($row['nrp']);
		}
        mysql_free_result($rs);
        unset($sql, $rs);
}

function getDataSession($kode){
        $sql = "SELECT * FROM t_mahasiswa WHERE kode='$kode'";
		$rs = mysql_query($sql);
		$data_session;
		while($row = mysql_fetch_array($rs)){
			$data_session[0] = $row['kode'];
			$data_session[1] = $row['kode_pengaman'];
			$data_session[2] = $row['username'];
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
if((isset($_POST['username']))){
	$username = htmlentities($_POST['username']);
	$password = htmlentities($_POST['password']);

	if(empty($username)){
		if(empty($password)){
			$alert_login = array('status'=>'0', 'message'=>'Please, Write down your username as NRP / Email and your Password.');
			$alert_login = json_encode($alert_login);
			exit($alert_login);
		}
		$alert_login = array('status'=>'0', 'message'=>'Please, Write down your username as NRP / Email.');
		$alert_login = json_encode($alert_login);
		exit($alert_login);
	}
	if(empty($password)){
		$alert_login = array('status'=>'0', 'message'=>'Please, Write down your Password.');
		$alert_login = json_encode($alert_login);
		exit($alert_login);
	}
//	$insert_comment = insert_comment($name, $comment);
//	$alert_login = array('status'=>'1', 'date'=>$today_date, 'name'=>$name, 'comment'=>$comment, 'message_id'=>$insert_comment);
	$alert_login = array('status'=>'1', 'message'=>'Waiting for Login . . . ');
	$alert_login = json_encode($alert_login);
	exit($alert_login);
}

if(isset($_POST['id'])){
	
	$delete = delete_comment($_POST['id']);
	
	if($delete == true){
		
		$alert_login = array('status'=>'1','id'=>$_POST['id']);
		$alert_login = json_encode($alert_login);
		exit($alert_login);
	}
	else{
		
		$alert_login = array('status'=>'0', 'message'=>'Error deleting comment.');
		$alert_login = json_encode($alert_login);
		exit($alert_login);
	}
}
?>