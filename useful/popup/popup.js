class Popup {
	constructor(popupId) {
		this.popupId = popupId;
	}

	createPopup(message, buttons = []) {
		let parent = document.querySelector("body");
        buttons.push(
            createElement("button", [
                { key: "class", value: ["btn", "btn-normal"] },
                { key: "content", value: "Close" },
                { key: "onclick", value: 'Popup.closePopup("' + this.popupId + '")' },
            ]),
        );

        let popup = createElement("div", [
            { key: "class", value: ["popup"] },
            { key: "id", value: this.popupId },
        ]);
        
        let lightbox = createElement("div", [
			{ key: "class", value: ["popup-lightbox"] },
        ]);
        
        let content = createElement("div", [
			{ key: "class", value: ["popup-content"] },
			{ key: "content", value: `<h4>${message}</h4>` },
		]);


		let buttonContainer = createElement("div", [
			{ key: "class", value: ["popup-button-container"] },
        ]);
        
		buttons.map((item) => {
            buttonContainer.appendChild(item);
        });
        
        content.appendChild(buttonContainer);
        popup.appendChild(lightbox);
        lightbox.appendChild(content);
        parent.appendChild(popup);
	}

	static closePopup(id) {
		let popup = document.querySelector(".popup#" + id);
        if(popup == undefined || popup == null) throw new Error("The popup was not found");
        popup.remove();
	}
}