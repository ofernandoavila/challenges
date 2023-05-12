/**
 * @description Instantiate a table with the given object keys
 * @param {string} tableId Defines the id for table div
 * @param {object} object The main table object
 */
function CreateTable(tableId, object) {
    if (typeof object != 'object') throw new Error('The object given is invalid');
    let table = createElement('div', [
        { key: 'class', value: ['table'] },
        { key: 'id', value: "table-" + tableId }
    ]);

    let head = createElement('div', [
        { key: 'class', value: ['item', 'head'] }
    ]);

    Object.keys(object).forEach(item => {
        let item = createElement('li', [
            { key: 'content', value: item }
        ]);

        head.appendChild(item);
    });

    table.appendChild(head);
}

/**
 * @description Insert an item into the given table
 * @param {object} object The main table object
 * @param {string} tableId Table id
 */
function CreateTableItem(object, tableId) {
    if (typeof object != "object") throw new Error("The object given is invalid");
    let table = document.querySelector(`#${tableId}`);

    let item = createElement("div", [
		{ key: "class", value: ["item"] },
	]);

	Object.values(object).forEach((value) => {
		let div = createElement("li", [{ key: "content", value }]);

		item.appendChild(div);
	});

	table.appendChild(item);
}