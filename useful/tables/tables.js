class Table {
	constructor(tableId, object, parent, size = "") {
		if (parent == null || parent == undefined || typeof parent != "object")
			throw new Error("The parent given is invalid");
		if (tableId == "" || tableId == undefined || tableId == null)
			throw new Error("The id given is invalid");
		if (typeof object != "object")
			throw new Error("The object given is invalid");

		this.tableId = tableId;
		this.size = size != "" ? size : "1";

		this.object = object;

		let table = createElement("div", [
			{ key: "class", value: ["table"] },
			{ key: "id", value: "table-" + tableId },
		]);

		let head = createElement("div", [
			{ key: "class", value: ["item", "head", "item-size-" + this.size ] },
		]);

		Object.keys(object).forEach((item) => {
			let div = createElement("div", [{ key: "content", value: item }]);

			head.appendChild(div);
		});

		table.appendChild(head);

		parent.appendChild(table);
		this.table = table;
	}

	CreateItem (object) {
		if (typeof object != "object")
            throw new Error("The object given is invalid");
        
		let item = createElement("div", [
			{ key: "class", value: ["item", "item-size-" + this.size] },
		]);

		Object.values(object).forEach((value) => {
			let div = createElement("div", [{ key: "content", value }]);

			item.appendChild(div);
		});

        this.table.appendChild(item);
	}
}