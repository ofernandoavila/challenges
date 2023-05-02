let isMobileMenuShown = false;

function toggleMobileMenu() {
	let nav = document.querySelector("header nav");
	isMobileMenuShown = !isMobileMenuShown;
	nav.style.display = isMobileMenuShown ? "inline-block" : "none";
}

function DateToString(date) {
    let month = (date.getMonth() + 1) < 10 ? "0" + (date.getMonth() + 1) : (date.getMonth() + 1);
    let day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
    let year = date.getFullYear() < 10 ? "0" + date.getFullYear() : date.getFullYear();
    let hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
    let minute = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
    let second = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
	
    return `${month}/${day}/${year} \n 
        ${hour}:${minute}:${second}`;
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

    if(second > 59) {
        minute = parseInt(second / 60);
        second = parseInt(second % 60);


        if(minute > 59) {
            hour = parseInt(minute / 60);
            minute = parseInt(minute % 60);

            if(hour > 23) {
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
        second
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

function CreateCSVFileToDownload(csvContent) {
	const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
	const file = new File([blob], "JSON2CSV.csv", {
		type: "text/csv;charset=utf-8;",
	});

    const fileURL = URL.createObjectURL(file);
    
    return fileURL;
}