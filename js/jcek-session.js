var detik
var timerS = null
var timerR = false
var timerD = 1000
var session = 0;
var panelLogin = false;
var panelLogoff = false;
var panelHome =new Array(false,false,false,false,false,false);

function LoginLogoffPanel(){
	if(session==2){
		if(!panelLogoff){ShowLogoffPanel();}
		if(!panelHome[1]){ShowHomePanel('Ajax/panel.php',1);}
		if(!panelHome[2]){ShowHomePanel('Ajax/panel.php',2);}
		if(!panelHome[3]){ShowHomePanel('Ajax/panel.php',3);}
		if(!panelHome[4]){ShowHomePanel('Ajax/panel.php',4);}
		if(!panelHome[5]){ShowHomePanel('Ajax/panel.php',5);}
	}else if(session==1){
		if(!panelLogin){PostLogoff();HidePanel();ShowLoginPanel();}
	}else{}
//	$("#array_session").html("Array : "+panelLogin+" "+panelLogoff+" "+panelHome[5]+" "+panelHome[1]+" "+panelHome[2]+" "+panelHome[3]+" "+panelHome[4]);
//	$.post("Ajax/session.php",{code:99}, function(data) {
//	  $("#array_session").html(data);
//	});
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
	for(var i = 0;i<=5;i++){
		panelHome[i]=false;
	}
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
			ShowHomePanel(source,2);
			ShowHomePanel(source,3);
			ShowHomePanel(source,4);
			break;}
		case 1:{
			$.post(source,{code:3}, function(data) {
			  $('#header_group').append(data);
			}); 
			$.post(source,{code_panel:3}, function(data) {
			  $('#header_panel_group').append(data);
			});
			panelHome[1]=true; break;}
		case 2:{
			$.post(source,{code:4}, function(data) {
			  $('#header_group').append(data);
			}); 
			$.post(source,{code_panel:4, code_panel_turn:getTurn()}, function(data) {
			  $('#header_panel_group').append(data);
			});
			panelHome[2]=true; break;}
		case 3:{
			$.post(source,{code:5}, function(data) {
			  $('#header_group').append(data);
			}); 
			$.post(source,{code_panel:5, code_panel_turn:getTurn()}, function(data) {
			  $('#header_panel_group').append(data);
			});
			panelHome[3]=true; break;}
		case 4:{
			$.post(source,{code:6}, function(data) {
			  $('#header_group').append(data);
			});
			$.post(source,{code_panel:6, code_panel_turn:getTurn()}, function(data) {
			  $('#header_panel_group').append(data);
			});
			panelHome[4]=true; break;}
		case 5:{
			$.post(source,{code:7}, function(data) {
			  $('#header_group').append(data);
			});
			$.post(source,{code_panel:7, code_panel_turn:getTurn()}, function(data) {
			  $('#header_panel_group').append(data);
			});
			panelHome[5]=true; break;}
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
			//$('#cek_session').html('session cookies status : '+ JSONRespons.status);
			if(JSONRespons.status == 1){ //login true
				session = 2;
				LoginLogoffPanel();
			}
			else{ //login false (session tak ada / curang)
				session = 1;
				LoginLogoffPanel();
			}
}

function getTurn(){
    var source = 'Ajax/session.php'; 
	var values = 'code=' + encodeURI('5');
	var hanres = function(recv){
				 	var JSONRespons = eval('(' + recv + ')');
//					alert(JSONRespons.turn);
					return JSONRespons.turn;
				 };
	postAjax(source, values, hanres);
}

function setCookie(c_name,value,expiredays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate()+expiredays);
document.cookie=c_name+ "=" +escape(value)+
((expiredays==null) ? "" : ";expires="+exdate.toUTCString());
}