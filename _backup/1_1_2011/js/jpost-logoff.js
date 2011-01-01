function PostLogoff(){
    var source = 'Ajax/logoff.php';
	$("#main").html("");
	$.post(source,{code:1}, function(data) {
	 	var JSONRespons = eval('(' + data + ')');
		handleResponLogoff(JSONRespons);
	}); 
}

function handleResponLogoff(JSONRespons){
			$('#cek_logoff').html('logoff status : '+ JSONRespons.status);
			if(JSONRespons.status == 1){
				 HidePanel();
				 logoffResponse(); //sukses
			}
			else{
				PostLogoff();
			}
}

function logoffResponse(){
	$("#alert_login").html("Login Again ^^a. ");
	InitializeTimerCekSession();
}