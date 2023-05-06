const notificationsContainer = document.getElementById("notifications");

function AddNotification(message, type = "") {
  if (notificationsContainer.innerHTML.trim() == "") {
    if (notificationsContainer.classList.length > 0)
      RemoveAllClasses(notificationsContainer);
  } else {
    if (notificationsContainer.classList.length > 0)
      RemoveAllClasses(notificationsContainer);

    notificationsContainer.innerHTML = "";
  }

PopMessage(message, type);

  setTimeout(() => {
    notificationsContainer.innerHTML = "";
  }, 8000);
}

function PopMessage(message, type) {
  if (type != "danger" && type != "success" && type != "warning" && type != "")
    throw "Invalid type for notification message!";

	if(notificationsContainer.innerHTML != "") notificationsContainer.innerHTML = "";

  notificationsContainer.classList.add(type);
  notificationsContainer.appendChild(
    createElement("p", [{ key: "content", value: message }])
  );
  notificationsContainer.classList.add("pop-notification");
}
