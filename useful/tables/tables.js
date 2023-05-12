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
        let div = createElement('div', [
            { key: 'content', value: item }
        ]);

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
    if (typeof object != "object") throw new Error("The object given is invalid");
    let item = createElement("div", [
		{ key: "class", value: ["item"] },
	]);

	Object.values(object).forEach((value) => {
		let div = createElement("div", [{ key: "content", value }]);

		item.appendChild(div);
	});
    
    return item;
}