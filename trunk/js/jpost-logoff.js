function PostLogoff(){
    var source = 'Ajax/logoff.php';
	var values = 'code=' + encodeURI('1');
	var respons = 'alert_logoff';
	var hanres = function(recv){
				 	var JSONRespons = eval('(' + recv + ')');
					handleResponLogoff(JSONRespons);
				 };
	postAjax(source, values, respons, hanres);
}

function handleResponLogoff(JSONRespons){
//			alert('logoff status : '+JSONRespons.status);
			if(JSONRespons.status == 1){
				logoffResponse(); //sukses
			}
			else{
				PostLogoff();
			}
}

function logoffResponse(){
	InitializeTimerCekSession();
}