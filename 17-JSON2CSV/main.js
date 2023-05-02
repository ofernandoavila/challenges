function GetJSONData() {
	let data = document.querySelector('textarea[name="json-input"]').value;
    
    let output = false;
	try {
		if (ValidateJSON(data)) {
			output = JSON.parse(data);
		}
    } catch (error) {
        InvalidateField(
			document.querySelector('textarea[name="json-input"]').parentNode,
			error.message != undefined ? error.message : error,
		);
    } finally { return output };
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
		CreateFileToDownload(JSON2CSV(data), "csv", "JSON2CSV"),
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