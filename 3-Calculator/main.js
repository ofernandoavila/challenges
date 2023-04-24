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
			number = number.slice(0, -1);
			updatecurrent();
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
		number += value;
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
			}
			continue;
		}
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
	return b - a;
}

function times(a, b) {
	return a * b;
}

function div(a, b) {
	return a / b;
}
