/**
 * @description Add notification container to screen
 * @param {string} message Message to be added into notification container
 * @param {string} type Defines the type of message
 * @returns {void}
*/
function AddNotification(message, type = "") {
    if(message == "" || type == "") throw "One or more arguments are null!";
    let notificationsContainer = document.getElementById("notifications");
    RemoveAllClasses(notificationsContainer);

    if (notificationsContainer.innerHTML.trim() == "") notificationsContainer.innerHTML = "";

    PopMessage(message, type);

    setTimeout(() => {
        
        notificationsContainer.innerHTML = "";
    }, 8000);
}

/**
 * @description Display the current message into noficiation panel
 * @param {string} message Message to be added into notification container
 * @param {string} type Defines the type of message
 * @returns {void}
 */
function PopMessage(message, type) {
    if (
        type != "danger" &&
        type != "success" &&
        type != "warning" &&
        type != ""
    )
        throw "Invalid type for notification message!";

    let notificationsContainer = document.getElementById("notifications");

    if (notificationsContainer.innerHTML != "")
        notificationsContainer.innerHTML = "";

    notificationsContainer.classList.add(type);
    notificationsContainer.appendChild(
        createElement("p", [{ key: "content", value: message }])
    );
    notificationsContainer.classList.add("pop-notification");
}