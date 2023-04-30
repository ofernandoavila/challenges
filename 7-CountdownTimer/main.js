let isPaused = true;
let initialTime = '';
let timer = '';
let counterList = GetFromBrowser('countdown_timer_itens') ? GetFromBrowser('countdown_timer_itens') : [];
let dateMode = true;

function Init() {
    if (isChecked('startNow')) {
        ToggleField('initialDate');
    }

    if(counterList.length > 0) {
        counterList.forEach( item => {
            let container = CreateTimerItem(item);
            item.setIntervalId = StartTimer(
                item, 
                container.querySelector('span.counter')
            );
        });
    } else {
        document.getElementById('clearlist_button').disabled = true;
    }
}

Init();

function StartTimer(item, location) {
    time = DiffDates(new Date(), new Date(item.endDate));
    DefineVisor(time, location);

    console.log(time);
    if (time.second <= 0) {
        DefineVisor({
            day: 0,
			hour: 0,
			minute: 0,
			second: 0,
        }, location);
        return;
    }

    let counterInterval = setInterval(() => {
        time = DiffDates(new Date(), new Date(item.endDate));
        DefineVisor(time, location);
        if (time.second == 0) {
            if (time.minute >= 1) {
                time.minute--;
                time.second = 59;
            } else {
                if (time.hour >= 1) {
                    time.hour--;
                    time.minute = 59;
                    time.second = 59;
                } else {
                    if (time.day >= 1) {
                        time.day--;
                        time.hour = 23;
                        time.minute = 59;
                        time.second = 59;
                    }
                }
            }
        } else {
            time.second--;
        }
        DefineVisor(time, location);
        if (time.hour == 0 && time.minute == 0 && time.second == 0 && time.day == 0) FinishTimer(counterInterval);
    }, 1000);

    return counterInterval;
}

function FinishTimer(id) {
    clearInterval(id);
}

function DeleteItemButton(id) {
    let key = 0;
    if(counterList.length > 1) key = id - 1;
    let item = counterList[key];
    console.log(item);
    document.getElementById('timer-item-' + item.timerId).remove();

    let out = [];
    counterList.forEach( item => {
        if(item.timerId != id) out.push(item);
    });

    console.log(out);
    SaveInBrowser('countdown_timer_itens', out);
}

function DefineVisor(time, location = '') {
    let day = (time.day <= 0) ? '' : time.day.toString() + ":";
    let hour = (time.hour < 10) ? "0" + time.hour.toString() : time.hour.toString();
    let minute = (time.minute < 10) ? "0" + time.minute.toString() : time.minute.toString();
    let second = (time.second < 10) ? "0" + time.second.toString() : time.second.toString();

    if(location != '') {
        location.innerHTML = day + hour + ":" + minute + ":" + second;
    } else {
        document.querySelector('.counter span').innerHTML = day + hour + ":" + minute + ":" + second;
    }
}

function GetTimerItem() {
    initialDate = document.getElementById('startNow').checked ? new Date() : new Date(document.getElementById('initialDate').value);
    endDate = new Date(document.getElementById('endDate').value);

    return {
        timerId: (counterList.length + 1),
        name: document.getElementById('name').value,
        initialDate,
        endDate,
        setIntervalId: 0
    };
}

function HandleCreateCountDownTimerItem() {
    let data = GetTimerItem();
    
    let tmp = CreateTimerItem(data);
    counterList.push(data);
    SaveInBrowser('countdown_timer_itens', counterList);

    data.setIntervalId = StartTimer(
        data, 
        tmp.querySelector('span.counter')
    );
}

function CreateTimerItem(data) {
    let timerItemContainer = createElement('li', [{ key: 'id', value: 'timer-item-' + data.timerId }]);
    
    let info = createElement('div', [{ key: 'class', value: ['info'] }]);
    let header = createElement('div', [{ key: 'class', value: ['title-header'] }]);
    
    header.appendChild(createElement('p', [{ key: 'class', value: ['title'] }, { key: 'content', value: data.name }]));
    
    info.appendChild(header);
    info.appendChild(createElement('span', [{ key: 'class', value: ['counter'] }, { key: 'content', value: '00:00:00' }]));

    timerItemContainer.appendChild(info);

    let description = createElement('div', [{ key: 'class', value: ['description'] }]);
    let tmpDiv = createElement('div');

    tmpDiv.appendChild(createElement('p', [{ key: 'content', value: 'Initial time' }]));
    tmpDiv.appendChild(createElement('span', [{ key: 'content', value: DateToString(new Date(data.initialDate)) }]));

    description.appendChild(tmpDiv);
    tmpDiv = null;
    tmpDiv = createElement('div');

    tmpDiv.appendChild(createElement('p', [{ key: 'content', value: 'End time' }]));
    tmpDiv.appendChild(createElement('span', [{ key: 'content', value: DateToString(new Date(data.endDate)) }]));
    description.appendChild(tmpDiv);

    timerItemContainer.appendChild(description);

    let controls = createElement('div', [{ key: 'class', value: ['controls'] }]);

    let tmpRow = createElement('div', [{ key: 'class', value: ['row'] }]);
    let tmpColumn = createElement('div', [{ key: 'class', value: ['row'] }]);
    let tmpInputGroup = createElement('div', [{ key: 'class', value: ['input-group'] }]);

    tmpRow = createElement('div', [{ key: 'class', value: ['row'] }]);
    tmpColumn = createElement('div', [{ key: 'class', value: ['column'] }]);
    tmpInputGroup = createElement('div', [{ key: 'class', value: ['input-group'] }]);
    tmpInputGroup.appendChild(
        createElement(
            'button',
            [
                { key: 'class', value: ['btn', 'btn-danger'] },
                { key: 'content', value: 'Delete' },
                { key: 'id', value: 'delete_button' },
                { key: 'onclick', value: 'DeleteItemButton(' + data.timerId + ')' }
            ]
        )
    );

    tmpColumn.appendChild(tmpInputGroup);
    tmpRow.appendChild(tmpColumn);
    controls.appendChild(tmpRow);

    timerItemContainer.appendChild(controls);
    document.getElementById('clearlist_button').disabled = false;
    document.querySelector('.timer-list ul').appendChild(timerItemContainer);

    return timerItemContainer;
}

function HandleClearTimerList() {
    SaveInBrowser('countdown_timer_itens', []);
    document.querySelector('.timer-list ul').innerHTML = '';
    document.getElementById('clearlist_button').disabled = true;
}