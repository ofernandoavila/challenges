let coinsOut = "";

function StartOnLoadPage() {
	coinsOut = document.getElementById("coins-out");

	AssociateFunction(
		document.getElementById("convert-button"),
		"onclick",
		"Convert",
	);
}

function Convert() {
	if (coinsOut.classList.contains("hidden")) ToggleVisible(coinsOut);

	let amount = parseFloat(
		document.getElementById("total-value").value,
	).toFixed(2);

	let coins = {
		quarters: 0,
		dimes: 0,
		nickels: 0,
		pennies: 0,
	};

	let current = amount * 100;

	while (current != 0) {
        coins.quarters = current / 4;
        
        if (current % 4 != 0) {
            current = current - (current / 4) + (current % 4);
        }

        coins.dimes = current / 10;

        if (current % 10 != 0) {
            current = current - (current / 4) + (current % 10);
        }

        coins.nickels = current / 5;
	}
}
