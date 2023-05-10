class Customer {
	constructor(dbName) {
		this.dbName = dbName;
		if (!window.indexedDB) {
			window.alert(
				"Your browser doesn't support a stable version of IndexedDB. \
          Such and such feature will not be available.",
			);
		}
	}

	removeAllRows() {
		const request = indexedDB.open(this.dbName);

		request.onerror = (event) => {
			console.log(
				"removeAllRows - Database error: ",
				event.target.error.code,
				" - ",
				event.target.error.message,
			);
		};

		request.onsuccess = (event) => {
			console.log("Deleting all customers...");
			const db = event.target.result;
			const txn = db.transaction("customers", "readwrite");
			txn.onerror = (event) => {
				console.log(
					"removeAllRows - Txn error: ",
					event.target.error.code,
					" - ",
					event.target.error.message,
				);
			};
			txn.oncomplete = (event) => {
				console.log("All rows removed!");
			};
			const objectStore = txn.objectStore("customers");
			const getAllKeysRequest = objectStore.getAllKeys();
			getAllKeysRequest.onsuccess = (event) => {
				getAllKeysRequest.result.forEach((key) => {
					objectStore.delete(key);
				});
			};
		};
	}

	/**
	 * Populate the Customer database with an initial set of customer data
	 * @param {[object]} customerData Data to add
	 * @memberof Customer
	 */
	initialLoad(customerData) {
		const request = indexedDB.open(this.dbName);
		console.log(request);

		request.onupgradeneeded = function (event) {
			console.log("Populating customers...");
			const db = event.target.result;
			var version = parseInt(db.version);
			db.close();
			const objectStore = indexedDB.open(DBNAME, version + 1);

			objectStore.onupgradeneeded = (e) => {
				var database = e.target.result;
				var OS = database.createObjectStore("customers", {
					keyPath: "userid",
				});

				// Create an index to search customers by name and email
				OS.createIndex("name", "name", { unique: false });
				OS.createIndex("email", "email", { unique: true });

				// Populate the database with the initial set of rows
				customerData.forEach(function (customer) {
					OS.put(customer);
				});
			};

			objectStore.onerror = (event) => {
				console.log(
					"initialLoad - objectStore error: ",
					event.target.error.code,
					" - ",
					event.target.error.message,
				);
			};
		};

		request.onerror = (event) => {
			
			console.log(
				"initialLoad - Database error: ",
				event.target.error.code,
				" - ",
				event.target.error.message,
			);
		};

		request.onsuccess = (event) => {
			console.log("Populating customers...");
			const db = event.target.result;
			var version = parseInt(db.version);
			db.close();
			const objectStore = indexedDB.open(DBNAME, version + 1);

			objectStore.onupgradeneeded = (e) => {
				try {
					// var database = e.target.result;

					// var OS = database.transaction.objectStore("customers");
					// // Create an index to search customers by name and email
					// OS.createIndex("name", "name", { unique: false });
					// OS.createIndex("email", "email", { unique: true });
					// customerData.forEach(function (customer) {
					// 	OS.put(customer);
					// });
				} catch (error) {
					AddLogMessage(error);
					AddNotification(error, "danger");
				}
			};

			objectStore.onsuccess = (event) => {
				try {
					var database = event.target.result;
					var OS = database.objectStore("customers");
					// Create an index to search customers by name and email
					OS.createIndex("name", "name", { unique: false });
					OS.createIndex("email", "email", { unique: true });

					// Populate the database with the initial set of rows
					customerData.forEach(function (customer) {
						OS.put(customer);
					});

					event.target.result.close();
				} catch (error) {
					AddLogMessage(error);
					AddNotification(error, "danger");
				}
			};
		};
	}
}

// Web page event handlers
const DBNAME = "customer_db";

/**
 * Clear all customer data from the database
 */
const clearDB = () => {
	console.log("Delete all rows from the Customers database");
	let customer = new Customer(DBNAME);
	customer.removeAllRows();
};

/**
 * Add customer data to the database
 */
const loadDB = () => {
	console.log("Load the Customers database");

	// Customers to add to initially populate the database with
	const customerData = [
		{ userid: "444", name: "Bill", email: "bill@company.com" },
		{ userid: "555", name: "Donna", email: "donna@home.org" },
	];
	let customer = new Customer(DBNAME);
	customer.initialLoad(customerData);
};
