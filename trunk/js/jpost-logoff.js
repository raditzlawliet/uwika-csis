function PostLogoff(){
    var source = 'Ajax/logoff.php';
	$("#main").html("");
	$.post(source,{code:1}, function(data) {
	 	var JSONRespons = eval('(' + data + ')');
		handleResponLogoff(JSONRespons);
	}); 
}

function handleResponLogoff(JSONRespons){
			//$('#cek_logoff').html('logoff status : '+ JSONRespons.status);
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
	$("#main").html('<div><center><img src="images/throbber_white.gif"></center></div>');
	$.post("Ajax/photo.php",{code:"main", uid:""}, function(data) {
	  $("#main").html("");
	  $("#main").append(data);
	});
}