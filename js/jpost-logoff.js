function PostLogoff(){
    var source = 'Ajax/logoff.php';
	var values = 'code=' + encodeURI('1');
	var hanres = function(recv){
				 	var JSONRespons = eval('(' + recv + ')');
					handleResponLogoff(JSONRespons);
				 };
	postAjax(source, values, hanres);
}

function handleResponLogoff(JSONRespons){
			$('#main').append('logoff status : '+ JSONRespons.status +'<br \>');
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