let isRunning = false;
let colors = [];
let currentId = 2;

function StartOnLoadPage() {
    GetColors();
}

function StartStopAnimation() {
    isRunning = !isRunning;

    if (isRunning) {
        StartAnimation();
		SwitchButton(document.querySelector("#start-stop-button"), "stop");
    } else {
        StopAnimation();
		SwitchButton(document.querySelector("#start-stop-button"), "start");
	}

}

function StartAnimation() {    
    GetColors();
    document.querySelector('.preview').style.animation = 'switch-' + parseInt(colors.length - 1).toString() + ' .25s linear infinite';

    ToggleDisabledAll(document.querySelectorAll('input[type="color"]'));
    ToggleDisabledAll(document.querySelectorAll('#color-list button'));
    ToggleDisabled("#add-color-button");
}

function StopAnimation() {
    document.querySelector('.preview').style.animation = '';
    ToggleDisabledAll(document.querySelectorAll('input[type="color"]'));
    ToggleDisabledAll(document.querySelectorAll("#color-list button"));
    ToggleDisabled("#add-color-button");
}

function AddColor() {
    if (colors.length >= 5) return;
    currentId++;

	const colorListElements = document.getElementById("color-list");
	const nextColorNumber = currentId;

	colorListElements.appendChild(
		createElement("color-picker", {
			colorId: nextColorNumber,
			inputConfig: [
				{ key: "name", value: "color-" + nextColorNumber },
                { key: "id", value: "color-" + nextColorNumber },
                { key: 'onchange', value: 'GetColors()' }
			],
			labelConfig: [
				{ key: "for", value: "color-" + nextColorNumber },
				{ key: "content", value: "Color " + nextColorNumber },
			],
			buttonConfig: [
				{
					key: "class",
					value: ["btn", "btn-danger", "w-10", "mg-left-auto"],
				},
				{ key: "value", value: "remove" },
				{
					key: "onclick",
					value: "RemoveColor(" + nextColorNumber + ")",
				},
			],
		}),
	);

	GetColors();
}

function RemoveColor(colorId) {
    if (colors.length == 2) return;
    document.querySelector('input[name="color-' + colorId + '"]').parentNode.remove();
    GetColors();

    ToggleAddNewColor();
}

function GetColors() {
    colors = [];
    
    document.querySelectorAll('input[type="color"]').forEach((item, index) => {
        document.documentElement.style.setProperty("--color" + parseInt(index + 1).toString(), item.value);
		colors.push(item.value);
	});

    ToggleAddNewColor();

	console.log(colors);
}

function ToggleAddNewColor() {
    if (colors.length >= 5) ToggleDisabled("#add-color-button");
	else if (colors.length < 5 && isDisabled("add-color-button"))
		ToggleDisabled("#add-color-button");
}