/**
 * @description Create and display a button in the screen
 * @param {string} buttonName Name to insert in the button
 * @param {bool?} inColumn If true will be added into a column div
 * @param {DOMElement} location Element to be insert the button
 * @param {Array} classes Array of classes CSS to be insert into the button
 * @param {Array} functions Array of objects { event: "event name", functionName: "function to be hooked" }
 * @returns {DOMElement}
 */
function createFormButton(
	buttonName,
	inColumn = false,
	location,
	classes = [],
	functions = [],
) {
	let column = createElement("column");
	let inputGroup = createElement("input-group");
	let button = createElement("button");

	button.classList.add("btn");
	button.setAttribute("id", buttonName.toLowerCase() + "_button");
	button.innerHTML = buttonName;

	if (classes.length > 0) {
		classes.forEach((item) => {
			button.classList.add(item);
		});
	}

	if (functions.length > 0) {
		functions.forEach((item) => {
			AssociateFunction(button, item.event, item.functionName);
		});
	}

	inputGroup.appendChild(button);
	let out = inputGroup;

	if (inColumn) {
		column.appendChild(inputGroup);
		out = column;
	}

	if (location != undefined) {
		return location.appendChild(out);
	}

	return out;
}

/**
 * @description Create a DOMElement
 * @param {string} type The type of the element
 * @param {Array} options Array of objects to be attached to the element
 * @returns {DOMElement}
 */
function createElement(type, options = []) {
	let element = "";
	switch (type) {
		case "column":
			element = document.createElement("div");
			element.classList.add("column");
			if (options.length > 0)
				__DefineCreateElementOptions(element, options);
			return element;

		case "input-group":
			element = document.createElement("div");
			element.classList.add("input-group");
			if (options.length > 0)
				__DefineCreateElementOptions(element, options);
			return element;

		case "color-picker":
			element = createElement("input-group");
			element.appendChild(
				createElement("input-color", options.inputConfig),
			);
			element.appendChild(createElement("label", options.labelConfig));
			element.appendChild(createElement("button", options.buttonConfig));

			return element;

		case "input-color":
			element = document.createElement("input");
			element.setAttribute("type", "color");
			if (options.length > 0)
				__DefineCreateElementOptions(element, options);
			return element;

		default:
			element = document.createElement(type);
			if (options.length > 0)
				__DefineCreateElementOptions(element, options);
			return element;
	}
}

/**
 * @description Modify the element given
 * @param {DOMElement} element The element to be edited
 * @param {Array} options Array of objects to be attached to the element 
 */
function __DefineCreateElementOptions(element, options) {
	options.forEach((option) => {
		switch (option.key) {
			case "id":
				element.setAttribute("id", option.value);
				break;

			case "class":
				option.value.forEach((item) => {
					if(item == "") return;
					element.classList.add(item);
				});
				break;

			case "content":
				if (typeof option.value == "object") {
					if (option.value instanceof DOMException) {
						element.innerHTML += option.value.message;
					} else {
						option.value.forEach((item) => {
							element.innerHTML += item.toString();
						});
					}
				} else element.innerHTML = option.value;
				break;

			case "name":
				element.name = option.value;
				break;

			case "for":
				element.for = option.value;
				break;

			default:
				element.setAttribute(option.key, option.value);
		}
	});
}

/**
 * @description Change DOM Element ID
 * @param {DOMElement} element Given element
 * @param {string} elementId ID value
 */
function setId(element, elementId) {
	element.setAttribute("id", elementId);
}

/**
 * @description Toggle classes of the given element
 * @param {DOMElement} element Given element
 * @param {string} class1 Current class
 * @param {string} class2 Destination class
 */
function ToggleClass(element, class1, class2) {
	if (element.classList.contains(class1)) {
		element.classList.remove(class1);
		element.classList.add(class2);
	} else {
		element.classList.remove(class2);
		element.classList.add(class1);
	}
}

/**
 * @description Check if given element has the class given
 * @param {DOMElement} element Element to be checked
 * @param {string} className Class to be searched
 * @returns {bool}
 */
function HasClass(element, className) {
	return element.classList.contains(className);
}

/**
 * @description Remove all classes of element given
 * @param {DOMElement} element Given element
 * @returns {void}
 */
function RemoveAllClasses(element) {
	return element.classList.forEach( item => {
		element.classList.remove(item);
	});
}

/**
 * @description Associate an event to a created function
 * @param {DOMElement} element Given element
 * @param {string} event Name of event
 * @param {string} functionName Function name to be hooked
 * @returns {void}
 */
function AssociateFunction(element, event, functionName) {
	return element.setAttribute(event, functionName + "()");
}

/**
 * @description Change the current function when an event is called
 * @param {DOMElement} element Given element
 * @param {strin} event Event name
 * @param {string} functionName Function to be added
 * @returns {void}
 */
function SwitchFunction(element, event, functionName) {
	element.setAttribute(event, "");
	return element.setAttribute(event, functionName + "()");
}

/**
 * @description Switch the type of a button
 * @param {DOMElement} element Given element
 * @param {string} type State to toggle button
 * @returns {void}
 */
function SwitchButton(element, type) {
	switch (type) {
		case "start":
			element.value = "start";
			element.innerHTML = "Start";
			element.classList.remove("btn-danger");
			element.classList.add("btn-normal");
			break;

		case "stop":
			element.value = "stop";
			element.innerHTML = "Stop";
			element.classList.remove("btn-normal");
			element.classList.add("btn-danger");
			break;
	}
}

/**
 * @description Check if and element is checked
 * @param {string} elementId ID of DOM element to be found
 * @returns {bool}
 */
function isChecked(elementId) {
	return document.getElementById(elementId).value == "on";
}

/**
 * @description Check if and element is disabled
 * @param {string} elementId ID of DOM element to be found
 * @returns {bool} 
 */
function isDisabled(elementId) {
	return document.getElementById(elementId).disabled;
}

/**
 * @description Disable a DOM element
 * @param {string} elementId ID of DOM element to be disable
 * @returns {void}
 */
function disabledField(elementId) {
	let element = document.getElementById(elementId);
	element.disabled = true;
}

/**
 * @description Disable a list of DOM Elements
 * @param {DOMElement[]} elementList Array of DOM element to be disable
 * @returns {void}
 */
function DisabledAll(elementList) {
	elementList.forEach((item) => {
		item.disabled = true;
	});
}

/**
 * @description Toggle disable a list of DOM Elements
 * @param {DOMElement[]} elementList Array of DOM element to be disable
 * @returns {void}
 */
function ToggleDisabledAll(elementList) {
	elementList.forEach((item) => {
		item.disabled = !item.disabled;
	});
}

/**
 * @description Toggle the visibility of a DOM Element
 * @param {DOMElement} element Element to be toggle
 * @returns {void}
 */
function ToggleVisible(element) {
	if (element.classList.contains('hidden')) {
		element.classList.remove("hidden");
	} else {
		element.classList.add("hidden");
	}
}

/**
 * @description Toggle fields by parent
 * @param {string} elementParentId ID of parent fields to be toggle
 * @returns {void}
 */
function ToggleFields(elementParentId) {
	let elements = document.querySelectorAll(`#${elementParentId} input`);
	elements.forEach((item) => {
		item.disabled = !item.disabled;
	});
}

/**
 * @description Toggle disable a DOM Element
 * @param {string} elementName Identifier of element
 * @returns {void}
 */
function ToggleDisabled(elementName) {
	let element = document.querySelector(elementName);
	element.disabled = !element.disabled;
}

/**
 * @description Clear all inputs
 * @returns {void}
 */
function ClearAllInputs() {
	let elements = document.querySelectorAll("input");
	elements.forEach((item) => {
		item.value = "";
	});
}

/**
 * @description Clear all textareas
 * @returns {void}
 */
function ClearAllTextareas() {
	let elements = document.querySelectorAll("textarea");
	elements.forEach((item) => {
		item.value = "";
	});
}

/**
 * @description Check if the field has content
 * @param {DOMElement} field Element to be checked
 * @returns {bool}
 */
function CheckForValidField(field) {
	if (field.value.length < 3) {
		return false;
	} else {
		return true;
	}
}

/**
 * @description Validate a input
 * @param {DOMElement} item Element to be validated
 * @returns {void}
 */
function ValidateField(item) {
	let inputGroup = item.parentNode;

	if (item.value.length < 3) {
		if (!inputGroup.classList.contains("invalid-group")) {
			InvalidateField(inputGroup);
		}
	} else {
		if (inputGroup.classList.contains("invalid-group")) {
			inputGroup.classList.remove("invalid-group");
			inputGroup.querySelector("p").remove();
		}
	}
}

/**
 * @description Set an input group as invalid group
 * @param {DOMElement} item Element to be invalidated
 * @param {string} errorMesage Message to be display
 * @returns {void}
 */
function InvalidateField(item, errorMesage = "") {
	item.classList.add("invalid-group");
	item.appendChild(
		createElement("p", [
			{
				key: "content",
				value:
					errorMesage != ""
						? errorMesage
						: "This field can't be empty!",
			},
		]),
	);
}

/**
 * @description Check if has invalid fields
 * @returns {bool}
 */
function HaveInvalidFields() {
	let fields = document.querySelectorAll("[required]");

	let invalid = [];

	fields.forEach((item) => {
		if (!CheckForValidField(item)) {
			invalid.push(item);
		}

		ValidateField(item);
	});

	return invalid.length > 0 ? true : false;
}

/**
 * @description Toggle required a DOM Element
 * @param {string} elementName Identifier of element
 * @returns {void}
 */
function ToggleRequired(elementName) {
	let element = document.querySelector(elementName);
	element.required = !element.required;
}

/**
 * @description Remove an invalid group from input group
 * @param {DOMElement} item Element to be invalidated
 * @returns {void}
 */
function RemoveInvalidGroup(item) {
	item.parentNode.classList.remove("invalid-group");
	item.parentNode.querySelector("p").remove();
}

/**
 * @description Show an alert box in browser
 * @param {string} mensage Message to be show in the alert
 * @returns {void}
 */
function SendAlert(mensage) {
	if (mensage == "") return;

	alert(mensage);
}

/**
 * @description Add an attribute into DOM Element
 * @param {DOMElement} element Given element
 * @param {string} attribute Attribute to be added
 * @param {strin} value Value to insert in the attribute
 * @returns {void}
 */
function AddAttributeToElement(element, attribute, value) {
	return element.setAttribute(attribute, value);
}
