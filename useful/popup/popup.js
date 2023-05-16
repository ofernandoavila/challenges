class Popup {
	constructor(popupId) {
		this.popupId = popupId;
	}

	createPopup(id, message, buttons = []) {
		let parent = document.querySelector("body");
		if (buttons.length < 1) {
			buttons.push(
				createElement("button", [
					{ key: "class", value: ["btn", "btn-normal"] },
					{ key: "content", value: "Ok" },
					{ key: "onclick", value: "closePopup()" },
				]),
			);
        }
        
        let lightbox = createElement("div", [
			{ key: "class", value: ["popup-lightbox"] },
        ]);
        
        let content = createElement("div", [
			{ key: "class", value: ["popup-content"] },
			{ key: "content", value: `<p>${this.message}</p>` },
		]);

		let popup = createElement("div", [
			{ key: "class", value: ["popup"] },
			{ key: "id", value: id },
		]);

		let buttonContainer = createElement("div", [
			{ key: "class", value: ["popup-button-container"] },
        ]);
        
        lightbox.appendChild(content);

		this.lightbox = lightbox;

		parent.appendChild(lightbox);

		buttons.map((item) => {
			buttonContainer.appendChild(item);
		});
	}

	closePopup() {
		let popup = document.querySelector(".popup#" + this.popupId);
		console.log(popup);
	}
}