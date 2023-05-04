let isRunning = false;

function StartStopAnimation() {
    if (isRunning) {
        SwitchButton(document.querySelector("#start-stop-button"), "stop");
    } else {
		SwitchButton(document.querySelector("#start-stop-button"), "start");
    }
    
    isRunning = !isRunning;
}