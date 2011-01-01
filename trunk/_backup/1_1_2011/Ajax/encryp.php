<?php
$code = htmlentities($_POST['code']);
$str = htmlentities($_POST['str']);
if($code=="sha1md5"){
	$str = sha1(md5($str));
	exit($str);	
}
?>