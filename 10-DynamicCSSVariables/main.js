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
    return document.documentElement.style.setProperty(
      "--Login-input-background",
      "lightyellow"
    );
  } else document.documentElement.style.removeProperty('--Login-input-background');

  if (loginInfo.password == "") {
    document.documentElement.style.removeProperty("--Password-input-background")
    return document.documentElement.style.setProperty(
      "--Password-input-background",
      "lightyellow"
    );
  } else document.documentElement.style.removeProperty('--Password-input-background');

  if(/\s/.test(loginInfo.login)) {
    document.documentElement.style.removeProperty("--Login-input-background");
    return document.documentElement.style.setProperty(
      "--Login-input-background",
      "lightyellow"
    );
  } else document.documentElement.style.removeProperty('--Login-input-background');

  if (loginInfo.login != "mylogin") {
    document.documentElement.style.removeProperty("--Login-input-background");
    
    return document.documentElement.style.setProperty( 
      "--Login-input-background",
      "lightcoral"
    );
  } else document.documentElement.style.removeProperty('--Login-input-background');

  if (loginInfo.password != "mypassword") {
    document.documentElement.style.removeProperty("--Password-input-background")
    return document.documentElement.style.setProperty(
      "--Password-input-background",
      "lightcoral"
    );
  } else document.documentElement.style.removeProperty('--Password-input-background');
}
