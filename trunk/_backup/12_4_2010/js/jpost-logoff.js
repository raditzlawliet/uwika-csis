var xmlHttpPostLogoff= createXmlHttpRequest();

function PostLogoff(){
	/* Query value that send to phpnya.*/
	var username = 'code=' + encodeURI('1');
	/*server side */
	var send_to = 'Ajax/logoff.php';
	/*Div id for handle preloader image or errors.*/
	var respons = 'alert_logoff';
	postAjax(send_to, username, respons, handleResponLogoff, xmlHttpPostLogoff);
}

function handleResponLogoff(){
	if (xmlHttpPostLogoff.readyState == 4){
		if (xmlHttpPostLogoff.status == 200){
			/*I more prefer use json as response value from php*/
			var JSONRespons = eval('(' + xmlHttpPostLogoff.responseText + ')');
			alert('logoff status : '+JSONRespons.status);
			if(JSONRespons.status == 1){
				logoffResponse(); //sukses
			}
			else{
				PostLogoff();
			}
		} else {
			/*Incase we found errors on trancaction proccess.*/
		}
	}
}

function logoffResponse(){
	InitializeTimerCekSession();
}