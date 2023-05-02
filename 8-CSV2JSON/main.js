function GetCSVData() {
	let data = document.querySelector('textarea[name="csv-input"]').value;

	let output = false;
	try {
		output = CSV2JSON(data);
	} catch (error) {
		InvalidateField(
			document.querySelector('textarea[name="csv-input"]').parentNode,
			error,
		);
	} finally {
		return output ? data : output;
    }
}

function Convert() {
    if (HaveInvalidFields()) return;

	let data = GetCSVData();

	if (!data) return;

	document.querySelector("#json-output").disabled === true
		? ToggleDisabled("#json-output")
		: "";
	document.querySelector('button[value="copy2clipboard"]').disabled === true
		? ToggleDisabled('button[value="copy2clipboard"]')
		: "";
	document.querySelector('button[value="download"]').disabled === true
		? ToggleDisabled('button[value="download"]')
		: "";

	document.getElementById("json-output").value = CSV2JSON(data);

	AddEventToElement(
		document.querySelector('button[value="copy2clipboard"]'),
		"onclick",
		"CopyToClipboard(jsonOutput)",
	);

	AddEventToElement(
		document.querySelector("#download-csv-button"),
		"download",
		"CSV2JSON.json",
	);

	AddEventToElement(
		document.querySelector("#download-csv-button"),
		"href",
		CreateFileToDownload(CSV2JSON(data), "json", "CSV2JSON"),
	);
}

function Clear() {
    !document.querySelector("#json-output").disabled === true
		? ToggleDisabled("#json-output")
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
		""
	);
}