let isMobileMenuShown = false;

function toggleMobileMenu() {
	let nav = document.querySelector("nav");
	isMobileMenuShown = !isMobileMenuShown;
	nav.style.display = isMobileMenuShown ? "inline-block" : "none";
}

function DateToString(date = '') {
	if (date == '') date = new Date();

	let month =
		date.getMonth() + 1 < 10
			? "0" + (date.getMonth() + 1)
			: date.getMonth() + 1;
	let day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
	let year =
		date.getFullYear() < 10 ? "0" + date.getFullYear() : date.getFullYear();
	let hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
	let minute =
		date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
	let second =
		date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();

	return `${month}/${day}/${year} ${hour}:${minute}:${second}`;
}

function SaveInBrowser(key, data) {
	return localStorage.setItem(key, JSON.stringify(data));
}

function GetFromBrowser(key) {
	return JSON.parse(localStorage.getItem(key));
}

function DiffDates(date1, date2) {
	var diff = date2 - date1;

	second = Math.floor(diff / 1000);
	year = 0;
	month = 0;
	day = 0;
	hour = 0;
	minute = 0;

	if (second > 59) {
		minute = parseInt(second / 60);
		second = parseInt(second % 60);

		if (minute > 59) {
			hour = parseInt(minute / 60);
			minute = parseInt(minute % 60);

			if (hour > 23) {
				day = parseInt(hour / 24);
				hour = parseInt(hour % 24);
			}
		}
	}

	return {
		year,
		month,
		day,
		hour,
		minute,
		second,
	};
}

function FirstToUpperCase(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function CopyToClipboard(data) {
	if (navigator.clipboard) {
		navigator.clipboard.writeText(data).then(
			function () {
				alert("Text copy to clipboard!");
			},
			function () {
				let clipboard = document.createElement("textarea");
				clipboard.value = data;
				document.body.appendChild(clipboard);
				clipboard.select();
				document.execCommand("copy");
				document.body.removeChild(clipboard);
			},
		);
	} else {
		let clipboard = document.createElement("textarea");
		clipboard.value = data;
		document.body.appendChild(clipboard);
		clipboard.select();
		document.execCommand("copy");
		document.body.removeChild(clipboard);
	}
}

function ValidateJSON(data, neasted = false) {
	let output = true;

	let tmpData = JSON.parse(data);

	tmpData.forEach((item) => {
		Object.keys(item).forEach((value) => {
			if (!neasted && typeof item[value] == "object") {
				output = false;
				throw "Neasted JSON are not supported in this version!";
			}
		});
	});

	return output;
}

function ValidateCSV(data) {
    data = data.trim().split('\n');
    let keys = data[0].split(',').length;
    data.shift();

    for (let i = 0; i < data.length; i++) {
        let tmpRow = data[i].split(',');

        if (tmpRow.length != keys) throw "There is more values than keys on line " + parseInt(i + 1);
    }

	return true;
}

let csvOutput = "";
function JSON2CSV(json) {
	let header = "";
	let content = "";

	Object.keys(json[0]).forEach(
		(item) => (header += FirstToUpperCase(item) + ","),
	);

	header = header.slice(0, -1);

	json.forEach((item) => {
		let out = "";

        Object.values(item).forEach((value) => {
            if (typeof value == 'string') {
                if (value.includes(",")) value.replace(",", " ");
            }
			out += value + ",";
		});
		out = out.slice(0, -1);
		content += out + "\n";
	});

	csvOutput = header + "\n" + content;

	return csvOutput;
}

let jsonOutput = "";
function CSV2JSON(data, nestead = false) {
	let json = data.trim().split("\n");

	if (json.length < 2) throw "The content file must have more than one line";

	let keys = json[0].split(",");

	json.shift();

	let list = [];
	json.forEach((row) => {
		let out = {};
		let rowData = row.split(",");

		rowData.forEach((value, index) => {
			if (value == "") return;
            if (keys[index] == "") return;
            
            let onlyNumber = /^\d+$/.test(value);

            if (onlyNumber) {
                out[keys[index]] = parseFloat(value);
            } else {
                out[keys[index]] = value;
            }

		});

		list.push(out);
	});

	jsonOutput = JSON.stringify(list, null, 4);

	return jsonOutput;
}

function CreateFileToDownload(data, format, name) {
	let fileData = {
		name,
		data,
		type: "",
		extension: "",
	};

	switch (format) {
		case "csv":
			fileData.type = "text/csv;charset=utf-8;";
			fileData.extension = ".csv";
			break;

		case "json":
			fileData.type = "application/json;charset=utf-8;";
			fileData.extension = ".json";
	}

	if (fileData.type == "") throw `The format "${format}" is not compatible`;

	let blob = new Blob([data], { type: fileData.type });
	const file = new File([blob], fileData.name + fileData.extension, {
		type: fileData.type,
	});

	const fileURL = URL.createObjectURL(file);

	return fileURL;
}


window.onload = () => {
	if (typeof StartOnLoadPage == "function") {
		StartOnLoadPage();
	}
}