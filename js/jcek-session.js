var detik
var timerS = null
var timerR = false
var timerD = 5000
var session = 0;
var panelLogin = false;
var panelLogoff = false;
var panelHome =new Array(false,false,false,false,false);

function LoginLogoffPanel(){
	if(session==2){
		if(!panelLogoff){ShowLogoffPanel();}
	}else if(session==1){
		if(!panelLogin){ShowLoginPanel();}
		if(!panelHome){ShowLoginPanel('Ajax/panel.php',1);}
	}else{}
}

function ShowLoginPanel(){
    var source = 'Ajax/panel.php'; 
	$("#header_group").html("");
	$("#header_panel_group").html("");
	$.post(source,{code:1}, function(data) {
	  $('#header_group').append(data);
	}); 
	$.post(source,{code_panel:1}, function(data) {
	  $('#header_panel_group').append(data);
	});
	panelLogin = true;
	panelLogoff = false;
}

function ShowLogoffPanel(){
    var source = 'Ajax/panel.php'; 
	$("#header_group").html("");
	$("#header_panel_group").html("");
	$.post(source,{code:2}, function(data) {
	  $('#header_group').append(data);
	}); 
	$.post(source,{code_panel:2}, function(data) {
	  $('#header_panel_group').append(data);
	});
	panelLogoff = true;
	panelLogin = false;
	ShowHomePanel(source,0);
}

function ShowHomePanel(source, value){
	switch(value){
		case 0:{
			ShowHomePanel(source,1);
			break;}
		case 1:{
			$.post(source,{code:3}, function(data) {
			  $('#header_group').append(data);
			}); 
			$.post(source,{code_panel:3}, function(data) {
			  $('#header_panel_group').append(data);
			});
			panelHome[1]==true; break;}
	}
}
function InitializeTimerCekSession()
{
    StopTheClockCekSession();
    StartTheTimerCekSession();
	LoginLogoffPanel();
}

function StopTheClockCekSession()
{
    if(timerR)
        clearTimeout(timerS)
    timerR = false
}

function StartTheTimerCekSession()
{
	postCekSession();
    timerR = true
    timerS = self.setTimeout("StartTheTimerCekSession()", timerD)
}

function postCekSession(){
    var source = 'Ajax/session.php'; 
	var values = 'code=' + encodeURI('1');
	var hanres = function(recv){
				 	var JSONRespons = eval('(' + recv + ')');
					handleResponCekSession(JSONRespons);
				 };
	postAjax(source, values, hanres);
}

function handleResponCekSession(JSONRespons){
			$('#main').append('session cookies status : '+ JSONRespons.status +'<br \>');
			if(JSONRespons.status == 1){ //login true
				session = 2;
				LoginLogoffPanel();
			}
			else{ //login false (session tak ada / curang)
				session = 1;
				LoginLogoffPanel();
			}
}

