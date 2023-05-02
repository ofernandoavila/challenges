let csvOutput = "";

function GetJSONData() {
	let data = document.querySelector('textarea[name="json-input"]').value;
    
    let output = false;
    try {
        output = JSON.parse(data);
    } catch (error) {
        InvalidateField(
			document.querySelector('textarea[name="json-input"]').parentNode,
			error.message,
		);
    } finally { return output };
}

function JSON2CSV(json) {
	let header = "";
	let content = "";

	Object.keys(json[0]).forEach(
		(item) => (header += FirstToUpperCase(item) + ","),
	);

	json.forEach((item) => {
		let out = "";

		Object.values(item).forEach((value) => {
			out += value + ",";
		});
		content += out + "\n";
	});

	csvOutput = header + "\n" + content;

	return csvOutput;
}

function Convert() {
    if (HaveInvalidFields()) return;

    let data = GetJSONData();

    if (!data) return;

	document.querySelector("#csv-output").disabled === true
		? ToggleDisabled("#csv-output")
		: "";
	document.querySelector('button[value="copy2clipboard"]').disabled === true
		? ToggleDisabled('button[value="copy2clipboard"]')
		: "";
	document.querySelector('button[value="download"]').disabled === true
		? ToggleDisabled('button[value="download"]')
		: "";

	document.getElementById("csv-output").value = JSON2CSV(data);

	AddEventToElement(
		document.querySelector('button[value="copy2clipboard"]'),
		"onclick",
		"CopyToClipboard(csvOutput)",
	);

	AddEventToElement(
		document.querySelector("#download-csv-button"),
		"download",
		"JSON2CSV.csv",
	);

	AddEventToElement(
		document.querySelector("#download-csv-button"),
		"href",
		CreateCSVFileToDownload(JSON2CSV(data)),
	);
}

function Clear() {
	!document.querySelector("#csv-output").disabled === true
		? ToggleDisabled("#csv-output")
		: "";
	!document.querySelector('button[value="copy2clipboard"]').disabled === true
		? ToggleDisabled('button[value="copy2clipboard"]')
		: "";
	!document.querySelector('button[value="download"]').disabled === true
		? ToggleDisabled('button[value="download"]')
		: "";

	ClearAllTextareas();

	AddEventToElement(
		document.querySelector('button[value="copy2clipboard"]'),
		"onclick",
		"",
	);

	AddEventToElement(
		document.querySelector("#download-csv-button"),
		"download",
		"",
	);

	AddEventToElement(
		document.querySelector("#download-csv-button"),
		"href",
		'',
	);
}