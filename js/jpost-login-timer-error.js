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
		$("#alert_login").append("Try to <a href=\"index.php\">Refresh</a> this page.");
	}
    else
    {
		if((secs>0)&&(secs <4)) {
			$("#alert_login").append(". ");
		}
		else{
			$("#alert_login").append(" <br />Error ? ");
		}
        self.status = secs
        secs = secs - 1
        timerRunning = true
        timerID = self.setTimeout("StartTheTimer()", delay)
    }
}
