const lights = document.querySelectorAll(".light-grid .light");
const time = document.querySelector('input[name="time"]');

document.querySelector("#time-value").innerHTML = time.value;

time.addEventListener("change", (event) => {
	updateValues();
	document.querySelector("#time-value").innerHTML = event.target.value;
});

updateValues();

function updateValues() {
	lights.forEach( light => {
		let animationTime = parseFloat((time.value * 4) / 10);
		
		if (light.classList.contains("green")) {
			animationTime = parseFloat((time.value * 5) / 10);
		}

		if (light.classList.contains("blue")) {
			animationTime = parseFloat((time.value * 6) / 10);
		}

		if (light.classList.contains("red")) {
			animationTime = parseFloat((time.value * 8) / 10);
		}

		light.style.animationDuration = animationTime +"s";
	});
}

function basicControll(key) {
	console.log(key);
	if (key == 'on') {
		lights.forEach((light) => {
			light.classList.remove("turn-off");
		});
	} else {
		lights.forEach((light) => {
			light.classList.add("turn-off");
		});
	}
}