class Table {
    constructor(tableId, object, parent, size = "") {
        if (parent == null || parent == undefined || typeof parent != 'object')
            throw new Error('The parent given is invalid');
		if (tableId == "" || tableId == undefined || tableId == null)
			throw new Error("The id given is invalid");
		if (typeof object != "object")
			throw new Error("The object given is invalid");
		
        this.tableId = tableId;
		this.size = size;

		this.object = object;

		let table = createElement("div", [
			{ key: "class", value: ["table"] },
			{ key: "id", value: "table-" + tableId },
		]);

		let head = createElement("div", [
			{ key: "class", value: ["item", "head"] },
		]);

		Object.keys(object).forEach((item) => {
			let div = createElement("div", [{ key: "content", value: item }]);

			head.appendChild(div);
		});

		table.appendChild(head);

        parent.appendChild(table);
		this.table = table;
	}
}
/**
 * @description Instantiate a table with the given object keys
 * @param {string} tableId Defines the id for table div
 * @param {object} object The main table object
 */
function CreateTable(tableId, object) {
	if (tableId == "" || tableId == undefined || tableId == null)
		throw new Error("The id given is invalid");
	if (typeof object != "object")
		throw new Error("The object given is invalid");
	let table = createElement("div", [
		{ key: "class", value: ["table"] },
		{ key: "id", value: "table-" + tableId },
	]);

	let head = createElement("div", [
		{ key: "class", value: ["item", "head", "item-size-2"] },
	]);

	Object.keys(object).forEach((item) => {
		let div = createElement("div", [{ key: "content", value: item }]);

		head.appendChild(div);
	});

	table.appendChild(head);

	return table;
}

/**
 * @description Insert an item into the given table
 * @param {object} object The main table object
 */
function CreateTableItem(object) {
	if (typeof object != "object")
		throw new Error("The object given is invalid");
	let item = createElement("div", [
		{ key: "class", value: ["item", "item-size-2"] },
	]);

	Object.values(object).forEach((value) => {
		let div = createElement("div", [{ key: "content", value }]);

		item.appendChild(div);
	});

	return item;
}
