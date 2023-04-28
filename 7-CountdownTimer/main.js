let isPaused = true;
let initialTime = '';
let timer = '';

function StartButton() {
    isPaused = !isPaused;
    document.querySelector('#start-pause_button').innerHTML = "Pause";
    InsertStopButton();
    SwitchFunction(
        document.querySelector('#start-pause_button'),
        'onclick',
        'PauseButton'
    );
    
    initialTime = GetTimerConfig();
    timer = StartTimer(GetTimerConfig());
}

function RestartButton() {
    if(timer != '') {
        if(isPaused) {
            isPaused = false;
            UnPause();
        }
        
        clearInterval(timer);
        timer = StartTimer(GetTimerConfig());
    }
}

function StartTimer(time) {
    DefineVisor(time);
    document.getElementById('restart_button').disabled = false;

    let counterInterval = setInterval(() => {
        if(!isPaused) {

            if(time.second == 0) {
                if(time.minute >= 1) {
                    time.minute--;
                    time.second = 59;
                } else {
                    if(time.hour >= 1) {
                        time.hour--;
                        time.minute = 59;
                        time.second = 59;
                    }
                }
            } else {
                time.second--;
            }

            DefineVisor(time);
        }

        if(time.hour == 0 && time.minute == 0 && time.second == 0) FinishTimer();
    }, 1000);

    return counterInterval;
}

function FinishTimer() {
    clearInterval(timer);
    isPaused = true;
    document.querySelector('#start-pause_button').innerHTML = "Start";
    document.querySelector('#start-pause_button').classList.remove('btn-success');
    document.querySelector('#start-pause_button').classList.add('btn-normal');
    document.getElementById('stop_button').parentNode.parentNode.remove();
    document.getElementById('restart_button').disabled = true;
    DefineVisor({hour: 0, minute: 0, second: 0});
    SwitchFunction(
        document.querySelector('#start-pause_button'),
        'onclick',
        'StartButton'
    );
}

function DefineVisor(time) {
    let hour = (time.hour < 10) ? "0" + time.hour.toString() : time.hour.toString();
    let minute = (time.minute < 10) ? "0" + time.minute.toString() : time.minute.toString();
    let second = (time.second < 10) ? "0" + time.second.toString() : time.second.toString();

    document.querySelector('.counter span').innerHTML = hour + ":" + minute + ":" + second;
}

function GetTimerConfig() {
    return {
        hour: !isNaN(parseInt(document.querySelector('input[name="hour"]').value)) ? parseInt(document.querySelector('input[name="hour"]').value) : 0,
        minute: !isNaN(parseInt(document.querySelector('input[name="minute"]').value)) ? parseInt(document.querySelector('input[name="minute"]').value) : 0,
        second: !isNaN(parseInt(document.querySelector('input[name="second"]').value)) ? parseInt(document.querySelector('input[name="second"]').value) : 0,
    }
}

function InsertStopButton() {
    return createFormButton(
        'Stop', 
        true, 
        document.querySelector('.controls .row:nth-child(2)'), 
        ['btn-danger'],
        [{ event: 'onclick', functionName: 'FinishTimer'}]
    );
}

function PauseButton() {
    if(isPaused) {
        isPaused = !isPaused;
        UnPause();
    } else {
        isPaused = !isPaused;
        ToggleClass(
            document.querySelector('#start-pause_button'),
            'btn-success',
            'btn-normal'
        );
        document.querySelector('#start-pause_button').innerHTML = "Continue";
    }
}

function UnPause() {
    document.querySelector('#start-pause_button').innerHTML = "Pause";
    ToggleClass(
        document.querySelector('#start-pause_button'),
        'btn-success',
        'btn-normal'
    );
}