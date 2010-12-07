var secs
var timerID = null
var timerRunning = false
var delay = 1000

function InitializeTimer()
{
    secs = 5
    StopTheClock()
    StartTheTimer()
}

function StopTheClock()
{
    if(timerRunning)
        clearTimeout(timerID)
    timerRunning = false
}

function StartTheTimer()
{
    if (secs==0)
    {
        StopTheClock()
		$("#alert_login").append("Error ? Try to <a href=\"index.php\">Refresh</a> this page.");
	}
    else
    {
		if((secs>0)&&(secs <3)) {
			$("#alert_login").append(". ");
		}
		else if (secs==3){
			$("#alert_login").append("<br />. ");
		}else{}
        self.status = secs
        secs = secs - 1
        timerRunning = true
        timerID = self.setTimeout("StartTheTimer()", delay)
    }
}
