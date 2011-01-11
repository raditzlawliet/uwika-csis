<?php
session_start();
include 'transfer_l_m.php';

$code = htmlentities($_POST['code']); //buat mastiin
$uid = htmlentities($_POST['uid']); //buat mastiin

if ($code!="krs"){
	echo("You have login first....");
}else{
		$data_profile = getProfile($uid,$_SESSION['turn']);
		$opt_sms = '<option value="'.$data_profile['semester'].'">Sekarang</option>';
		
		$show="true|true|true|true|true|true|false|false|false|false|false|false|false|";
		$show=explode("|",$show);
		$x= ''.getValueSettingsOf("tahun").'/'.getValueSettingsOf("semester").'|masa|=|AND|';
		$x=explode("|",$x);
		$search2x[0]['q']=1;
		$search2x[0]['c']=$x[3];
		$search2x[0]['s']=$x[1];
		$search2x[0]['o']=$x[2];
		$search2x[0]['v']=$x[0];
		
		for($i=1;$i<=$data_profile['semester'];$i++){
			$opt_sms = $opt_sms.'<option value="'.$i.'">Semester '.$i.'</option>';
		}
		$out = '
		<center><p><div id="db_cmd">
		Warna <select onchange="javascript:search(\'db_l_m\');" id="krs_color" class="select" title="Color">
				<option value="">Hijau</option>
				<option value="red">Merah</option>
				<option value="blue">Biru</option>
				<option value="yellow">Kuning</option>
				<option value="pink">Pink</option>
				<option value="bw">Black & White</option>
				</select>
				<div id="khs_r">
				<form action="Ajax/report_khs.php" method="post"><input style="border:1px solid #FFB0FF;background:#FFB0FF;font-size:11px;margin:3px;"; type="submit" value="Tampilkan KHS"/><input name="code" type="hidden" value="db_l_m" /><input name="search_text" type="hidden" value="'.$data_profile['nrp'].'" /><input name="search_in" type="hidden" value="nrp" /><input name="sort_text" type="hidden" value="t_mata_kuliah.kode_mata_kuliah" /><input name="sort_by" type="hidden" value="ASC" /><input name="color" type="hidden" value="bw" /><input name="page" type="hidden" value="1" /><input name="limit" type="hidden" value="false" /><input name="show" type="hidden" value="true|true|true|false|false|false|false|false|false|false|false|true|true|" /><input name="search2" type="hidden" value="'.$data_profile['semester'].'|semester|=|AND|" /><input name="sx" type="hidden" value="1" /><input name="ad" type="hidden" value="1" /><input name="ab" type="hidden" value="1" /><input name="diff" type="hidden" value="0" /></form>
				</div>
		</div><p></center>
		
		<h1><b><center>K &nbsp; R &nbsp; S</center></b></h1>
		<p>
		<center>
		<div id="khs_main">
		'.getTabelDatabaseListMataKuliahPerMahasiswa($data_profile['nrp'],"nrp","t_mata_kuliah.kode_mata_kuliah","ASC","bw",0,"false",$show,$search2x,"2").'
		</div>
		</center>
		<script>
		document.getElementById("krs_color").selectedIndex = 5;
				function search(db){searchpage(db,1);}
				function searchpage(db,page){
					var search_text = "'.$data_profile['nrp'].'";
					var search_in = "nrp";
					var sort_text = "t_mata_kuliah.kode_mata_kuliah";
					var sort_by = "ASC";
					var color = document.getElementById("krs_color").value;
					var limit = "false";
					var show = "true|true|true|true|true|true|false|false|false|false|false|false|false|";
					var search2= "'.getValueSettingsOf("tahun").'/'.getValueSettingsOf("semester").'|masa|=|AND|";
					var diff="0";;
					var test = search2;
					var ad = "1";
					var ab = "2";
					var sx = "1";
						$("#khs_main").html(\'<div><center><img src="images/throbber_white.gif"></center></div>\');
						$.post("Ajax/database_ajax_l_m.php",{code:db, search_text:search_text, search_in:search_in, sort_text:sort_text, sort_by:sort_by, color:color,page:page,limit:limit, show:show,search2:search2, sx:sx, ad:ad, ab:ab, diff:diff}, function(data) {
 							$("#khs_main").html(data);
							$("#khs_r").html(\'<form action="Ajax/report_khs.php" method="post"><input style="border:1px solid #FFB0FF;background:#FFB0FF;font-size:11px;margin:3px;"; type="submit" value="Tampilkan Laporan !"/><input name="code" type="hidden" value="\'+db+\'" /><input name="search_text" type="hidden" value="\'+search_text+\'" /><input name="search_in" type="hidden" value="\'+search_in+\'" /><input name="sort_text" type="hidden" value="\'+sort_text+\'" /><input name="sort_by" type="hidden" value="\'+sort_by+\'" /><input name="color" type="hidden" value="\'+color+\'" /><input name="page" type="hidden" value="\'+page+\'" /><input name="limit" type="hidden" value="\'+limit+\'" /><input name="show" type="hidden" value="\'+show+\'" /><input name="search2" type="hidden" value="\'+search2+\'" /><input name="sx" type="hidden" value="\'+sx+\'" /><input name="ad" type="hidden" value="\'+ad+\'" /><input name="ab" type="hidden" value="\'+ab+\'" /><input name="diff" type="hidden" value="\'+diff+\'" /></form>\');
						}); 
				}
		</script>
		';
		exit($out);
}
?>

