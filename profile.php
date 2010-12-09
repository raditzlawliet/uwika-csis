<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
        echo "Waittt.... !!! You can login at right top on this page :)<br /><b>User : 31109000, Pass : 2</b><br />";
		$array = array('lastname', 'email kuuuu', 'phone');
		$comma_separated = implode("| ", $array);			
		echo $comma_separated;
		$comma_separated = "akuuuuuuu a???|suko i ta|lalalalal a|aa";
		$pieces = explode("|", $comma_separated);
		echo "<br />";
		foreach($pieces as $i){
			echo $i."<br />";
		}
		function add($id,$nama,$tgl,$anak){
				$sql = "INSERT INTO t_mahasiswa (nrp , nama , password, jenis_kelamin ) VALUES ( '31110000, '".$nama."', '".$tgl."', '".$anak."' )";
			if (!mysql_query($sql))
			  {
			  echo "<td><form action=\"#\" method=\"post\" name=\"delete\">
				<input name=\"tombol\" type=\"submit\" value=\"Kembali\" /></form></td>";
			  die('<div id="error" >Error: ' . mysql_error().'</div>');
			  }	
		}		
		
        for ($i=1; $i<=250; $i++)
          {
		  echo md5("31109036");
          echo "<br />".$i." - ".sha1(md5($i))." : ".strlen(sha1(md5($i)));
          }
 ?>
</body>
</html>