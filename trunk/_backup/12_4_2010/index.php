<?php
session_start();
include_once 'session.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Campus System Information Student</title>
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js"></script>-->

<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="js/jquery.throbber.min.js"></script>
<script type="text/javascript" src="js/jpanel-effect.js"></script>
<script type="text/javascript" src="js/jpost-ajax.js"></script>
<script type="text/javascript" src="js/jcek-session.js"></script>
<script type="text/javascript" src="js/jpost-login.js"></script>
<script type="text/javascript" src="js/jpost-logoff.js"></script>
<script type="text/javascript" src="js/jpost-login-timer-error.jsp"></script>

<link href="index.css" rel="stylesheet" type="text/css" />
<link href="header.css" rel="stylesheet" type="text/css" />
<link href="footer.css" rel="stylesheet" type="text/css" />
<link href="sidebar_panel.css" rel="stylesheet" type="text/css" />
<link href="footer_panel.css" rel="stylesheet" type="text/css" />
<link href="header_panel.css" rel="stylesheet" type="text/css" />
<link href="images.css" rel="stylesheet" type="text/css" /><!--[if IE 5]>

<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
.twoColFixLtHdr #sidebar1 { width: 230px; }
</style>
<![endif]--><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColFixLtHdr #sidebar1 { padding-top: 30px; }
.twoColFixLtHdr #mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->

</head>
<body>
<div id="container">
    <div id="header">
        <div id="header_white">
        </div>
    <div id="sidebar_left">
    </div>
    <div id="sidebar_left_text">
		<?php
		for ($i=1; $i<=20; $i++)
          {
          echo "<a href=\"javascript:PostLogoff()\"><p>MENU " . $i . "</p></a>";
          }
        ?>
    </div>
    <a id="img_header_top_left"></a>
    <a id="img_header_uwika_transparant" title="Website Universitas Widya Kartika" href="http://www.widyakartika.ac.id/"></a>
    <a id="img_header_uwika_text" title="Website Universitas Widya Kartika" href="http://www.widyakartika.ac.id/"></a>
    <h1>CAMPUS SYSTEM INFORMATION STUDENT</h1>
	<a id="header_id_login" class="header_trigger" href="#">LOGIN</a>
	<a id="header_id_login_jq" class="header_trigger" style="right:200px;" href="#">LOGIN JQ</a>

    </div>
</div><!--end header-->
	<div id="container_space">
    	<div id="main">
		<?php 
		if (isset($_POST['username'])){
			echo "Now login... ".$_POST['username']." .... Please Wait.... <br />";
		}
        echo "Waittt.... !!! You can login at right top on this page :)";
        for ($i=1; $i<=250; $i++)
          {
		  echo md5("31109036");
          echo "<br />".$i." - ".sha1(md5($i))." : ".strlen(sha1(md5($i)));
          }
        ?>
        </div>
	</div>

<div class="header_panel" id="header_id_login_panel">
			<table>
				<form action="javascript:PostLogin()" method="post">
				<tr>
                	<td>USERNAME&nbsp;&nbsp;</td>
                    <td><input id="username" name="username" type="text" size="20" maxlength="50" /></td>
                </tr>
            	<tr>
                	<td>PASSWORD&nbsp;&nbsp;</td>
                    <td><input id="password" name="password" type="password" size="20" maxlength="15"/></td>
                </tr></table ><table style="padding-left:50px;">
				<tr>
					<td><a class="header_login_cancel" href="#"></a></td>
                </tr>
            </table>
			<table style="position:fixed;right:30px;top:88px;">
					<tr><td><input id="submit" class="submit" name="tombol" type="submit" value="SUBMIT" /></form></td>
                    </tr>
            </table>
            <table>&nbsp;<div id="alert_login">&nbsp;</div>
</table>
</div>

<div class="header_panel" id="header_id_login_panel_jq">
			<table>
				<form action="javascript:PostLoginJQ()" method="post">
				<tr>
                	<td>USERNAME&nbsp;&nbsp;</td>
                    <td><input id="usernamejq" name="usernamejq" type="text" size="20" maxlength="50" /></td>
                </tr>
            	<tr>
                	<td>PASSWORD&nbsp;&nbsp;</td>
                    <td><input id="passwordjq" name="passwordjq" type="password" size="20" maxlength="15"/></td>
                </tr></table >
			<table style="position:fixed;right:130px;top:88px;">
					<tr><td><input id="submit" class="submit" name="tombol" type="submit" value="SUBMIT" /></form></td>
                    </tr>
            </table>
            <table>&nbsp;<div id="alert_login">&nbsp;</div>
</table>
</div>

<div class="panel">
	<h3>Jadwal Doang</h3>
	<p>Just for Jadwal...</p>

	<p>Jadwal test ini di uji coba dengan menggunakan link <a href="http://widyakartika.ac.id" title="website utama">UWIKA</a> Dan telah diuji coba panelnya</p>
	
	<h3>Sesuatu yang menarik . . . .</h3>
		<img class="right" src="images/jon_image.jpg" alt="Just image" />
	<p>Ini dibuat untuk tugas pemrogaman website :)</p>

<div style="clear:both;"></div>

	<div class="columns">
		<div class="colleft">
		<h3>Navigation</h3>
			<ul>
				<li><a href="http://#/" title="home">Home</a></li>
				<li><a href="http://#/about/" title="about">About</a></li>
				<li><a href="http://#/portfolio/" title="portfolio">Portfolio</a></li>
				<li><a href="http://#/contact/" title="contact">Contact</a></li>
				<li><a href="http://#/blog/" title="blog">Blog</a></li>
			</ul>
		</div>
	
		<div class="colright">
			<h3>Social Stuff</h3>
			<ul>
				<li><a href="http://twitter.com/" title="Twitter">Twitter</a></li>
				<li><a href="http://designbump.com/" title="DesignBump">DesignBump</a></li>
				<li><a href="http://digg.com/" title="Digg">Digg</a></li>
				<li><a href="http://delicious.com/" title="Del.Icio.Us">Del.Icio.Us</a></li>
				<li><a href="http://designmoo.com/" title="DesignMoo">DesignMoo</a></li>
			</ul>
		</div>
	</div>
<div style="clear:both;"></div>
</div>

<div class="panel2">
	<h3>Jadwal Sekarang</h3>
	<p>Jadwal test ini di uji coba dengan menggunakan link <a href="http://widyakartika.ac.id" title="website utama">UWIKA</a> Dan telah diuji coba panelnya</p>
	
	<h3>Sesuatu yang menarik . . . .</h3>
		<img class="right" src="images/jon_image.jpg" alt="Just image" />
	<p>Ini dibuat untuk tugas pemrogaman website :)</p>

<div style="clear:both;"></div>
</div>
<p><a class="trigger" href="#">SCHEDULE</a>
<a class="trigger2" href="#">TODAYS<br />SCHEDULE</a>
<div id="footer">
<a id="footer_id_1" class="footer_trigger" href="#">COPYRIGHT</a>
<a id="footer_id_2" class="footer_trigger" href="#">HELP</a>
<a id="footer_id_3" class="footer_trigger" href="#">COMPATIBLE</a>
<a id="footer_id_4" class="footer_trigger" href="#">ABOUT</a>
</div>

<div class="footer_panel" id="footer_id_1_panel">
	<p>Campus System Information Student © 2010</p>
	<p>This site has copyright from us or team maker of CSIS Universitas Widya Kartika.</p>
    All reversed 2010.
	<a class="trigger_footer_cancel" href="#"></a>
</div>
<div class="footer_panel" id="footer_id_2_panel">
	<p>Help is unavaialbe now for a while. Thank you.</p>
	<a class="trigger_footer_cancel" href="#"></a>
</div>
<div class="footer_panel" id="footer_id_3_panel">
	<p>This site has recommended Bestview using <b><a href="http://www.mozilla.com/products/download.html">Mozilla FireFox 3.5+</a></b>, <b>1024x786</b> Resolusion and without Zoom.</p>
    <p>You can download <a href="http://www.mozilla.com/products/download.html">here</a>.</p>
	<a class="trigger_footer_cancel" href="#"></a>
</div>
<div class="footer_panel" id="footer_id_4_panel">
	<p><b>Team Maker</b></p>
     Radityo H<br /> Bobby H<br /> Evan<br /> Ferry N
	<a class="trigger_footer_cancel" href="#"></a>
</div>

<div class="footer_subpanel" id="footer_id_1_subpanel">
	<p>Campus System Information Student © 2010</p>
	<h1>Click <em id="red">COPYRIGHT</em> for more info</h1>
</div>
<div class="footer_subpanel" id="footer_id_2_subpanel">
	<p>You want some help from us ??</p>
	<h1>Click <em id="red">HELP</em> for more info</h1>
</div>
<div class="footer_subpanel" id="footer_id_3_subpanel">
	<p>Recommended bestview using <em id="red_noline">Mozilla FireFox 3.5+</em>, <b>1024x786</b> Resolusion</p>
	<h1>Click <em id="red">COMPATIBLE</em> for more info</h1>
</div>
<div class="footer_subpanel" id="footer_id_4_subpanel">
	<p>Who are the maker of this site ??</p>
	<h1>Click <em id="red">ABOUT</em> for more info</h1>
</div>

</body>
</html>