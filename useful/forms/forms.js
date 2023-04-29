function createFormButton(buttonName, inColumn = false, location, classes = [], functions = []) {
    let column = createElement('column');
    let inputGroup = createElement('input-group');
    let button = createElement('button');

    button.classList.add('btn');
    button.setAttribute('id', buttonName.toLowerCase() + '_button');
    button.innerHTML = buttonName;

    if(classes.length > 0) {
        classes.forEach( item => {
            button.classList.add(item);
        });
    }

    if(functions.length > 0) {
        functions.forEach( item => {
            AssociateFunction(button, item.event, item.functionName);
        });
    }

    inputGroup.appendChild(button);
    let out = inputGroup;

    if(inColumn) {
        column.appendChild(inputGroup);
        out = column;
    }

    if(location != undefined) {
        return location.appendChild(out);
    }

    return out;
}

function createElement(type, options = []) {
    let element = "";
    switch (type) {
        case 'column':
            element = document.createElement('div');
            element.classList.add('column');
            if(options.length > 0) __DefineCreateElementOptions(element, options);
            return element;

        case 'input-group':
            element = document.createElement('div');
            element.classList.add('input-group');
            if(options.length > 0) __DefineCreateElementOptions(element, options);
            return element;
        
        default:
            element = document.createElement(type);
            if(options.length > 0) __DefineCreateElementOptions(element, options);
            return element;
    }
}

function __DefineCreateElementOptions(element, options) {
    options.forEach( option => {
        switch (option.key) {
            case 'id':
                element.setAttribute('id', option.value);
                break;

            case 'class': 
                option.value.forEach( item => {
                    element.classList.add(item);
                } );
                break;

            case 'content': 
                element.innerHTML = option.value;
                break;

            default:
                element.setAttribute(option.key, option.value);
        }
    });
}

function setId(element, elementId) {
    element.setAttribute('id', elementId);
}

function ToggleClass(element, class1, class2) {
    if(element.classList.contains(class1)) {
        element.classList.remove(class1);
        element.classList.add(class2);
    } else {
        element.classList.remove(class2);
        element.classList.add(class1);
    }
}

function AssociateFunction(element, event, functionName) {
    return element.setAttribute(event, functionName + '()');
}

function SwitchFunction(element, event, functionName) {
    element.setAttribute(event, "");
    return element.setAttribute(event, functionName + '()');
}

function isChecked(elementId) {
    return document.getElementById(elementId).value == 'on';
}

function disabledField(elementId) {
    let element = document.getElementById(elementId);
    element.disabled = true;
}

function ToggleFields(elementParentId) {
    let elements = document.querySelectorAll(`#${elementParentId} input`);
    elements.forEach( item => {
        item.disabled = !item.disabled;
    });
}

function ToggleField(elementId) {
    let element = document.getElementById(elementId);
    element.disabled = !element.disabled;
}

function ClearAllInputs() {
    let elements = document.querySelectorAll('input');
    elements.forEach( item => {
        item.value = "";
    });
}