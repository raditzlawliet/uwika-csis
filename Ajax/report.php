<?php
$sort_by = htmlentities($_POST['sort_by']);
$color = htmlentities($_POST['color']);
$page=htmlentities($_REQUEST['page']);
$limit=htmlentities($_REQUEST['limit']);
$show=htmlentities($_REQUEST['show']);
$search2=htmlentities($_REQUEST['search2']);
$sx=htmlentities($_REQUEST['sx']);
$ad=htmlentities($_REQUEST['ad']);
$start = ($page-1)*30;
$show = explode("|",$show);
$x = explode("|",$search2);
$data = $_POST['report'];
exit($data);

?>

