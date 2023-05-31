const Login = {
    openLoginPopup: function () {
        let popup = new Popup("clear-db");
        return popup.createPopup("You need to be logged in to like this project!");
    }
}