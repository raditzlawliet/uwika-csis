//test ajax jq
var obj;
function PostLogin(){
    var source = "Ajax/login.php"; 
	var values = "username=" + encodeURI(document.getElementById('username').value ) + "&password=" + encodeURI( document.getElementById('password').value);
	obj = 'alert_login';
	
	var hanres = function(recv){
				 	var JSONRespons = eval('(' + recv + ')');
					enableFormLogin();
					handleResponLogin(JSONRespons);
				 };
	document.getElementById('username').disabled=true;
	document.getElementById('password').disabled=true;
	document.getElementById('submit').disabled=true;
	postAjax(source, values, hanres);
}
function handleResponLogin(JSONRespons){
			$('#cek_login').html('login status : '+ JSONRespons.status);
			if(JSONRespons.status == 1){
				StopTheClockCekSession()
				document.getElementById(obj).innerHTML = JSONRespons.message;
				enableFormLogin();
				$('#login').html("Cookies must enable. . .");
				ShowHiddenPanel(true,'agreement','Ajax/panel.php','.main_panel');
			}
			else{
				document.getElementById(obj).innerHTML = JSONRespons.message;
				InitializeTimer();
			}
}

function enableFormLogin(){
	/*re-enable the form after all process done. */
	$.throbberHide();
	document.getElementById('username').disabled=false;
	document.getElementById('password').disabled=false;
	document.getElementById('submit').disabled=false;
	$.throbberHide();
	window.scrollBy(0,-1);
}

/* functions for send and hendle respons for delete a comment */

function deleteContent(messageID){
	var postValue = 'id=' + messageID;
	var send_to = 'Ajax/login.php';
	var respons = 'alert_login';
	
	input_box = window.confirm('Are you sure want to delete this comment?');
	if (input_box==true){
		postAjax(send_to, postValue, respons, handleDeletedComment);
	}
}

function handleDeletedComment(){
	if (xmlHttpPostLogin.readyState == 4){
		if (xmlHttpPostLogin.status == 200){
			var JSONRespons = eval('(' + xmlHttpPostLogin.responseText + ')');
			if(JSONRespons.status == 1){
				deleteNow(JSONRespons.id);
			}
			else{
				document.getElementById(obj).innerHTML = JSONRespons.message;
			}
		} else {
			document.getElementById(obj).innerHTML = 'Error: ' + xmlHttpPostLogin.statusText;
		}
	}
}

function deleteNow(id){
	var delete_comment = document.getElementById(id);
	var currTotalComm = document.getElementById('numComment').innerHTML;
	document.getElementById('numComment').innerHTML = parseInt(currTotalComm) - parseInt(1);
	delete_comment.parentNode.removeChild(delete_comment);
	enableFormLogin();
	document.getElementById('alert_login').innerHTML = '';
}
