const screen = document.querySelector(".screen .equation");
const current = document.querySelector(".screen .current");
const buttons = document.querySelectorAll(".keyboard div button");
let equation = [];
let number = "";

buttons.forEach((button) => {
	button.addEventListener("click", (event) => {
		action(event.target.value);
	});
});

function action(value) {
	switch (value) {
		case "backspace":
			number = number.substr(0, number.length - 1);
			current.innerHTML = number != "" ? number : "0";
			break;
		case "ac":
			clearAll();
			break;

		case "c":
			clear();
			break;

		case "=":
			addValue(number, true);
			number = "";
			resolve();
			break;

		case ".":
			number += ".";
			break;

		case "+/-":
			updateScreen();
			if(parseFloat(number) > 0) {
				output = -Math.abs(parseFloat(number));
			} else {
				output = Math.abs(parseFloat(number));
			}
			number = output.toString();
			current.innerHTML = number;
			break;

		default:
			if (equation.length == 0 && isNaN(parseFloat(value)) && number == "")
				return;
			else addValue(value);
			break;
	}
}

function addValue(value, inEqual = false) {
	if (isNaN(parseFloat(value))) {
		equation.push(number);
		equation.push(value);
		updateScreen();
		number = "";
	} else {
		if(number.toString().length < 8) number += value;
		if (inEqual) equation.push(value);
		current.innerHTML = number;
	}
}

function clearAll() {
	equation = [];
	updateScreen();
	updatecurrent();
}

function clear() {
	number = "";
	current.innerHTML = "0";
}

function resolve() {
	let output = 0;

	for (let i = 0; i < equation.length; i++) {
		if (!isNaN(parseFloat(equation[i])) && output == 0) {
			output += parseFloat(equation[i]);
			continue;
		}

		if (isNaN(parseFloat(equation[i]))) {
			switch (equation[i]) {
				case "+":
					updateScreen();
					output = sum(output, equation[i + 1]);
					break;

				case "-":
					updateScreen();
					output = diff(output, equation[i + 1]);
					break;

				case "/":
					updateScreen();
					output = div(output, equation[i + 1]);
					break;

				case "x":
					updateScreen();
					output = times(output, equation[i + 1]);
					break;
			}
			continue;
		}
	}

	if(output.toString().length > 8) {
		output = "ERR";
	}

	current.innerHTML = output;
}

function updatecurrent() {
	let output = "";

	for (let i = 0; i < equation.length; i++) {
		output += equation[i];
	}

	if (output != '') current.innerHTML = output;
	else current.innerHTML = "0";
}

function updateScreen() {
	let output = "";

	for (let i = 0; i < equation.length; i++) {
		output += equation[i];
	}

	screen.innerHTML = output;
}

function sum(a, b) {
	return parseFloat(a) + parseFloat(b);
}

function diff(a, b) {
	return parseFloat(a) - parseFloat(b);
}

function times(a, b) {
	return parseFloat(a) * parseFloat(b);
}

function div(a, b) {
	return parseFloat(a) / parseFloat(b);
}
