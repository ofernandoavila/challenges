const modeButtons = document.querySelectorAll('input[name="mode"]');
const valueList = document.querySelectorAll('input[name^="value_"');
let modeAll = true;

valueList.forEach(item => {
	item.addEventListener('change', updateRadius);
});

function toggleMode() {
	if (document.querySelector('input[name="mode"]:checked').value == "all") {
		modeAll = true;
	} else modeAll = !modeAll;
	
	if (modeAll) {
		document.querySelector(".values__all").classList.remove("hidden");
		document.querySelector(".values__single").classList.add("hidden");
	} else {
		document.querySelector(".values__all").classList.add("hidden");
		document.querySelector(".values__single").classList.remove("hidden");
	}
}

function updateRadius() {
	if (modeAll) {
		let value = 0;
		value = document.querySelector('input[name="value_all"]').value;
		
		let allValues = document.querySelectorAll("div.line span.value");
		allValues.forEach((element) => (element.innerHTML = value));

		let preview = document.querySelector(".preview div");
		preview.style.borderRadius = `${value}px`;
	} else {
		let values = {
			topLeft: document.querySelector('input[name="value_topleft"]')
				.value,
			topRight: document.querySelector('input[name="value_topright"]')
				.value,
			bottomLeft: document.querySelector('input[name="value_bottomleft"]')
				.value,
			bottomRight: document.querySelector('input[name="value_bottomright"]')
				.value
		};

		if (values.topLeft != '')
			document.querySelector("div.line:nth-child(3) span.value").innerHTML = values.topLeft;
		
		if (values.topRight != "")
			document.querySelector("div.line:nth-child(4) span.value").innerHTML =
				values.topRight;
		
		if (values.bottomLeft != "")
			document.querySelector("div.line:nth-child(5) span.value").innerHTML =
				values.bottomLeft;
		
		if (values.bottomRight != "")
			document.querySelector("div.line:nth-child(6) span.value").innerHTML =
				values.bottomRight;
		
		let preview = document.querySelector('.preview div');
		preview.style.borderRadius = `${values.topLeft}px ${values.topRight}px ${values.bottomRight}px ${values.bottomLeft}px `;
	}


	
}