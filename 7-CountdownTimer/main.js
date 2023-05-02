let isPaused = true;
let initialTime = "";
let timer = "";
let counterList = GetFromBrowser("countdown_timer_itens")
	? GetFromBrowser("countdown_timer_itens")
	: [];
let dateMode = true;

function Init() {
	if (isChecked("startNow")) {
		ToggleDisabled("#initialDate");
	}

	if (counterList.length > 0) {
		counterList.forEach((item) => {
			let container = CreateTimerItem(item);
			item.setIntervalId = StartTimer(
				item,
				container.querySelector("span.counter"),
			);
		});
	} else {
		document.getElementById("clearlist_button").disabled = true;
	}
}

Init();

function StartTimer(item, location) {
	time = DiffDates(new Date(), new Date(item.endDate));
	DefineVisor(time, location);
	if (time.second <= 0) {
		DefineVisor(
			{
				day: 0,
				hour: 0,
				minute: 0,
				second: 0,
			},
			location,
		);
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
		if (
			time.hour == 0 &&
			time.minute == 0 &&
			time.second == 0 &&
			time.day == 0
		)
			FinishTimer(counterInterval, item);
	}, 1000);

	return counterInterval;
}

function FinishTimer(id, item = '') {
    clearInterval(id);
    if (item != '') SendAlert(`Your counter "${item.name}" is over!`);
}

function DeleteItemButton(id) {
	let item = counterList[id];
	FinishTimer(item.timerId);

	document.getElementById("timer-item-" + item.timerId).remove();

	let out = [];
	counterList.forEach((item) => {
		if (item.timerId != id) out.push(item);
	});

	SaveInBrowser("countdown_timer_itens", out);
}

function DefineVisor(time, location = "") {
	let day = time.day <= 0 ? "" : time.day.toString() + ":";
	let hour =
		time.hour < 10 ? "0" + time.hour.toString() : time.hour.toString();
	let minute =
		time.minute < 10
			? "0" + time.minute.toString()
			: time.minute.toString();
	let second =
		time.second < 10
			? "0" + time.second.toString()
			: time.second.toString();

	if (location != "") {
		location.innerHTML = day + hour + ":" + minute + ":" + second;
	} else {
		document.querySelector(".counter span").innerHTML =
			day + hour + ":" + minute + ":" + second;
	}
}

function GetTimerItem() {
	initialDate = document.getElementById("startNow").checked
		? new Date()
		: new Date(document.getElementById("initialDate").value);
	endDate = new Date(document.getElementById("endDate").value);

	return {
		timerId: counterList.length,
		name: document.getElementById("name").value,
		initialDate,
		endDate,
		setIntervalId: 0,
	};
}

function OnToggleStartDate() {
	ToggleDisabled("#initialDate");
	ToggleRequired("#initialDate");

	let initialDate = document.getElementById("initialDate");

	if ( initialDate.parentNode.classList.contains("invalid-group") && !initialDate.required ) RemoveInvalidGroup(initialDate);
}

function HandleCreateCountDownTimerItem() {
	if (HaveInvalidFields()) return;

    let data = GetTimerItem();
    
    if(data.initialDate > data.endDate) return InvalidateField(document.getElementById("endDate").parentNode, 'End date must be higher than Initial date!');

	counterList.push(data);
	SaveInBrowser("countdown_timer_itens", counterList);
	let tmp = CreateTimerItem(data);
	data.setIntervalId = StartTimer(data, tmp.querySelector("span.counter"));

	ClearAllInputs();
}

function CreateTimerItem(data) {
	let timerItemContainer = createElement("li", [
		{ key: "id", value: "timer-item-" + data.timerId },
	]);

	let info = createElement("div", [{ key: "class", value: ["info"] }]);
	let header = createElement("div", [
		{ key: "class", value: ["title-header"] },
	]);

	header.appendChild(
		createElement("p", [
			{ key: "class", value: ["title"] },
			{ key: "content", value: data.name },
		]),
	);

	info.appendChild(header);
	info.appendChild(
		createElement("span", [
			{ key: "class", value: ["counter"] },
			{ key: "content", value: "00:00:00" },
		]),
	);

	timerItemContainer.appendChild(info);

	let description = createElement("div", [
		{ key: "class", value: ["description"] },
	]);
	let tmpDiv = createElement("div");

	tmpDiv.appendChild(
		createElement("p", [{ key: "content", value: "Initial time" }]),
	);
	tmpDiv.appendChild(
		createElement("span", [
			{ key: "content", value: DateToString(new Date(data.initialDate)) },
		]),
	);

	description.appendChild(tmpDiv);
	tmpDiv = null;
	tmpDiv = createElement("div");

	tmpDiv.appendChild(
		createElement("p", [{ key: "content", value: "End time" }]),
	);
	tmpDiv.appendChild(
		createElement("span", [
			{ key: "content", value: DateToString(new Date(data.endDate)) },
		]),
	);
	description.appendChild(tmpDiv);

	timerItemContainer.appendChild(description);

	let controls = createElement("div", [
		{ key: "class", value: ["controls"] },
	]);

	let tmpRow = createElement("div", [{ key: "class", value: ["row"] }]);
	let tmpColumn = createElement("div", [{ key: "class", value: ["row"] }]);
	let tmpInputGroup = createElement("div", [
		{ key: "class", value: ["input-group"] },
	]);

	tmpRow = createElement("div", [{ key: "class", value: ["row"] }]);
	tmpColumn = createElement("div", [{ key: "class", value: ["column"] }]);
	tmpInputGroup = createElement("div", [
		{ key: "class", value: ["input-group"] },
	]);

	let timerID =
		data.timerId != undefined ? data.timerId : counterList.length - 1;

	tmpInputGroup.appendChild(
		createElement("button", [
			{ key: "class", value: ["btn", "btn-danger"] },
			{ key: "content", value: "Delete" },
			{ key: "id", value: "delete_button" },
			{ key: "onclick", value: "DeleteItemButton(" + timerID + ")" },
		]),
	);

	tmpColumn.appendChild(tmpInputGroup);
	tmpRow.appendChild(tmpColumn);
	controls.appendChild(tmpRow);

	timerItemContainer.appendChild(controls);
	document.getElementById("clearlist_button").disabled = false;
	document.querySelector(".timer-list ul").appendChild(timerItemContainer);

	return timerItemContainer;
}

function HandleClearTimerList() {
	SaveInBrowser("countdown_timer_itens", []);
	document.querySelector(".timer-list ul").innerHTML = "";
	document.getElementById("clearlist_button").disabled = true;
}
