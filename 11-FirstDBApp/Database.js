class IndexedDBManager {
	constructor(databaseName, storeName) {
		this.databaseName = databaseName;
		this.storeName = storeName;
		this.db = null;
	}

	async connect() {
		return new Promise((resolve, reject) => {
			const request = window.indexedDB.open(this.databaseName);

			request.onerror = () => {
				AddLogMessage(
					new Error(
						`Failed to connect to database "${this.databaseName}".`,
					),
				);
				reject();
			};

			request.onsuccess = () => {
				this.db = request.result;
				resolve();
			};

			request.onupgradeneeded = (event) => {
				const db = event.target.result;

				if (!db.objectStoreNames.contains(this.storeName)) {
					AddLogMessage("Creating table");
					db.createObjectStore(this.storeName, { keyPath: "userId" });
				}
			};
		});
	}

	async insertUser(user) {
		return new Promise((resolve, reject) => {
			try {
				const transaction = this.db.transaction(
					[this.storeName],
					"readwrite",
				);
				const store = transaction.objectStore(this.storeName, {
					keyPath: "userId",
				});
				const request = store.add(user);

				request.onerror = () => {
					reject(
						new Error(`Failed to insert user "${user.userId}".`),
					);
				};
				request.onsuccess = () => {
					AddLogMessage("User saved!");
					AddNotification("User saved!", "success");
					resolve();
				};
			} catch (error) {
				AddNotification("An error ocurred", "danger");
				AddLogMessage(error);
			}
		});
	}

	async initialLoad(users) {
		AddLogMessage("Saving load of data...");
		return Promise.all(users.map((user) => this.insertUser(user)));
	}

	async getAllDataFromStore() {
		return new Promise((resolve, reject) => {
			try {
				const transaction = this.db.transaction(
					[this.storeName],
					"readonly",
				);
				const store = transaction.objectStore(this.storeName);
				const request = store.getAll();

				request.onerror = () => {
					reject(
						new Error(
							`Failed to retrieve data from store "${this.storeName}".`,
						),
					);
				};

				request.onsuccess = () => {
					resolve(request.result);
				};
			} catch (error) {
				AddNotification("An error ocurred", "danger");
				AddLogMessage(error);
			}
		});
	}

	async removeAllRows() {
		return new Promise((resolve, reject) => {
			try {
				const transaction = this.db.transaction(
					[this.storeName],
					"readwrite",
				);
				const store = transaction.objectStore(this.storeName);
				const request = store.clear();

				request.onerror = () => {
					reject(
						new Error(
							`Failed to remove all rows from store "${this.storeName}".`,
						),
					);
				};

				request.onsuccess = () => {
					resolve();
				};
			} catch (error) {
				AddNotification("An error ocurred", "danger");
				AddLogMessage(error);
			}
		});
	}
}
