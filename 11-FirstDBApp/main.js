async function LoadDB() {
	// const customerData = [
	// 	{ userid: "444", name: "Bill", email: "bill@company.com" },
	// 	{ userid: "555", name: "Donna", email: "donna@home.org" },
	// ];
	// // let customer = new Customer(DBNAME);
	// // customer.initialLoad(customerData);

	AddLogMessage("Creating Database");
	// const dbManager = new IndexedDBManager("myDatabase", "myStore");

	// await dbManager.connect();

	// const users = [
	// 	{ userId: 2, name: "Jane Smith", email: "jane.smith@example.com" },
	// 	{ userId: 3, name: "Bob Johnson", email: "bob.johnson@example.com" },
	// ];
	// const user = { userId: 1, name: "John Doe", email: "john.doe@example.com" };
	// await dbManager.initialLoad(users);
	
	// await dbManager.insertUser(user);
}

async function FetchDB() {
	const dbManager = new IndexedDBManager("myDatabase", "myStore");

	// primeiro conecte ao banco de dados
	await dbManager.connect();

	// chame a função getAllDataFromStore para obter todos os dados na loja
	const allData = await dbManager.getAllDataFromStore();

	// imprima o resultado no console
	console.log(allData);
    AddLogMessage('DB fetch!');
    AddNotification('The database was fetched!', 'success');
}

function ClearDB() {
    AddLogMessage('DB fetch!');
    AddNotification('The database was fetched!', 'warning');
}