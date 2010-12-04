var detik
var timerS = null
var timerR = false
var timerD = 5000
var xmlHttpCekSession = createXmlHttpRequest();

InitializeTimerCekSession();

function InitializeTimerCekSession()
{
    StopTheClockCekSession()
    StartTheTimerCekSession()
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
	/* Query value that send to phpnya.*/
	var kode = 'code=' + encodeURI('1');
	/*server side */
	var send_to = 'Ajax/session.php';
	/*Div id for handle preloader image or errors.*/
	var respons = 'status';
	postAjax(send_to, kode, respons, handleResponCekSession, xmlHttpCekSession);
}

function handleResponCekSession(){
	if (xmlHttpCekSession.readyState == 4){
		if (xmlHttpCekSession.status == 200){
//			alert(xmlHttpCekSession.responseText);
			var JSONRespons = eval('(' + xmlHttpCekSession.responseText + ')');
			alert('session cookies status : '+ JSONRespons.status);
			if(JSONRespons.status == 1){ //login true
				
				SessionResponse(JSONRespons);
			}
			else{ //login false (session tak ada / curang)
				$('#login').html("tidak . . . .");
			}
		} else {
			/*Incase we found errors on trancaction proccess.*/
			document.getElementById(obj).innerHTML = 'Error: ' + xmlHttpCekSession.statusText;
		}
	}
}


function SessionResponse(JSONRespons){
	alert('ada');
	$('#login').html("lagi login...");
}