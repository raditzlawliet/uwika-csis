<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Campus System Information Student</title>
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.3.min.js"></script>-->
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="js/jquery.throbber.min.js"></script>
<script type="text/javascript">		 
var secs
var timerID = null
var timerRunning = false
var delay = 1000

function InitializeTimer()
{
    secs = 3
    StopTheClock()
    StartTheTimer()
}

function StopTheClock()
{
    if(timerRunning)
        clearTimeout(timerID)
    timerRunning = false
}

function StartTheTimer()
{
    if (secs==0)
    {
        StopTheClock()
        // Here's where you put something useful that's
        // supposed to happen after the allotted time.
        // For example, you could display a message:
		$("#alert_login").append(" <br />Error ?, Try to <a href=\"\">Refresh</a> this page.");
	}
    else
    {
        self.status = secs
        secs = secs - 1
        timerRunning = true
        timerID = self.setTimeout("StartTheTimer()", delay)
    }
}


$(function() {
			$(".submit")
					.click(function() {
						InitializeTimer();
						$("#alert_login").html("Loading ...");
					})
					.throbber();
			$(".submit")
				.click(function() {
					$("#loading").html("Loading stopped!");
					$.throbberHide();
				})
			$("#ajax")
				.click(function() {
					$("#ajax-target").load("demo_content.html");
				})
				.throbber();
			$("#google1").throbber("click");
			$("#google2").throbber({parent: "#throbber-container"});
			$("#div").throbber("dblclick", {image: "throbber_2.gif", wrap: '<div class="throbber"></div>'});
});
	
$(document).ready(function(){
	$("#id_1").hover(function(){
		jQuery.ajaxSetup({
		  beforeSend: function() {
			 $('#login_loading').show()
		  },
		  complete: function(){
//			 $('#loader').hide()
		  },
		  success: function() {}
		});
		$("#id_1_subpanel").toggle("fast");
		return false;
	});
	$("#id_2").hover(function(){
		$("#id_2_subpanel").toggle("fast");
		return false;
	});
	$("#id_3").hover(function(){
		$("#id_3_subpanel").toggle("fast");
		return false;
	});
	$("#id_4").hover(function(){
		$("#id_4_subpanel").toggle("fast");
		return false;
	});
	$(".trigger_footer_cancel").click(function(){
		$("#id_1_panel").hide("fast");
		$("#id_2_panel").hide("fast");
		$("#id_3_panel").hide("fast");
		$("#id_4_panel").hide("fast");
		return false;
	});
	
	$("#id_1").click(function(){
		$("#id_1_panel").toggle("fast");
		$("#id_2_panel").hide("fast");
		$("#id_3_panel").hide("fast");
		$("#id_4_panel").hide("fast");
		return false;
	});
	$("#id_2").click(function(){
		$("#id_2_panel").toggle("fast");
		$("#id_1_panel").hide("fast");
		$("#id_3_panel").hide("fast");
		$("#id_4_panel").hide("fast");
		return false;
	});
	$("#id_3").click(function(){
		$("#id_3_panel").toggle("fast");
		$("#id_2_panel").hide("fast");
		$("#id_1_panel").hide("fast");
		$("#id_4_panel").hide("fast");
		return false;
	});
	$("#id_4").click(function(){
		$("#id_4_panel").toggle("fast");
		$("#id_2_panel").hide("fast");
		$("#id_3_panel").hide("fast");
		$("#id_1_panel").hide("fast");
		return false;
	});

	$(".trigger").click(function(){
		$(".panel").toggle("fast");
		$(this).toggleClass("active");
		$(".trigger2").toggle("fast");
		$(".trigger_login").toggle("fast");
		return false;
	});

	$(".trigger2").click(function(){
		$(".panel2").toggle("fast");
		$(this).toggleClass("active");
		$(".trigger").toggle("fast");
		$(".trigger_login").toggle("fast");
		return false;
	});
	$(".trigger_login").click(function(){
		$(".panel_login").toggle("fast");
		$(this).toggleClass("active");
		$(".trigger").toggle("fast");
		$(".trigger2").toggle("fast");
		return false;
	});
	$(".trigger_cancel").click(function(){
		$(".panel_login").toggle("fast");
		$(this).toggleClass("active");
		$(".trigger_login").toggleClass("active");
		$(".trigger").toggle("fast");
		$(".trigger2").toggle("fast");
		return false;
	});
});

var xmlHttp = createXmlHttpRequest();
var obj = '';

function createXmlHttpRequest() {
	var xmlHttp = false;
	if (window.ActiveXObject) {
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		xmlHttp = new XMLHttpRequest();
	}
	if (!xmlHttp) {
		alert("Ops sorry We found some error!!");
	}
	return xmlHttp;
}

function postAjax(source, values, respons, hanres) {
  if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0) {
	obj = respons;
	xmlHttp.open("POST", source, true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", values.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.onreadystatechange = hanres;
	xmlHttp.send(values);
  } else {
	setTimeout('postAjax(source, values, respons, hanres)', 100000);
  }
}
function postContent(){
	/* Query value that send to php.*/
	var username = 'username=' + encodeURI(document.getElementById('username').value ) + '&password=' + encodeURI( document.getElementById('password').value );
	/*server side */
	var send_to = 'auth.php';
	/*Div id for handle preloader image or errors.*/
	var respons = 'alert_login';
	postAjax(send_to, username, respons, handleResponComment);
}

function handleResponComment(){
	if (xmlHttp.readyState == 4){
		if (xmlHttp.status == 200){
			/*I more prefer use json as response value from php*/
			var JSONRespons = eval('(' + xmlHttp.responseText + ')');
			if(JSONRespons.status == 1){
				/*
				* if inserting new commend succeed, then we call commentResponse function to show the new comment.
				*/
				commentResponse(JSONRespons);
			}
			else{
				/*when new comment appeared, we have to re-enabel the form by calling enableForm() function using onload image event*/
				document.getElementById(obj).innerHTML = JSONRespons.message;
				enableForm();
			}
		} else {
			/*Incase we found errors on trancaction proccess.*/
			document.getElementById(obj).innerHTML = 'Error: ' + xmlHttp.statusText;
		}
	}
	else{
		/*
		* After submit new comment, we heve to diasable the form to prevent from re-submitng by user.
		* Also, show the preloader image, so user know his comment is being proceed.
		*/
		document.getElementById(obj).innerHTML = '<img src="ajax-loading.gif">';
		document.getElementById('username').disabled=true;
		document.getElementById('password').disabled=true;
		document.getElementById('submit').disabled=true;
	} 
}


function commentResponse(JSONRespons){
	/*get listed comments*/
//	var current_contents = document.getElementById('CommentList').innerHTML;
	/*Listed comments plus new comment that submited by user and inserted to database. */

	document.getElementById(obj).innerHTML = JSONRespons.message;
	enableForm();

//	var newComment = current_contents + '<div class="Comment" id="' + JSONRespons.message_id + '"><div class="Remove"><a href="javascript:deleteContent(' + JSONRespons.message_id + ');">Remove</a></div><div class="SenderName"><img src="ajax-loading.gif" width="0" height="0" onload="enableForm();">' + JSONRespons.name + '</div><div class="CommentDate">' + JSONRespons.date + '</div><div class="CommentContent">' + JSONRespons.comment + '</div></div>'; 

/*get current total comment */
	var currTotalComm = document.getElementById('numComment').innerHTML;
	/*current comment plus one */
	document.getElementById('numComment').innerHTML = parseInt(currTotalComm) + parseInt(1);
	/*show up the new listed comments*/
	document.getElementById('CommentList').innerHTML = newComment;
	/*reset the form*/
	document.getElementById('CommentForm').reset();
	/*remove the preloader image*/
	document.getElementById('alert_login').innerHTML = '';
}

function enableForm(){
	/*re-enable the form after all process done. */
	$.throbberHide();
	document.getElementById('username').disabled=false;
	document.getElementById('password').disabled=false;
	document.getElementById('submit').disabled=false;
	$.throbberHide();
}

/* functions for send and hendle respons for delete a comment */

function deleteContent(messageID){
	var postValue = 'id=' + messageID;
	var send_to = 'auth.php';
	var respons = 'alert_login';
	
	input_box = window.confirm('Are you sure want to delete this comment?');
	if (input_box==true){
		postAjax(send_to, postValue, respons, handleDeletedComment);
	}
}

function handleDeletedComment(){
	if (xmlHttp.readyState == 4){
		if (xmlHttp.status == 200){
			var JSONRespons = eval('(' + xmlHttp.responseText + ')');
			if(JSONRespons.status == 1){
				deleteNow(JSONRespons.id);
			}
			else{
				document.getElementById(obj).innerHTML = JSONRespons.message;
			}
		} else {
			document.getElementById(obj).innerHTML = 'Error: ' + xmlHttp.statusText;
		}
	}
}

function deleteNow(id){
	var delete_comment = document.getElementById(id);
	var currTotalComm = document.getElementById('numComment').innerHTML;
	document.getElementById('numComment').innerHTML = parseInt(currTotalComm) - parseInt(1);
	delete_comment.parentNode.removeChild(delete_comment);
	enableForm();
	document.getElementById('alert_login').innerHTML = '';
}
</script>


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
        for ($i=1; $i<=10; $i++)
          {
          echo "<a href=\"#\"><p>MENU " . $i . "</p></a>";
          }
        ?>
    </div>
    <a id="img_header_top_left"></a>
    <a id="img_header_uwika_transparant" title="Website Universitas Widya Kartika" href="http://www.widyakartika.ac.id/"></a>
    <a id="img_header_uwika_text" title="Website Universitas Widya Kartika" href="http://www.widyakartika.ac.id/"></a>
    <h1>CAMPUS SYSTEM INFORMATION STUDENT</h1>
	<a class="trigger_login" href="#">LOGIN</a>
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
          echo "<br />??";
          }
        ?>
        </div>
	</div>
<div class="panel_login">
			<table>
				<form action="javascript:postContent()" method="post">
				<tr>
                	<td>USERNAME&nbsp;&nbsp;</td>
                    <td><input id="username" name="username" type="text" size="20" maxlength="50" /></td>
                </tr>
            	<tr>
                	<td>PASSWORD&nbsp;&nbsp;</td>
                    <td><input id="password" name="password" type="password" size="20" maxlength="15"/></td>
                </tr></table ><table style="padding-left:50px;">
				<tr>
					<td><a class="trigger_cancel" href="#"></a></td>
                </tr>
            </table>
			<table style="position:fixed;right:30px;top:88px;">
					<tr><td><input id="submit" class="submit" name="tombol" type="submit" value="SUBMIT" /></form></td>
                    </tr>
            </table>
            <table id="alert_login">&nbsp;</table>
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
<a id="id_1" class="footer_trigger" href="#">COPYRIGHT</a>
<a id="id_2" class="footer_trigger" href="#">HELP</a>
<a id="id_3" class="footer_trigger" href="#">COMPATIBLE</a>
<a id="id_4" class="footer_trigger" href="#">ABOUT</a>
</div>

<div class="footer_panel" id="id_1_panel">
	<p>Campus System Information Student © 2010</p>
	<p>This site has copyright from us or team maker of CSIS Universitas Widya Kartika.</p>
    All reversed 2010.
	<a class="trigger_footer_cancel" href="#"></a>
</div>
<div class="footer_panel" id="id_2_panel">
	<p>Help is unavaialbe now for a while. Thank you.</p>
	<a class="trigger_footer_cancel" href="#"></a>
</div>
<div class="footer_panel" id="id_3_panel">
	<p>This site has recommended Bestview using <b><a href="http://www.mozilla.com/products/download.html">Mozilla FireFox 3.5+</a></b>, <b>1024x786</b> Resolusion and without Zoom.</p>
    <p>You can download <a href="http://www.mozilla.com/products/download.html">here</a>.</p>
	<a class="trigger_footer_cancel" href="#"></a>
</div>
<div class="footer_panel" id="id_4_panel">
	<p><b>Team Maker</b></p>
     Radityo H<br /> Bobby H<br /> Evan<br /> Ferry N
	<a class="trigger_footer_cancel" href="#"></a>
</div>

<div class="footer_subpanel" id="id_1_subpanel">
	<p>Campus System Information Student © 2010</p>
	<h1>Click <em id="red">COPYRIGHT</em> for more info</h1>
</div>
<div class="footer_subpanel" id="id_2_subpanel">
	<p>You want some help from us ??</p>
	<h1>Click <em id="red">HELP</em> for more info</h1>
</div>
<div class="footer_subpanel" id="id_3_subpanel">
	<p>Recommended bestview using <em id="red_noline">Mozilla FireFox 3.5+</em>, <b>1024x786</b> Resolusion</p>
	<h1>Click <em id="red">COMPATIBLE</em> for more info</h1>
</div>
<div class="footer_subpanel" id="id_4_subpanel">
	<p>Who are the maker of this site ??</p>
	<h1>Click <em id="red">ABOUT</em> for more info</h1>
</div>

</body>
</html>