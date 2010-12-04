<?php
$code = htmlentities($_POST['code']);
$code_panel = htmlentities($_POST['code_panel']);
switch($code){
	case 1 : { //login panel
			$header_login = "<a id=\"header_id_login\" class=\"header_trigger\" href=\"javascript:header_login_click()\">LOGIN</a>";
			exit($header_login);
		break;
	}
	case 2 : { //logoff panel
			$header_logoff = "<a id=\"header_id_logoff\" class=\"header_trigger\" href=\"javascript:header_logoff_click()\">LOGOFF</a>";
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
					<td><a class=\"header_login_cancel\" href=\"javascript:header_login_cancel_click()\"></a></td>
                </tr>
            </table>
			<table style=\"position:fixed;right:30px;top:88px;\">
					<tr><td><input id=\"submit\" class=\"submit\" name=\"tombol\" type=\"submit\" value=\"SUBMIT\" /></td>
                    </tr>
            </table>
            <table>&nbsp;<div id=\"alert_login\">&nbsp;</div>
			</table>
			</form>
			</div>
			<script>$(function() {
			$(\".submit\")
					.click(function() {
						InitializeTimer();  //di html awal
						$(\"#alert_login\").html(\"Loading ...\");
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
			}
			function header_login_cancel_click(){
							$(\"#header_id_login_panel\").toggle(\"fast\");
							$(this).toggleClass(\"active\");
							$(\"#header_id_login\").toggleClass(\"active\");
			}
			</script>";
			exit($header_login_panel);
		break;
	}
	case 2 : { //logoff panel
		$header_logoff_panel = '<script>
		function header_logoff_click(){PostLogoff();}
			</script>';	
		exit($header_logoff_panel);
		break;
	}
}
?>