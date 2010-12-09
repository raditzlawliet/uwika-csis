<?php
include 'transfer.php';

$code = htmlentities($_POST['code']);
$code_panel = htmlentities($_POST['code_panel']);
switch($code){
	case 1 : { //login panel
			$header_login = "<a id=\"header_id_login\" class=\"header_trigger\" onclick=\"javascript:header_login_click()\" href=\"#!\">LOGIN</a>";
			exit($header_login);
		break;
	}
	case 2 : { //logoff panel
			$header_logoff = '<a id="header_id_logoff" class="header_trigger" onclick="javascript:header_logoff_click()" href="#!">LOGOFF</a>';
			exit($header_logoff);
		break;
	}
	case 3 : { //account panel
			$header_logoff = "<a id=\"header_id_account\" class=\"header_trigger\" onclick=\"javascript:header_account_click()\" href=\"#!\">ACCOUNT</a>";
			exit($header_logoff);
		break;
	}
	case 4 : { //info student panel
			$header_logoff = "<a id=\"header_id_student\" class=\"header_trigger\" onclick=\"javascript:header_student_click()\" href=\"#!\">STUDENT<br \>INFORMATION</a>";
			exit($header_logoff);
		break;
	}
	case 5 : { //info student panel
			$header_logoff = "<a id=\"header_id_faculty\" class=\"header_trigger\" onclick=\"javascript:header_faculty_click()\" href=\"#!\">FACULTY<br \>INFORMATION</a>";
			exit($header_logoff);
		break;
	}
	case 6 : { //info student panel
			$header_logoff = "<a id=\"header_id_employee\" class=\"header_trigger\" onclick=\"javascript:header_employee_click()\" href=\"#!\">EMPLOYEE<br \>INFORMATION</a>";
			exit($header_logoff);
		break;
	}
	case 7 : { //admin panel
			$header_logoff = "<a id=\"header_id_admin\" class=\"header_trigger\" onclick=\"javascript:header_admin_click()\" href=\"#!\">ADMIN</a>";
			exit($header_logoff);
		break;
	}
}
switch($code_panel){
	case 1: { //login
			$header_login_panel = "<div class=\"header_panel\" id=\"header_id_login_panel\">
			<form action=\"javascript:PostLogin()\" method=\"post\">
			<table>
				<tr>
                	<td>USERNAME&nbsp;&nbsp;</td>
                    <td><input id=\"username\" name=\"username\" type=\"text\" size=\"20\" maxlength=\"50\" /></td>
                </tr>
            	<tr>
                	<td>PASSWORD&nbsp;&nbsp;</td>
                    <td><input id=\"password\" name=\"password\" type=\"password\" size=\"20\" maxlength=\"15\"/></td>
                </tr></table><table style=\"padding-left:50px;\">
				<tr>
					<td><a class=\"header_login_cancel\" onclick=\"javascript:header_login_cancel_click()\" href=\"#!\"></a></td>
                </tr>
            </table>
			<table style=\"position:fixed;right:30px;top:88px;\">
					<tr><td><input id=\"submit\" class=\"submit\" name=\"tombol\" type=\"submit\" value=\"SUBMIT\" /></td>
                    </tr>
            </table>
            &nbsp;<div id=\"alert_login\">&nbsp;</div>
			</form>
			</div>
			<script>$(function() {
			$(\".submit\")
					.click(function() {
						InitializeTimer();  //di html awal
						$(\"#alert_login\").html(\"Loading ... (<i>Login Require Cookies</i>)\");
					})
					.throbber();
			$(\".submit\")
				.click(function() {
					$(\"#loading\").html(\"Loading stopped!\");
					$.throbberHide();
				})
			$(\"#ajax\")
				.click(function() {
					$(\"#ajax-target\").load(\"demo_content.html\");
				})
				.throbber();
			});
			function header_login_click(){
							$(\"#header_id_login_panel\").toggle(\"fast\");
							$(\"#header_id_login\").toggleClass(\"active\");
							return false;
			}
			function header_login_cancel_click(){
							$(\"#header_id_login_panel\").toggle(\"fast\");
							$(this).toggleClass(\"active\");
							$(\"#header_id_login\").toggleClass(\"active\");
							return false;
			}
			</script>";
			exit($header_login_panel);
		break;
	}
	case 2 : { //logoff panel
		$header_logoff_panel = '<script>StopTheClock();function header_logoff_click(){PostLogoff();}</script>';
		exit($header_logoff_panel);
		break;
	}
	case 3 : { //account panel
		$data_profile = getProfile($_SESSION['uid'],$_SESSION['turn']);
		$header_logoff_panel = '
		<div class="header_panel" id="header_id_account_panel">
		<ul>
		<li id="menu_profile"><a href="#!profile.php?'.$data_profile['nrp'].'" id="menu_profile_pic"><table><tr><td><img id="menu_profile_pic_p" src="images/jon_image.jpg" weight="50" height="50" alt="Profile Name" /></td><td><em id="menu_profile_text">'.$data_profile['nama'].'</em></td></tr></table></a></li>
		<li><a href="#!">CONFIGURATION</a></li>
		<li><a href="#!">BACK-END</a></li>
		</ul>
		</div>
		<script>function header_account_click(){
			InitializeTimerCekSession();
			$("#header_id_account_panel").toggle("fast");
			$("#header_id_account").toggleClass("active");
		}</script>';
		exit($header_logoff_panel);
		break;
	}
}
?>