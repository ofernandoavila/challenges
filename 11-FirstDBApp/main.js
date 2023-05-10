function LoadDB() {
	const customerData = [
		{ userid: "444", name: "Bill", email: "bill@company.com" },
		{ userid: "555", name: "Donna", email: "donna@home.org" },
	];
	let customer = new Customer(DBNAME);
	customer.initialLoad(customerData);
}

function FetchDB() {
    AddLogMessage('DB fetch!');
    AddNotification('The database was fetched!', 'warning');
}

function ClearDB() {
    AddLogMessage('DB fetch!');
    AddNotification('The database was fetched!', 'warning');
}