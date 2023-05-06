function StartOnLoadPage() {}

function ValidateLogin() {
  let loginContainer = document.getElementById("login-input").parentElement;
  let passwordContainer =
    document.getElementById("password-input").parentElement;

  const loginInfo = {
    login: document.getElementById("login-input").value,
    password: document.getElementById("password-input").value,
  };

  if (loginInfo.login == "") {
    document.documentElement.style.removeProperty("--Login-input-background");
    document.querySelector("p.login-message").innerHTML =
      "This field cannot be empty!";
    document
      .querySelector("p.login-message")
      .parentNode.classList.add("invalid-group");
    return document.documentElement.style.setProperty(
      "--Login-input-background",
      "lightyellow"
    );
  } else {
    if(HasClass(document.querySelector('p.login-message').parentNode, 'invalid-group')) document.querySelector('p.login-message').parentNode.classList.remove('invalid-group');
    document.querySelector("p.login-message").innerHTML = "";
    document.documentElement.style.removeProperty("--Login-input-background");
  }

  if (loginInfo.password == "") {
    document.documentElement.style.removeProperty(
      "--Password-input-background"
    );
    document.querySelector("p.password-message").innerHTML =
      "This field cannot be empty!";
    document
      .querySelector("p.password-message")
      .parentNode.classList.add("invalid-group");
    return document.documentElement.style.setProperty(
      "--Password-input-background",
      "lightyellow"
    );
  } else {
    if(HasClass(document.querySelector("p.password-message").parentNode, 'invalid-group')) document.querySelector("p.password-message").parentNode.classList.remove('invalid-group');
    document.querySelector('p.password-message').innerHTML = "";
    document.documentElement.style.removeProperty(
      "--Password-input-background"
    );
  }

  if (/\s/.test(loginInfo.login)) {
    document.documentElement.style.removeProperty("--Login-input-background");
    document.querySelector("p.login-message").innerHTML =
      "This field cannot contain spaces!";
    document
      .querySelector("p.login-message")
      .parentNode.classList.add("invalid-group");
    document.querySelector("p.login-message").innerHTML =
      "This field cannot contain spaces!";
    return document.documentElement.style.setProperty(
      "--Login-input-background",
      "lightyellow"
    );
  } else {
    if(HasClass(document.querySelector('p.login-message').parentNode, 'invalid-group')) document.querySelector('p.login-message').parentNode.classList.remove('invalid-group');
    document.querySelector("p.login-message").innerHTML = "";
    document.documentElement.style.removeProperty("--Login-input-background");
  }

  if (/\s/.test(loginInfo.password)) {
    document.documentElement.style.removeProperty(
      "--Password-input-background"
    );
    document
      .querySelector("p.password-message")
      .parentNode.classList.add("invalid-group");
    document.querySelector("p.password-message").innerHTML =
      "This field cannot contain spaces!";
    return document.documentElement.style.setProperty(
      "--Password-input-background",
      "lightyellow"
    );
  } else {
    if(HasClass(document.querySelector('p.password-message').parentNode, 'invalid-group')) document.querySelector('p.password-message').parentNode.classList.remove('invalid-group');
    document.querySelector('p.password-message').innerHTML = "";
    document.documentElement.style.removeProperty("--Login-input-background");
  }

  if (loginInfo.login != "mylogin") {
    document.documentElement.style.removeProperty("--Login-input-background");
    document.querySelector("p.login-message").innerHTML =
      "Login does not match!";
    document
      .querySelector("p.login-message")
      .parentNode.classList.add("invalid-group");

    return document.documentElement.style.setProperty(
      "--Login-input-background",
      "lightcoral"
    );
  } else {
    if(HasClass(document.querySelector('p.login-message').parentNode, 'invalid-group')) document.querySelector('p.login-message').parentNode.classList.remove('invalid-group');
    document.querySelector("p.login-message").innerHTML = "";
    document.documentElement.style.removeProperty("--Login-input-background");
  }

  if (loginInfo.password != "mypassword") {
    document.documentElement.style.removeProperty(
      "--Password-input-background"
    );
    document.querySelector("p.password-message").innerHTML =
      "Password does not match!";
    document
      .querySelector("p.password-message")
      .parentNode.classList.add("invalid-group");
    return document.documentElement.style.setProperty(
      "--Password-input-background",
      "lightcoral"
    );
  } else {
    if(HasClass(document.querySelector('p.password-message').parentNode, 'invalid-group')) document.querySelector('p.password-message').parentNode.classList.remove('invalid-group');
    document.querySelector('p.password-message').innerHTML = "";
    document.documentElement.style.removeProperty(
      "--Password-input-background"
    );
  }
}

function CancelLogin() {
    if(HasClass(document.querySelector('p.password-message').parentNode, 'invalid-group')) document.querySelector('p.password-message').parentNode.classList.remove('invalid-group');
    document.querySelector('p.password-message').innerHTML = "";

    if(HasClass(document.querySelector('p.login-message').parentNode, 'invalid-group')) document.querySelector('p.login-message').parentNode.classList.remove('invalid-group');
    document.querySelector("p.login-message").innerHTML = "";
    
    document.getElementById("login-input").value = "";
    document.getElementById("password-input").value = "";

    document.documentElement.style.removeProperty("--Login-input-background");
    document.documentElement.style.removeProperty("--Password-input-background");
}