<?php include 'transfer.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Campus Student Information System</title>
<link href="default.css" rel="stylesheet" type="text/css" /><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.thrColLiqHdr #sidebar2, .thrColLiqHdr #sidebar1 { padding-top: 30px; }
.thrColLiqHdr #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
</head>

<body class="thrColLiqHdr">

<div id="container">
 <div id="header">
    <h1>Header</h1>
  <!-- end #header --></div>
  <div id="sidebar1">
  <h3>Sidebar1 </h3>
    <p>The background color on this div will only show for the length of the content. If you'd like a dividing line instead, place a border on the left side of the #mainContent div if the #mainContent div will always contain more content than the #sidebar1 div. </p>
    <p>Donec eu mi sed turpis feugiat feugiat. Integer turpis arcu, pellentesque  eget, cursus et, fermentum ut, sapien. </p>
  <!-- end #sidebar1 --></div>
  <div id="sidebar2">
    <h3>Sidebar2 </h3>
    <p>The background color on this div will only show for the length of the content. If you'd like a dividing line instead, place a border on the right side of the #mainContent div if the #mainContent div will always contain more content than the #sidebar2 div. </p>
    <p>Donec eu mi sed turpis feugiat feugiat. Integer turpis arcu, pellentesque  eget, cursus et, fermentum ut, sapien. </p>
  <!-- end #sidebar2 --></div>
  <div id="mainContent">
    <h1> Main Content </h1>

<?php
if (isset($_POST['idt'])){
	switch ($_POST['idt']){
		case 1 : { //delete
			echo "Are you sure want to delete this data (".$_POST['id'].") ?";
			echo "<table style=\"margin=1px;padding=3px;\">";
			echo "<tr><td><form action=\"#\" method=\"post\" name=\"delete\"><input name=\"id\" type=\"hidden\" value=\"".$_POST['id']."\" /><input name=\"tombol\" type=\"submit\" value=\"Ya\" /><input name=\"idt\" type=\"hidden\" value=\"3\" /></form></td><td><form action=\"#\" method=\"post\" name=\"delete\"><input name=\"tombol\" type=\"submit\" value=\"Tidak\" /></form></td></tr></table>";
			break;
		}
		case 2 : { //edit
		$rs = getDataNow($_POST['id']);
		$row = mysql_fetch_array($rs);
           echo "<table>
				<form action=\"#\" method=\"post\" name=\"edit\">
				<tr>
                	<td>NRP</td>
                    <td><input id=\"text\" name=\"nrp\" type=\"text\" size=\"8\" maxlength=\"8\"  readonly=\"true\" value=\"".$row['nrp']."\"/></td>
                </tr>
            	<tr>
                	<td>Nama</td>
                    <td><input id=\"text\" name=\"nama\" type=\"text\" size=\"50\" maxlength=\"50\" value=\"".$row['nama']."\"/></td>
                </tr>
            	<tr>
                	<td>Motto</td>
                    <span><td><textarea name=\"motto\" />".$row['motto']."</textarea></span></td>
                </tr></table ><table style=\"padding-left:50px;\">
				<tr>
                	<td><input name=\"idt\" type=\"hidden\" value=\"4\" /></td>
                    <td><input name=\"edit\" type=\"submit\" value=\"Simpan\" /></form></td>
					<td><form action=\"#\" method=\"post\" name=\"delete\">
					<input name=\"tombol\" type=\"submit\" value=\"Tidak\" /></form></td>
                </tr>
            </table>";
			break;
		}
		case 3 : { //yes delete
			delData($_POST['id']);
			echo "<meta http-equiv=\"refresh\" content=\"0;url=#\" />";
			break;
		}
		case 4 : { //submit edit
			editData($_POST['nrp'],$_POST['nama'],$_POST['motto']);
			echo "<meta http-equiv=\"refresh\" content=\"0;url=#\" />";
			break;
		}
		case 5 : {	//add 
           echo "<table>
				<form action=\"#\" method=\"post\" name=\"edit\">
				<tr>
                	<td>NRP</td>
                    <td><input id=\"text\" name=\"nrp\" type=\"text\" size=\"8\" maxlength=\"8\" /></td>
                </tr>
            	<tr>
                	<td>Nama</td>
                    <td><input id=\"text\" name=\"nama\" type=\"text\" size=\"50\" maxlength=\"50\"/></td>
                </tr>
            	<tr>
                	<td>Motto</td>
                    <span><td><textarea name=\"motto\" /></textarea></span></td>
                </tr></table ><table style=\"padding-left:50px;\">
				<tr>
                	<td><input name=\"idt\" type=\"hidden\" value=\"6\" /></td>
                    <td><input name=\"edit\" type=\"submit\" value=\"Simpan\" /></form></td>
					<td><form action=\"#\" method=\"post\" name=\"delete\">
					<input name=\"tombol\" type=\"submit\" value=\"Tidak\" /></form></td>
                </tr>
            </table>";
			break;
		}
		case 6 : { //add
			add($_POST['nrp'],$_POST['nama'],$_POST['motto']);
			echo "<meta http-equiv=\"refresh\" content=\"0;url=#\" />";
			break;
		}
		default : { //def
			echo "<meta http-equiv=\"refresh\" content=\"0;url=#\" />";
		}
	}
}else{
			echo "<table style=\"background:#5559FF;\"><tr><td><form action=\"#\" method=\"post\" name=\"add\"><input id=\"tombol\" name=\"tombol\" type=\"submit\" value=\"Tambah Data\" /><input name=\"idt\" type=\"hidden\" value=\"5\" /></form></td>
			<td><form action=\"#\" method=\"post\" name=\"add\"><input name=\"tombol\" type=\"submit\" value=\"Tampilkan Ulang \" /></form></td></tr>
			</table>";

}
?>
<br />
    <table>
		<tr style="background:green;color:white;">
        	<th style="border:1px solid;"><center>NRP</center></th>
            <th style="border:1px solid;"><center>NAMA</center></th>
            <th style="border:1px solid;"><center>MOTTO</center></th>
        </tr>
    <?php
		$rs = getData();
		$tr = true;
		while($row = mysql_fetch_array($rs)){
			if($tr){
				echo "<tr><td id=\"a\" style=\"padding:3px; ;\">".$row['nrp']."</td><td id=\"a\" style=\"padding:5px;\">".$row['nama']."</td>"."</td><td id=\"a\" style=\"padding:5px;\">".$row['motto']."</td>";
				
				echo "<td><form style:\"float:right;\" action=\"#\" method=\"post\" name=\"delete\"><input name=\"id\" type=\"hidden\" value=\"".$row['nrp']."\" /><input name=\"delete\" type=\"submit\" value=\"Hapus\" /><input name=\"idt\" type=\"hidden\" value=\"1\" /></form></td>";
				
				echo "<td><form style:\"float:right;\" action=\"#\" method=\"post\" name=\"edit\"><input name=\"id\" type=\"hidden\" value=\"".$row['nrp']."\" /><input name=\"edit\" type=\"submit\" value=\"Ubah\" /><input name=\"idt\" type=\"hidden\" value=\"2\" /></form></td>";
				
				echo "</tr>";
			}
			else{
				echo "<tr><td id=\"b\" style=\"padding:3px;\">".$row['nrp']."</td><td id=\"b\" style=\"padding:5px;\">".$row['nama']."</td>"."</td><td id=\"b\" style=\"padding:5px;\">".$row['motto']."</td>";
				
				echo "<td style:\"float:right;\"><form action=\"#\" method=\"post\" name=\"delete\"><input name=\"id\" type=\"hidden\" value=\"".$row['nrp']."\" /><input name=\"delete\" type=\"submit\" value=\"Hapus\" /><input name=\"idt\" type=\"hidden\" value=\"1\" /></form></td>";
				
				echo "<td style:\"float:right;\"><form style:\"float:right;\" action=\"#\" method=\"post\" name=\"edit\"><input name=\"id\" type=\"hidden\" value=\"".$row['nrp']."\" /><input name=\"edit\" type=\"submit\" value=\"Ubah\" /><input name=\"idt\" type=\"hidden\" value=\"2\" /></form></td>";
				
				echo "</tr>";
			}
		$tr = !$tr;
		}
	?>
    </table>
	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <p>Footer</p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>