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

	let amount = parseFloat(parseFloat(
		document.getElementById("total-value").value,
	).toFixed(2));

	let coins = {
		quarters: 0,    // .25
		dimes: 0,       // .10
		nickels: 0,     // .05
        pennies: 0,     // .01
        totalCoins: 0
    };
    
    let current = amount;
    let ready = false;

    while (ready == false) {
        if ((coins.quarters + 1) * .25 <= current) {
            coins.quarters++;
        } else {
            if (
                (coins.quarters * .25) +
                (coins.dimes + 1) * .10
                <= current
            ) {
                coins.dimes++;
            } else {
                if (
                    coins.quarters * 0.25 +
                    coins.dimes * 0.1 +
                    (coins.nickels + 1) * 0.05
                    <= current
                ) {
                    coins.nickels++;
                } else {
                    let next =
						coins.quarters * 0.25 +
						coins.dimes * 0.1 +
						coins.nickels * 0.05 +
						(coins.pennies + 1) * 0.01; 
                    if (parseFloat(next.toFixed(2)) <= current ) {
                        coins.pennies++;
                    } else {
                        ready = true;
                    }
                }
            }
        }
    }

    coins.totalCoins =
		coins.quarters + coins.dimes + coins.nickels + coins.pennies;

    document.querySelector('#coins-out b').innerHTML = coins.totalCoins + ' coins';
    document.querySelector("li.quarters").innerHTML = coins.quarters;
    document.querySelector('li.dimes').innerHTML = coins.dimes;
    document.querySelector('li.nickels').innerHTML = coins.nickels;
    document.querySelector('li.pennies').innerHTML = coins.pennies;
}
