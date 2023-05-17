async function LoadDB() {
	try {
		AddLogMessage("Creating Database");
		const dbManager = new IndexedDBManager("myDatabase", "myStore");

		await dbManager.connect();

		const users = [
			{ userId: 2, name: "Jane Smith", email: "jane.smith@example.com" },
			{ userId: 3, name: "Bob Johnson", email: "bob.johnson@example.com" },
		];
		const user = { userId: 1, name: "John Doe", email: "john.doe@example.com" };

		await dbManager.initialLoad(users);
		await dbManager.insertUser(user);
	} catch (error) {
		AddLogMessage(error);
		AddNotification("The database is already loaded!", "danger");
	}
}

async function FetchDB() {
	try {
		const dbManager = new IndexedDBManager("myDatabase", "myStore");

		await dbManager.connect();

		// chame a função getAllDataFromStore para obter todos os dados na loja
		AddLogMessage("DB fetch!");
		AddNotification("The database was fetched!", "success");
		const allData = await dbManager.getAllDataFromStore();
		
		if (allData.length < 1) throw new Error("There is no data on DB!");

		let container = document.querySelector("#DB-rows fieldset");

		container.innerHTML = "";

		let table = new Table("customers", allData[0], container);
		// let table = CreateTable("customers", allData[0]);

		allData.forEach((element) => {
			table.CreateItem(element);
		});
	} catch (error) {
		AddLogMessage(error);
		AddNotification(error, "warning");
	}
}

function ClearDB() {
	let popup = new Popup("clear-db");
	popup.createPopup("Do you really want to delete all data?", [
		createElement("button", [
			{ key: "class", value: ["btn", "btn-danger"] },
			{ key: "content", value: "Clear all data" },
			{ key: "onclick", value: "DeleteDBContent()" },
		]),
	]);
}

async function DeleteDBContent() {
	Popup.closePopup("clear-db");
	try {
		const dbManager = new IndexedDBManager("myDatabase", "myStore");

		await dbManager.connect();

		// Limpar todos os dados na loja
		await dbManager.removeAllRows();
		let container = document.querySelector("#DB-rows fieldset");

		container.innerHTML = "";

		AddLogMessage("DB clear!");
		AddNotification("The database was clear!", "success");
	} catch (error) {
		AddLogMessage("An error ocurred while attempting clear db.");
		AddNotification(error, "danger");
	}
}
