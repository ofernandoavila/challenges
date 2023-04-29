let darkTheme = false;

const btnToggleTheme = document.querySelector("button.toggle-theme");
btnToggleTheme.addEventListener("click", e => toggleTheme(e));

function toggleTheme(e = '') {
    e != '' ?? e.preventDefault();
    darkTheme = !darkTheme;
    if (darkTheme) {
        document.querySelector("button.toggle-theme i").classList.remove("fa-moon");
        document.querySelector("button.toggle-theme i").classList.add("fa-sun");
        document.querySelector(":root").classList.add("dark");
    } else {
        document.querySelector(":root").classList.remove("dark");
        document.querySelector("button.toggle-theme i").classList.add("fa-moon");
        document.querySelector("button.toggle-theme i").classList.remove("fa-sun");
    }
    
    SaveInBrowser('ofernandoavila_challenges_prod', darkTheme.toString());
}

function initToggleTheme() {
    console.log();
    if (
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches
    ) {
        if(
            GetFromBrowser('ofernandoavila_challenges_prod') != null
        ) {
            if(
                GetFromBrowser('ofernandoavila_challenges_prod') == 'true'
            ) {
                toggleTheme();
            }
        } else {
            toggleTheme();
        }
    }
}

initToggleTheme();