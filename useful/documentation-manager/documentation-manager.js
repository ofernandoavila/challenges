/**
 * @description Convert all documentation write into a file in an array of objects 
 * @param {string} data Raw file to be documented
 * @returns {Array} Array of objects converted
 */
function GetDocumentationData(data) {
    let out = [];
    let documentation = data.split("/**");
    console.log(documentation);
    documentation.shift();
    
    documentation.forEach((line, index) => {
        
        let item = ReturnDocumentationItem(line);
        item.id = index + 1;
        out.push(item);
    });


    return out;
}

/**
 * @description Convert a line of document line into an object 
 * @param {string} docLine Code fragment to be documented
 * @returns {Object} Object converted
 */
function ReturnDocumentationItem(docLine) {
    let item = {
        id: 0,
        functionSignature: "",
        functionName: "",
        function: "",
        description: "",
        params: [],
        return: "",
    };

    let tmpContent = GetContentBetweenDelimiters(docLine, "*", ") {").split(
        "\n"
    );

    let docc = GetContentBetweenDelimiters(docLine, "*", "*/") + "*/\r";

    item.function = RemoveFromString(
        RemoveFromString(docLine, docc),
        " *"
    ).trim();

    tmpContent.forEach((line, index) => {
        if (line.includes(" *")) {
            line = GetContentBetweenDelimiters(line, " *", "\r");
        }

        line = line.trim();

        if (line.includes("@param")) {
            line = RemoveFromString(line, "@param ");

            let type = GetContentBetweenDelimiters(line, "{", "}");

            line = RemoveFromString(line, `{${type}} `);

            let variable = GetStringFirstWord(line);

            line = RemoveFromString(line, variable + " ");

            let description = line;

            let param = {
                type,
                variable,
                description,
            };

            item.params.push(param);
        } else if (line.includes("@returns")) item.return = line;
        else if (line.includes("@description")) {
            line = RemoveFromString(line, "@description ");

            item.description = line;
        } else {
            if (line != "/") {
                if (index + 1 == tmpContent.length) {
                    item.functionSignature += line + ")";
                } else item.functionSignature += line;
            }
        }
    });

    item.functionName = GetContentBetweenDelimiters(item.functionSignature, "function ", "(")

    return item;
}

/**
 * @description Load the documentation refferences
 * @param {string} path Path to the file to be documented
 * @returns {void}
 */
function LoadRefferences(path) {
    GetFileContentAsString(path, (data) => {
        let items = GetDocumentationData(data);
        CreateDocumentationPage(items);
    });
}

/**
 * @description Load the documentation menu
 * @param {string} path Path to the file to be documented
 * @param {string?} mode Defines the type of item link
 * @returns {void}
 */
function LoadMenu(path, mode = "") {
    GetFileContentAsString(path, (data) => {
        let items = GetDocumentationData(data);
        CreateDocumentationMenu(items, mode != "" ? mode : "");
    });
}

/**
 * @description Create and insert the menu items into documentation menu list
 * @param {Array} items Array of documentation items
 * @param {string?} mode Defines the type of item link
 * @returns {void}
 */
function CreateDocumentationMenu(items, mode = "") {
    return items.forEach((item) =>
        document
            .querySelector("ul#documentation-menu")
            .appendChild(
                CreateDocumentationMenuItem(item, mode != "" ? mode : "")
            )
    );
}

/**
 * @description Create the documentation page when called
 * @param {Array} items Array of documentation items
 * @returns {void}
 */
function CreateDocumentationPage(items) {
    items.forEach((item) =>
        document
            .querySelector("ul#documentation")
            .appendChild(CreateDocumentationItem(item))
    );
}

/**
 * @description Return a DOM Element to be append on documentation page
 * @param {object} item Documentation item
 * @returns {DOMElement}
 */
function CreateDocumentationItem(item) {
    let anchor = `<a class="anchor" id="${item.functionName}"></a>`;
    let title = `<h2 class="item-title">${item.functionName}</h2>`;
    let signature = `<h5 class="item-signature">${item.functionSignature}</h5>`;
    let description = `<p class="item-description">${item.description}</p>`;

    let paramList = "";

    item.params.forEach((item) => {
        paramList += `<li class="param-list-item"><em class="param-type">${item.type}</em> - <b>${item.variable}</b> ${item.description}</li>`;
    });

    let params = `<ul class="item-param-list">${paramList}</ul>`;
    let functionReturn = `<p class="item-return">${item.return}</p>`;

    let functionBody = `<div class="item-function-body"><pre>${item.function}</pre></div>`;

    let li = createElement("li", [
        { key: "class", value: ["documentation-item"] },
        {
            key: "content",
            value: [
                anchor,
                title,
                signature,
                description,
                params,
                functionReturn,
                functionBody,
            ],
        },
    ]);

    return li;
}

/**
 * @description Return a DOM Element to be append on documentation menu list
 * @param {object} item Documentation item
 * @param {string?} mode Defines the type of item link
 * @returns {DOMElement}
 */
function CreateDocumentationMenuItem(item, mode = "") {
    let link = "";
    if (mode != "") {
        switch (mode) {
            case "main":
                link = "./refference.html#" + item.functionName;
                break;
            default:
                link = "#" + item.functionName;
                break;
        }
    } else link = "#" + item.functionName;

    let anchor = `<a href="${link}">${item.functionName}</a>`;
    let li = createElement("li", [
        { key: "class", value: ["documentation-item"] },
        {
            key: "content",
            value: [anchor],
        },
    ]);

    return li;
}
