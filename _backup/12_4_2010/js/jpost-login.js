//test ajax jq
function PostLoginJQ(){
	 $.ajax({  
             type: "POST",  
             url: "Ajax/login.php",  
			 data: "username=" + encodeURI(document.getElementById('usernamejq').value ) + "&password=" + encodeURI( document.getElementById('passwordjq').value),
			  success: function(recv){
				  alert(recv);
				  var JSONRespons = eval('(' + recv + ')');
				 alert(JSONRespons.status);
			  }
         }); 
}

//ajax
var xmlHttpPostLogin= createXmlHttpRequest();
var obj = '';

function PostLogin(){
	/* Query value that send to phpnya.*/
	var username = 'username=' + encodeURI(document.getElementById('username').value ) + '&password=' + encodeURI( document.getElementById('password').value );
	/*server side */
	var send_to = 'Ajax/login.php';
	/*Div id for handle preloader image or errors.*/
	var respons = 'alert_login';
	postAjax(send_to, username, respons, handleResponLogin, xmlHttpPostLogin);
}

function handleResponLogin(){
	if (xmlHttpPostLogin.readyState == 4){
		if (xmlHttpPostLogin.status == 200){
			/*I more prefer use json as response value from php*/
			var JSONRespons = eval('(' + xmlHttpPostLogin.responseText + ')');
			alert('login status : '+JSONRespons.status);
			if(JSONRespons.status == 1){
				/*
				* if inserting new commend succeed, then we call loginResponse function to show the new comment.
				*/
				loginResponse(JSONRespons);
			}
			else{
				/*when new comment appeared, we have to re-enabel the form by calling enableFormLogin() function using onload image event*/
				document.getElementById(obj).innerHTML = JSONRespons.message;
				enableFormLogin();
			}
		} else {
			/*Incase we found errors on trancaction proccess.*/
			document.getElementById(obj).innerHTML = 'Error: ' + xmlHttpPostLogin.statusText;
		}
	}
	else{
		document.getElementById('username').disabled=true;
		document.getElementById('password').disabled=true;
		document.getElementById('submit').disabled=true;
	} 
}


function loginResponse(JSONRespons){
	/*get listed comments*/
//	var current_contents = document.getElementById('CommentList').innerHTML;
	/*Listed comments plus new comment that submited by user and inserted to database. */
	document.getElementById(obj).innerHTML = JSONRespons.message;
	enableFormLogin();

//	var newComment = current_contents + '<div class="Comment" id="' + JSONRespons.message_id + '"><div class="Remove"><a href="javascript:deleteContent(' + JSONRespons.message_id + ');">Remove</a></div><div class="SenderName"><img src="ajax-loading.gif" width="0" height="0" onload="enableFormLogin();">' + JSONRespons.name + '</div><div class="CommentDate">' + JSONRespons.date + '</div><div class="CommentContent">' + JSONRespons.comment + '</div></div>'; 

/*get current total comment */
//	var currTotalComm = document.getElementById('numComment').innerHTML;
	/*current comment plus one */
//	document.getElementById('numComment').innerHTML = parseInt(currTotalComm) + parseInt(1);
	/*show up the new listed comments*/
//	document.getElementById('CommentList').innerHTML = newComment;
	/*reset the form*/
//	document.getElementById('CommentForm').reset();
	/*remove the preloader image*/
//	document.getElementById('alert_login').innerHTML = '';
	$('#login').html("login . .. . ");
	InitializeTimerCekSession();
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
