const pattern = [
	["o", "x", "o", "x", "o"],
	["x", "o", "x", "o", "x"],
	["o", "x", "o", "x", "o"],
	["x", "o", "x", "o", "x"],
	["o", "x", "o", "x", "o"],
];

const lights = document.querySelectorAll(".light-grid .light");

const lightPattern = [];

function drawPattern() {
    for (let i = 0; i < pattern.length; i++) {
		let line = [];
		for (let j = 0; j < pattern[i].length; j++) {
			lightPattern.push(lights[j + i * pattern[i].length]);
		}
    }
    
    for (let i = 0; i < pattern.length; i++) {
		for (let j = 0; j < pattern[i].length; j++) {
            if (pattern[i][j] == "o") {
                let color =
                    "#" + Math.floor(Math.random() * 16777215).toString(16);
                let item = lightPattern[j + i * pattern[i].length];
                item.classList.add("light-on");
                item.style.backgroundColor = color;
                item.style.borderColor = color;
                item.style.boxShadow =
					"0 10px 10px rgb(255, 255, 255), 0 10px 20px rgb(255, 255, 255), 0 10px 30px rgb(255, 255, 255), 0 10px 40px rgb(255, 255, 255), 0 10px 50px rgb(255, 255, 255), 0 10px 70px " +
					color +
					", 0 10px 80px " +
					color +
					", 0 10px 100px " +
					color +
					", 0 10px 150px " +
					color;
            }
		}
	}
}

drawPattern();