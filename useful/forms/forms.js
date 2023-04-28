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

function createElement(type) {
    let element = "";
    switch (type) {
        case 'column':
            element = document.createElement('div');
            element.classList.add('column');
            return element;

        case 'input-group':
            element = document.createElement('div');
            element.classList.add('input-group');
            return element;
        
        default:
            return document.createElement(type);
    }
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