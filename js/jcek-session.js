var detik
var timerS = null
var timerR = false
var timerD = 5000
var session = false;
var panelLogin = false;
var panelLogoff = false;

function LoginLogoffPanel(){
	if(session){
		if(!panelLogoff){
		ShowLogoffPanel();}
	}else{
		if(!panelLogin){
		ShowLoginPanel();}
	}
}

function ShowLoginPanel(){
    var source = 'Ajax/panel.php'; 
	$("#main").html("");
	$("#header_group").html("");
	$("#header_panel_group").html("");
	$("#header_group").load(source,{code:1});
	$("#header_panel_group").load(source,{code_panel:1});
	panelLogin = true;
	panelLogoff = false;
}

function ShowLogoffPanel(){
    var source = 'Ajax/panel.php'; 
	$("#header_group").html("");
	$("#header_panel_group").html("");
	$("#header_group").load(source,{code:2});
	$("#header_panel_group").load(source,{code_panel:2});
	panelLogoff = true;
	panelLogin = false;
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
	var respons = 'status';
	var hanres = function(recv){
				 	var JSONRespons = eval('(' + recv + ')');
					handleResponCekSession(JSONRespons);
				 };
	postAjax(source, values, respons, hanres);
}

function handleResponCekSession(JSONRespons){
//			alert('session cookies status : '+ JSONRespons.status);
			if(JSONRespons.status == 1){ //login true
				session = true;
				LoginLogoffPanel();
			}
			else{ //login false (session tak ada / curang)
				session = false;
				LoginLogoffPanel();
			}
}

